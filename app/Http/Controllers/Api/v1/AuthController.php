<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registor(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if($validation->fails()){
          return $this->validationError($validation->errors()->first());
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->uuid = Str::uuid();
        $user->save();

        $token = $user->createToken(User::USER_TOKEN);

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];

        return $this->success($data,'Success');
        
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->success(null,'logout success');
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if($validation->fails()){
          return $this->validationError($validation->errors()->first());
        }

        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            return $this->validationError('Invalid email address');
        }
        if($user->status == 'Block')
        {
            return $this->validationError('this account is blocked');
        }
         $token = $user->createToken(User::USER_TOKEN);

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];

        return $this->success($data,'Success');
    }
}

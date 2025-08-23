<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Mail\EmailOTP;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registor(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->status = 'Active';
        $user->uuid = Str::uuid();
        $user->save();

        $token = $user->createToken(User::USER_TOKEN);

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
        return $this->success($data, 'Success');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'logout success');
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = User::with(['kyc', 'cards'])->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->validationError('Invalid email or password');
        }
        if ($user->status == 'Block') {
            return $this->validationError('this account is blocked');
        }

        $token = $user->createToken(User::USER_TOKEN);
        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
        return $this->success($data, 'Success');
    }

    public function getUserProfile()
    {
        $user = User::with(['kyc', 'cards'])->find(Auth::user()->id);
        $data = [
            'user' => $user
        ];
        return $this->success($data);
    }

    public function emailVerification()
    {

        $user = Auth::user();

        $code = rand(100000, 999999);

        // Save OTP to database
        Otp::updateOrCreate([
            'email' => $user->email
        ], [
            'code' => $code,

        ]);

        // Send OTP email
        Mail::to($user->email)->send(new EmailOTP($user->name, $code));
        return $this->success($code, 'Verification code sent to your email');
    }

    public function checkOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = Auth::user();
        $otp = Otp::where('email', $user->email)->first();

        if (!$otp || $otp->code !== $request->code) {
            return $this->validationError('Invalid verification code');
        }

        // Mark email as verified
        $user->email_verified_at = now();
        $user->save();

        // Delete OTP after successful verification
        $otp->delete();
       
        return $this->success(null, 'Email verified successfully');
    }

    public function forgetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);
        $code = rand(100000, 999999);

        // Save password reset token to database
        Otp::updateOrCreate([
            'email' => $user->email
        ], [
            'code' => $code,
            'token' => $token
        ]);

        $data = [
            'token' => $token,
            'code' => $code,
        ];

        // Send password reset email
        Mail::to($user->email)->send(new EmailOTP($user->name, $code));
        return $this->success($data, 'Password reset link sent to your email');
    }

    public function checkPasswordResetOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token' => 'required|string',
            'code' => 'required|string',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $otp = Otp::where('token', $request->token)->first();

        if (!$otp) {
            return $this->validationError('Invalid password reset code');
        }
        if ($otp->code !== $request->code) {
            return $this->validationError('Invalid password reset code');
        }

        $user = User::with(['kyc', 'cards'])->where('email', $otp->email)->first();
        $token = $user->createToken(User::USER_TOKEN);
        $otp->delete();

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
        return $this->success($data);
    }

    public function resendPasswordResetOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token' => 'required|string|exists:otps,token',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $otp = Otp::where('token', $request->token)->first();
        $otp->code = rand(100000, 999999);
        $otp->save();
        Mail::to($user->email)->send(new EmailOTP($user->name, $code));
        $data = [
            'code' => $otp->code
        ];
        return $this->success($data, 'Password reset code sent to your email');
    }

    public function resetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

       
        return $this->success(null, 'Password reset successfully');
    }
}

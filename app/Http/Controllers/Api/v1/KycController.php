<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\KYC;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KycController extends Controller
{
     public function store(Request $request)
    {
        // ✅ Validation
        $validated = Validator::make($request->all(),[
            'firstName'       => 'required|string|max:255',
            'lastName'       => 'required|string|max:255',
            'idNumber'    => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'city'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'zipCode'     => 'required|string|max:20',
            'line1'       => 'required|string|max:255',
            'houseNumber' => 'required|string|max:255',
            'email'       => 'required|email|unique:k_y_c_s,email',
            'bod'         => 'required|date',
            'photo'       => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'idFront'     => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'idBack'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

         if($validated->fails()){
          return $this->validationError($validated->errors()->first());
        }

        // ✅ File Uploads
        $photoPath   = $request->file('photo')->store('kyc/photos', 'public');
        $idFrontPath = $request->file('idFront')->store('kyc/id_fronts', 'public');
        $idBackPath  = $request->file('idBack')->store('kyc/id_backs', 'public');

        // ✅ Save Record
        $kyc = KYC::create([
            'fName'       => $request->firstName,
            'lName'       => $request->lastName,
            'country'     => $request->get('country', 'Ethiopia'),
            'idType'      => $request->get('idType', 'PASSPORT'),
            'idNumber'    => $request->idNumber,
            'phone'       => $request->phone,
            'city'        => $request->city,
            'address'     => $request->address,
            'zipCode'     => $request->zipCode,
            'line1'       => $request->line1,
            'houseNumber' => $request->houseNumber,
            'photo'       => $photoPath,
            'idFront'     => $idFrontPath,
            'idBack'      => $idBackPath,
            'email'       => $request->email,
            'bod'         => $request->bod,
            'status'      => 'Pending',
            'user_id'     => Auth::user()->id,
            'uuid'        => Str::uuid(),
        ]);

        return $this->success(null,);
    }

}

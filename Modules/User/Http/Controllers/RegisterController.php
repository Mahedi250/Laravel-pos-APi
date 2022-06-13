<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class RegisterController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function register(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required', 'email' => 'required|unique:users,email,$this->id,id',
            'password' => 'required',
            'role' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //`name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $issave = $user->save();
            $response = $issave ? response()->json(["message" => "User added"], 200) : response()->json(["message" => "Not saved"], 500);
            return $response;
        } catch (\Exception $e) {

            return response()->json(["message" => $e->getMessage()], 422);
        }
    }
}

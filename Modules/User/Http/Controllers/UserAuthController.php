<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            $token = $request->user()->createToken('auth-token');

            return ['user' => $user, 'token' => $token->plainTextToken];
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

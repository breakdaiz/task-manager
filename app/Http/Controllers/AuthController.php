<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
    
        $validated = $request->validate([
            'email'=> 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($validated) ) {
            return response()->json([
                'message'=> 'Login information Invalid!'], 401);
        }
        $user =  User::where('email', $validated['email'])->first();

        return response()->json([
            'access_token' => $user->createToken('api_token') ->plainTextToken,
            'token_type' => "Bearer",
        ]);
    }
    //
}

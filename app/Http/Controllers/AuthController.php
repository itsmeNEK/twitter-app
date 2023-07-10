<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(auth()->attempt($data)) {
            $token = auth()->user()->createToken('myToken')->plainTextToken;
            return response()->json(
                ['user' => $user,
                'token' => $token],
                200
            );
        } else {
            return response()->json(['error' => 'Something wen wrong'], 200);
        }

    }
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('myToken')->plainTextToken;
            return response()->json(['token' => $token], 201);
        } else {
            return response()->json(['error' => 'Incorrect Credentials'], 400);
        }
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(
            null,
            200
        );
    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::whereEmail($request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['The provided credentials are incorrect.'],
            ], 404);
        }

        return $user->createToken("$user->name-token")->plainTextToken;
    }
}

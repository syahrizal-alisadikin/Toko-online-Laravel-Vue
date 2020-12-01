<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['register', 'login']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Create Token Customer
        $token = JWTAuth::fromUser($customer);

        if ($customer) {
            return response()->json([
                'success'   => true,
                'user'      => $customer,
                'token'     => $token
            ]);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credenctals = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credenctals)) {
            return response()->json([
                'success' => false,
                'message' => 'email or Password in incorrect'
            ]);
        }

        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),
            'token'   => $token
        ], 201);
    }

    public function getUser()
    {
        return response()->json([
            'success' => true,
            'user'    => auth()->user()
        ], 200);
    }
}

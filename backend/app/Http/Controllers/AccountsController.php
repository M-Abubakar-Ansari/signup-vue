<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AccountsModel as acc;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of accounts',
            'data' => acc::all()
        ], 200);
    }

    public function show($id)
    {
        $account = acc::findOrFail($id);
        return response()->json($account);
    }
public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255|unique:accounts,username',
        'email'    => 'required|email|unique:accounts,email',
        'password' => 'required|string|min:6'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $ver_code = rand(100000, 999999);

    $account = acc::create([
        'username' => $request->username,
        'email'    => $request->email,
        'password' => Hash::make($request->password)
    ]);

    \Mail::raw("Your verification code is: $ver_code", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Email Verification Code');
    });

    return response()->json([
        'text'     => 'Account created',
        'ver_code' => $ver_code
    ], 201);
}
public function remove(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255',
        'email'    => 'required|email',
        'password' => 'required|string|min:6'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }
    $account = acc::where('username', $request->username)
                  ->where('email', $request->email)
                  ->first();
    if (!$account) {
        return response()->json([
            'error' => 'Account not found.'
        ], 404);
    }
    if (!Hash::check($request->password, $account->password)) {
        return response()->json([
            'error' => 'Incorrect password.'
        ], 401);
    }
    $account->delete();
    return response()->json([
        'message' => 'Account deleted successfully.'
    ], 200);
}

}
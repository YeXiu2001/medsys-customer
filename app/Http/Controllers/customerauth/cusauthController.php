<?php

namespace App\Http\Controllers\customerauth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class cusauthController extends Controller
{

    public function login(Request $request)
    {
       return view('customerauth.login');
    }



    public function verifylogin(Request $request)
    {
        $user = DB::table('user_customers')
            ->where('email', $request->email)
            ->first();

        // Debugging: Log the query result
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Invalid email or password'], 404);
        }

        if (Hash::check($request->password, $user->password)) {
            $request->session()->put('email', $user->email);
            $request->session()->put('user_id', $user->id); // Added line to store user ID
            return redirect('/home');
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid email or password'], 401);
    }

public function register(Request $request)
{
    return view('customerauth.register');
}

public function addcustomer(Request $request)
    {
        // Use request body instead of query parameters
        $input = $request->all();

        // Comprehensive validation
        $validator = Validator::make($input, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'contact' => ['required']
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $userId = DB::table('user_customers')->insertGetId([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'contact' => $input['contact'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success', 
                'message' => 'User created successfully',
                'user_id' => $userId
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error', 
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }



}
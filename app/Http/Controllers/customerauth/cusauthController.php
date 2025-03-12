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

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'contact' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $userId = DB::table('user_customers')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact' => $request->contact,
            ]);

            if(!$userId) {
                throw new \Exception('User registration failed');
            }

            DB::commit();
            return response()->json([
                'status' => 'success', 
                'message' => 'User created successfully',
                'user_id' => $userId
            ], 200);

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
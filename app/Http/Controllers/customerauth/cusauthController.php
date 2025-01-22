<?php

namespace App\Http\Controllers\customerauth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class cusauthController extends Controller
{

    public function login(Request $request)
    {
       return view('customerauth/login');
    }



    public function verifylogin(Request $request)
{
    $user = DB::table('user_customers')
        ->where('email', $request->email)
        ->first();

    // Debugging: Log the query result
    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'Email not found'], 404);
    }

    if (Hash::check($request->password, $user->password)) {
        $request->session()->put('email', $user->email);
        $request->session()->put('user_id', $user->id); // Added line to store user ID
        return redirect('/home');
    }

    return response()->json(['status' => 'error', 'message' => 'Invalid email or password'], 401);
}

    


}
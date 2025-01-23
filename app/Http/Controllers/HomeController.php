<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect('/customer/login');
        }
        $user = DB::table('user_customers')->where('id', $userId)->first();

        $currentTime = now()->toTimeString();
        $pharmacyinfos = DB::table('pharmacy_info')
                        ->where('enable' , 1)
                        ->orderBy('o_time', 'asc')
                        ->get();
        return view('home', ['user' => $user, 'pharmacyinfos' => $pharmacyinfos]);
    }
}

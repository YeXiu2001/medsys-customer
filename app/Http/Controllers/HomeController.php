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

        $currentTime = now()->format('H:i:s');
        $pharmacyinfos = DB::table('pharmacy_info')
                        ->where('o_time', '<', $currentTime)
                        ->where('c_time', '>', $currentTime)
                        ->where('enable' , 1)
                        ->get();
        return view('home', ['user' => $user, 'pharmacyinfos' => $pharmacyinfos]);
    }
}

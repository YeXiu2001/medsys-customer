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

    public function viewPharmacy(Request $request, $pharma_id){
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect('/customer/login');
        }
        $user = DB::table('user_customers')->where('id', $userId)->first();

        $pharmacy = DB::table('pharmacy_info')->where('id', $pharma_id)->first();
        $ads = DB::table('pharmacy_ads')
        ->where('pharmacy_id', $pharma_id)
        ->get();

        return view('viewpharmacy',[
            'user' => $user,
            'p' => $pharmacy,
            'ads' => $ads
        ]);
    }
}

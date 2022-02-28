<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = \Carbon\Carbon::now()->format('Y');
        $lastYearDate = \Carbon\Carbon::now()->format('Y')-1;
        $data['last_year'] = DB::table('finances')->whereYear('date' , $lastYearDate)->sum('current_amount');
        $data['current_year'] = DB::table('finances')->whereYear('date' , $date)->sum('current_amount');
        $data['total_accounts'] = DB::table('customers')->count('account_number');
        $data['com_totalAmount'] = DB::table('finances')->sum('current_amount');
        $data['com_gainedInterest'] = DB::table('finances')->sum('gained_interest');
        $data['com_withdrawals'] = DB::table('finances')->sum('withdrawal');
        $data['customer'] = DB::table('customers')->get();

        return view('home' , $data);
    }
}

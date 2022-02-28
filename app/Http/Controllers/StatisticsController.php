<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Finance;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['totalInterest'] = DB::select('SELECT YEAR(date) as year  ,SUM(gained_interest) as total FROM dstallio_austin.finances where country = "america"  GROUP BY YEAR(date)');
        $data['us'] = DB::table('customers')->where('country' , 'america')->where('status' , '1')->count('account_number');
        
        $data['us_com_amount'] = DB::table('finances')->where('country' , 'america')->sum('amount');

        $data['us_com_gainedInterest'] = DB::table('finances')->where('country' , 'america')->sum('gained_interest');

        $data['us_com_withdrawals'] = DB::table('finances')->where('country' , 'america')->sum('withdrawal');

        
        $data['us_total'] = $data['us_com_amount'] +  $data['us_com_gainedInterest'] - $data['us_com_withdrawals'];

        return view('us_statistics' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ausStats()
    {
        $data['totalInterest'] = DB::select('SELECT YEAR(date) as year  ,SUM(gained_interest) as total FROM dstallio_austin.finances where country = "australia"  GROUP BY YEAR(date)');


        $data['aus'] = DB::table('customers')->where('country' , 'australia')->where('status' , '1')->count('account_number');
        
        $data['aus_com_amount'] = DB::table('finances')->where('country' , 'australia')->sum('amount');

        $data['aus_com_gainedInterest'] = DB::table('finances')->where('country' , 'australia')->sum('gained_interest');

        $data['aus_com_withdrawals'] = DB::table('finances')->where('country' , 'australia')->sum('withdrawal');

        
        $data['aus_total'] = $data['aus_com_amount'] +  $data['aus_com_gainedInterest'] - $data['aus_com_withdrawals'];

        return view('aus_statistics' , $data);

    }
}

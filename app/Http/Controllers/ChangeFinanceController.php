<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ChangeFinanceController extends Controller
{
    //
    public function getCustomerRelatedFinance($id , $customer)
    {
        $dataFinance = DB::table('finances')
            ->join('customers', 'customers.id', '=', 'finances.customer_id')
            ->select('finances.date', 'finances.amount','finances.customer_id', 'finances.current_amount','customers.account_title',
                'finances.comments','finances.id', 'customers.given_name','customers.account_number','customers.interest_rate','customers.email')
            ->where('finances.id' , $id )->where('customer_id' , $customer)
            ->orderBy('id','desc')->get();
        return view('ChangeFinance.cus_related_finance' , compact('dataFinance'));
    }
    public function postCustomerRelatedFinance(Request $request,$fid,$cid)
    {
        $dataF = DB::table('finances')->join('customers', 'customers.id', '=', 'finances.customer_id')
            ->select('finances.id','finances.date','customers.interest_rate','finances.current_amount')
            ->where('finances.id' , $fid )->where('customer_id' , $cid)
            ->get();
        foreach ($dataF as $data)
        {
            $interestRate = $data->interest_rate;
            $currentAmount = $data->current_amount;
            $financeDate = $data->date;
            $changeFinanceDate = Carbon::parse($request->finance_date);
            $diff = strtotime($changeFinanceDate) - strtotime($financeDate);
            $dateDiff = abs(round($diff / 86400));
            $gained_interest =   $currentAmount*($interestRate**($dateDiff/365)) ;
        }
        $changeFinData = DB::table('finaces')->insert([
           'finance_id' => $fid,
           'customer_id' => $cid,
           'gained_interest' => $gained_interest,
           'created_at' => $changeFinanceDate,
        ]);
        return redirect()->back()
            ->with('success', 'Updated');
    }
    public function viewFinanceData()
    {
        $data = DB::table('changefins')->join('finances' , 'finances.id' ,'=' , 'changefins.finance_id')
            ->get();
        dd($data);
    }
}

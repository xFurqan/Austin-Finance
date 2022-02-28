<?php

namespace App\Http\Controllers;

use App\Console\Commands\DailyUpdateFinance;
use Illuminate\Support\Facades\Artisan;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Carbon\Traits\Creator;
use App\Models\Customer;
use App\Models\InterestRate;
use App\Models\InterestChanged;
use App\Models\Currency;
use App\Models\Finance;




use Carbon\Carbon;
use DB;

class FinanceController extends Controller
{
    //
    public function GetFinance($id)
    {
        $data = Customer::find($id);
        $dataFinance = DB::table('finances')->where('customer_id' , $id)
            ->join('customers', 'customers.id', '=', 'finances.customer_id')
            ->select('finances.date', 'finances.amount','finances.customer_id', 'finances.current_amount', 'finances.withdrawal', 'finances.gained_interest',
                'finances.comments','finances.id', 'customers.name','customers.country','customers.account_number','customers.interest_rate','customers.email')
            ->orderBy('date','asc')->get();
        $lastFinanceInsertedId = DB::table('finances')->where('customer_id' , $id)->max('id');
        $currency = Currency::all();        

        return view('Finance.adminChangeFinance' , compact('data' , 'dataFinance' , 'lastFinanceInsertedId' , 'currency'));
        
    }
        public function PostFinance(Request $request , $id)
    {
        $request->validate([
            'date' => 'required|before:tomorrow',
        ]);

        $lastAmount  = DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
        $lastDbDate  = DB::table('finances')->where('customer_id',  $id)->latest('date')->first();
        $interest_rates = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
        $lastInterest  = DB::table('customers')->where('id',  $id)->latest('interest_rate')->first();

        $lasAmountAfterWithdrawal  = DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();


        isset($lastDbDate->current_amount) ?   $currentAmount = $lastAmount->current_amount + $request->amount : $request->amount;
        isset($lastDbDate->current_amount) ?    $withdrawal = $lastAmount->current_amount - $request->amount : $request->amount;
        isset($lastDbDate->date) ? $lastDbDate = $lastDbDate->date : NULL;

        $diff = abs(strtotime($request->date) - strtotime($lastDbDate));
        $noOfDays =  round($diff / (60 * 60 * 24));
        $yearlast =  DB::table('finances')->where('customer_id',  $id)->latest('date')->first();
        $addPreviousEntryDate = Carbon::parse($request->date)->format('Y');
        $nowDate = Carbon::now();

    
        foreach ($interest_rates as $interest_rate)
        {
            $rate = $interest_rate->interest_rate;
            $gained_interest =  $currentAmount*($rate**($noOfDays/365));
        }
        
        if ($request->account_type == '1') {
            if($request->date <= $lastDbDate)
            {
                $country = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
                $records = DB::table('finances')->where('date' , '>' , $request->date)->get();
                $getrequesteddate = DB::table('finances')->where('date','<',$request->date)->get();
                $getrequesteddateless = $getrequesteddate->max('date');
                $getlatestam = $getrequesteddate->max('current_amount');

                $diff = abs(strtotime($request->date) - strtotime($getrequesteddateless));
                $noOfDays =  round($diff / (60 * 60 * 24));

                $totalWithInt =  $getlatestam*($rate**($noOfDays/365));
                $totalhInt =  $totalWithInt - $getlatestam ;

                $comment = "Today's Total";
                DB::table('finances')->insert([
                    'customer_id' => $id,
                    'country' => $request->country,
                    'amount' => $request->amount,
                    'current_amount' => $request->amount+$totalWithInt,
                    'gained_interest' => $totalhInt,
                    'account_type' => $request->account_type,
                    'comments' => $comment,
                    'date' => $request->date,
                ]);

                $records = DB::table('finances')->where('date' , '>', $request->date)->get();
                $lRecord = DB::table('finances')->where('date' , '<=', $request->date)->latest('date')->first();
                $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
                $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();


                // $secLastRecord = Finance::where('date', '>' , $request->date)->skip(1)->take(1)->get();

                foreach($records as $record)
                {

                    $diff = abs(strtotime($lRecord->date) - strtotime($record->date));
                    $noOfDays =  round($diff / (60 * 60 * 24));

                    $skipOne =  DB::table('finances')->where('customer_id' , $id)->where('date', '>=' , $record->date)->latest()->first();

                    $totalRecWithInt =  $lRecord->current_amount*($rate**($noOfDays/365));
                    $totalRecInt = $totalRecWithInt - $skipOne->current_amount;

                     DB::table('finances')->where('date' ,'>=' , $record->date)->update([
                        'current_amount' => $totalRecWithInt,
                        'gained_interest' =>  $totalRecInt,
                      ]);

                }
                return redirect()->back()
                    ->with('success', 'Customer Finance Changed successfully.');
            }
            // FOR BACKDATED ENTRY ...  
            else if($request->date < $nowDate)
            {  
                if($request->amount == '2')
                {
                    DB::table('interest_rate')->insert([
                        'customer_id' => $id,
                        'rate' => $request->amount == '2' ? $request->amount : 0,
                        'year' => Carbon::parse($request->date)->format('Y'),
                    ]);
                }
               

                $comment = "Today's Total";
                DB::table('finances')->insert([
                    'country' => $request->country,
                    'customer_id' => $id,
                    'amount' => $request->amount,
                    'current_amount' => $request->amount,
                    'gained_interest' =>  NULL,
                    'account_type' => $request->account_type,
                    'withdrawal' => NULL,
                    'comments' => $comment,
                    'date' =>  $request->date
                ]);
               
                if ( Carbon::parse($request->date)->format('m') > 6 ) {
                    $comment = "Financial Year Not Editable";
                    $backDatedYear = Carbon::parse($request->date)->format('Y')+1;
                    $financialYearEndDate = '30-06-'.$backDatedYear;
                    $forinsertDB = $backDatedYear.'-07-01';
                    $backDatedEntry = Carbon::parse($request->date)->format('d-m-Y');
                    $differenceOfFirstEnterDateWithEndYear = strtotime($financialYearEndDate)-strtotime($backDatedEntry);
                    $differecneinDays = floor($differenceOfFirstEnterDateWithEndYear/(60*60*24));
                }
                else {
                    $comment = "Financial Year Not Editable";
                    $backDatedYear = Carbon::parse($request->date)->format('Y');
                    $financialYearEndDate = '30-06-'.$backDatedYear;
                    $forinsertDB = $backDatedYear.'-07-01';
                    $backDatedEntry = Carbon::parse($request->date)->format('d-m-Y');
                    $differenceOfFirstEnterDateWithEndYear = strtotime($financialYearEndDate)-strtotime($backDatedEntry);
                    $differecneinDays = floor($differenceOfFirstEnterDateWithEndYear/(60*60*24));
                }
               
                $amountwithinterest = $request->amount*($lastInterest->interest_rate**($differecneinDays/365));
                $interests = $amountwithinterest - $request->amount;

                DB::table('finances')->insert([
                    'country' => $request->country,
                    'customer_id' => $id,
                    'amount' => NULL,
                    'current_amount' => $amountwithinterest,
                    'gained_interest' =>  $interests,
                    'account_type' => $request->account_type,
                    'withdrawal' => NULL,
                    'comments' => $comment,
                    'date' =>  $forinsertDB
                ]);

                // echo "<li>".$backDatedEntry.' '. '-'.' '. $financialYearEndDate.' '.'Days-'.$differecneinDays.' ' .'Interest-' . $amountwithinterest.'<br>';
                $yearlast =  DB::table('finances')->where('customer_id',  $id)->latest('date')->first();
                $addPreviousEntryDates = Carbon::parse($yearlast->date)->format('Y');

                $nowDate = Carbon::now();

                for ($y = $addPreviousEntryDates; $y < $nowDate->format('Y'); $y++) {
                    $amount = DB::table('finances')->latest('current_amount')->first();
                    $current_amount = $amount->current_amount;

                    // Find Years..
                    $fn_month = 07;
                    // Get start date and end date of each financial year..

                    $end_date = new \DateTime($y  . '-' . $fn_month . '-01');
                    //last amount with interest
                                    
                    $start_date = clone $end_date;
                    $start_date->modify('-1 day');
                    $end_date->modify('+1year');
                   
                    $difference = strtotime(Carbon::parse($end_date)) - strtotime(Carbon::parse($start_date));

                    $diffinDaysYears = floor($difference/(60*60*24));
                    $yearlyAmountWithInterest = $current_amount*($lastInterest->interest_rate**($diffinDaysYears/365));
                    $intr = $yearlyAmountWithInterest - $current_amount;

                    $current_amount = $current_amount += $yearlyAmountWithInterest;
                    $comment = "Financial Year Not Editable";
                    DB::table('finances')->insert([
                        'country' => $request->country,
                        'customer_id' => $id,
                        'current_amount' => $yearlyAmountWithInterest,
                        'gained_interest' => $intr,
                        'account_type' => $request->account_type,
                        'withdrawal' => NULL,
                        'comments' => $comment,
                        'date' =>  $end_date
                    ]);
                }
                $fortoday =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
                $crAmn = $fortoday->current_amount;
                $crDate= $fortoday->date;
                $secondLast = DB::table('finances')->where('customer_id', '<=', $id)->orderBy('date', 'desc')->skip(1)->first();

                $forTnoOfDays = $nowDate->diffInDays($crDate);

                $todayAmountWithInterest = $crAmn*($lastInterest->interest_rate**($forTnoOfDays/365));
                $todayInterest = $todayAmountWithInterest - $yearlyAmountWithInterest;

                $comment = "Today's Total";
                    DB::table('finances')->insert([
                        'country' => $request->country,
                        'customer_id' => $id,
                        'amount' => NULL,
                        'current_amount' => $todayAmountWithInterest,
                        'gained_interest' =>  $todayInterest,
                        'account_type' => $request->account_type,
                        'withdrawal' => NULL,
                        'comments' => $comment,
                        'date' =>  $nowDate
                    ]);
                return redirect()->back()
                    ->with('success', 'Customer Finance Changed successfully.');
            }     
            else{
                isset($lasAmountAfterWithdrawal->current_amount) ? $Egained_interest =  $lasAmountAfterWithdrawal->current_amount*($rate**($noOfDays/365)) : NULL;
                $comment = "Today's Total";
                DB::table('finances')->insert([
                    'country' => $request->country,
                    'customer_id' => $id,
                    'amount' => $request->amount,
                    'current_amount' => isset($Egained_interest) ? $Egained_interest + $request->amount : $request->amount,
                    'gained_interest' =>  isset($Egained_interest) ? $Egained_interest -  $lasAmountAfterWithdrawal->current_amount : NULL ,
                    'account_type' => $request->account_type,
                    'withdrawal' => NULL,
                    'comments' => $comment,
                    'date' =>  $request->date
                ]);
                return redirect()->back()
                    ->with('success', 'Customer Finance Changed successfully.');
            }
        }
        else if ($request->account_type == '2')
        {
             DB::table('interest_rate')->insert([
                    'customer_id' => $id,
                    'rate' => $request->amount,
                    'year' => $request->date,
                ]);
    
            if($request->date <= $lastDbDate)
            {
                $country = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
                $records = DB::table('finances')->where('date' , '>' , $request->date)->get();
                $getrequesteddate = DB::table('finances')->where('date','<',$request->date)->get();
                $getrequesteddateless = $getrequesteddate->max('date');
                $getlatestam = $getrequesteddate->max('current_amount');

                $diff = abs(strtotime($request->date) - strtotime($getrequesteddateless));
                $noOfDays =  round($diff / (60 * 60 * 24));

                $totalWithInt =  $getlatestam*($rate**($noOfDays/365));
                $totalhInt =  $totalWithInt - $getlatestam ;

                $comment = "Interest Rate Changed" .$request->amount;
                DB::table('finances')->insert([
                    'customer_id' => $id,
                    'country' => $request->country,
                    'current_amount' => $totalWithInt,
                    'gained_interest' => $totalhInt,
                    'account_type' => $request->account_type,
                    'comments' => $comment,
                    'date' => $request->date,
                ]);

                // Update Interest In Customers Table..
                // DB::table('customers')->where('id', $id)->update([
                //     'interest_rate' => $request->amount,
                // ]);

                $interest_rate_date = DB::table('interest_rate')->where('customer_id' , $id)->latest('rate')->first();
                $recordsForInt = DB::table('finances')->where('date' , '>', $request->date)->get();
                $lRecord = DB::table('finances')->where('date' , '<=', $request->date)->latest('date')->first();
                $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();

                $intreset_r = DB::table('customers')->where('id',$id)->latest('interest_rate')->first();
                // $secLastRecord = Finance::where('date', '>' , $request->date)->skip(1)->take(1)->get();
                
                foreach($recordsForInt as $recForInt)
                {
                    $diff = abs(strtotime($lRecord->date) - strtotime($recForInt->date));
                    $noOfDays =  round($diff / (60 * 60 * 24));

                    $skipOne =  DB::table('finances')->where('date', '>=' , $recForInt->date)->latest()->first();

                    $totalRecWithInt =  $lRecord->current_amount*($interest_rate_date->rate**($noOfDays/365));
                    $totalRecInt = $totalRecWithInt - $skipOne->current_amount;
                     DB::table('finances')->where('customer_id' , $id)->where('date' ,'>=' , $recForInt->date)->update([
                        'current_amount' => $totalRecWithInt,
                        'gained_interest' =>  $totalRecInt,
                      ]);
                }
                
                return redirect()->back()
                    ->with('success', 'Customer Finance Changed successfully.');
            }
            else{
                isset($lasAmountAfterWithdrawal->current_amount) ? $Igained_interest =  $lasAmountAfterWithdrawal->current_amount*($rate**($noOfDays/365)) : NULL;
                // dd($lasAmountAfterWithdrawal->current_amount);

                $int = isset($lasAmountAfterWithdrawal->current_amount) ? $Igained_interest - $lasAmountAfterWithdrawal->current_amount : NULL;
                $comment = "Interest rate changed";
                DB::table('finances')->insert([
                    'country' => $request->country,
                    'customer_id' => $id,
                    'amount' => 'Interest rate chang to'.' '.$request->amount,
                    'current_amount' => isset($lasAmountAfterWithdrawal->current_amount) ? $lasAmountAfterWithdrawal->current_amount + $int : NULL,
                    'gained_interest' => isset($lasAmountAfterWithdrawal->current_amount) ? $Igained_interest - $lasAmountAfterWithdrawal->current_amount : NULL,
                    'account_type' => $request->account_type,
                    'withdrawal' => NULL,
                    'comments' => $comment,
                    'date' => $request->date,
                ]);
                DB::table('customers')->where('id', $id)->update([
                    'interest_rate' => $request->amount,
                ]);

                return redirect()->back()
                    ->with('success', 'Interest Rate Changed Successfully.');
            }
        }
        else if ($request->account_type == '3')
        {
            if($request->date <= $lastDbDate)
            {
                $country = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
                $records = DB::table('finances')->where('date' , '>' , $request->date)->get();
                $getrequesteddate = DB::table('finances')->where('date','<',$request->date)->get();
                $getrequesteddateless = $getrequesteddate->max('date');
                $getlatestam = $getrequesteddate->max('current_amount');

                $diff = abs(strtotime($request->date) - strtotime($getrequesteddateless));
                $noOfDays =  round($diff / (60 * 60 * 24));

                $totalWithInt =  $getlatestam*($lastInterest->interest_rate**($noOfDays/365));
                $totalhInt =  $totalWithInt - $getlatestam ;

                $comment = "Withdrawal To". $request->amount;
                DB::table('finances')->insert([
                    'customer_id' => $id,
                    'country' => $request->country,
                    'amount' => $request->amount,
                    'current_amount' => $totalWithInt - $request->amount,
                    'gained_interest' => $totalhInt,
                    'account_type' => $request->account_type,
                    'comments' => $comment,
                    'date' => $request->date,
                ]);

                $records = DB::table('finances')->where('date' , '>', $request->date)->get();
                $lRecord = DB::table('finances')->where('date' , '<=', $request->date)->latest('date')->first();
                $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();


                // $secLastRecord = Finance::where('date', '>' , $request->date)->skip(1)->take(1)->get();

                foreach($records as $record)
                {
                    $diff = abs(strtotime($lRecord->date) - strtotime($record->date));
                    $noOfDays =  round($diff / (60 * 60 * 24));

                    $skipOne =  DB::table('finances')->where('date', '=' , $record->date)->latest()->first();

                    $totalRecWithInt =  $lRecord->current_amount*($lastInterest->interest_rate**($noOfDays/365));
                    $totalRecInt = $totalRecWithInt - $skipOne->current_amount;

                     DB::table('finances')->where('date' ,'>=' , $record->date)->update([
                        'current_amount' => $totalRecWithInt,
                        'gained_interest' =>  $totalRecInt,
                      ]);

                }
                return redirect()->back()
                    ->with('success', 'Customer Finance Changed successfully.');
            }
            else {
                isset($lasAmountAfterWithdrawal->current_amount) ? $Wgained_interest =  $lasAmountAfterWithdrawal->current_amount*($rate**($noOfDays/365)) : NULL;
                $g_i = $Wgained_interest - $lasAmountAfterWithdrawal->current_amount;
                $comment = "Withdrawal".' '. $request->amount;
                DB::table('finances')->insert([
                    'country' => $request->country,
                    'customer_id' => $id,
                    'amount' => NULL,
                    'gained_interest' =>   $Wgained_interest - $lasAmountAfterWithdrawal->current_amount,
                    'current_amount' => isset($Wgained_interest) ? $lasAmountAfterWithdrawal->current_amount - $request->amount + $g_i  : $request->amount -  $lasAmountAfterWithdrawal->current_amount ,
                    'account_type' => $request->account_type,
                    'withdrawal' => $request->amount,
                    'comments' => $comment,
                    'date' => $request->date,
                ]);
                return redirect()->back()
                    ->with('success', 'Interest Rate Changed Successfully.');
            }
        }
        else if ($request->account_type == '0')
        {
            $comment = "Today's Total";
            DB::table('finances')->insert([
                'country' => $request->country,
                'customer_id' => $id,
                'amount' => NULL,
                'current_amount' => $gained_interest,
                'gained_interest' =>  $gained_interest - $lastAmount->current_amount ,
                'account_type' => $request->account_type,
                'withdrawal' => NULL,
                'comments' => $comment,
                'date' => $request->date,
            ]);
            return redirect()->back()
                ->with('success', 'Interest Rate Changed Successfully.');
        }    
    }
    

    public function postFinanceMK(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|before:tomorrow',
        ]);

        $currentDate =  now()->format('Y-m-d  H:i:s');
        $requestedDate =  $request->date;
        // generate  financial years list 
        $financialYears = $this->generateFinancialYears($requestedDate, $currentDate);


        switch($request->account_type)
        {
            case "1":
                $lastDbDate  = DB::table('finances')->where('customer_id',  $id)->latest('date')->first();

                // FOR DEPOSIT IN EXISTING TABLE ..
                // $lastDbDate  = DB::table('finances')->where('customer_id',  $id)->latest('date')->first();
                // if($request->date <= $lastDbDate)
                // {
                //     $country = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
                //     $records = DB::table('finances')->where('date' , '>' , $request->date)->get();
                //     $getrequesteddate = DB::table('finances')->where('date','<',$request->date)->get();
                //     $getrequesteddateless = $getrequesteddate->max('date');
                //     $getlatestam = $getrequesteddate->max('current_amount');
                //     $rate =  Customer::where('id',$id)->latest()->first()->interest_rate;

    
                //     $diff = abs(strtotime($request->date) - strtotime($getrequesteddateless));
                //     $noOfDays =  round($diff / (60 * 60 * 24));
    
                //     $totalWithInt =  $getlatestam*($rate**($noOfDays/365));
                //     $totalhInt =  $totalWithInt - $getlatestam ;
    
                //     $comment = "Today's Total";
                //     DB::table('finances')->insert([
                //         'customer_id' => $id,
                //         'country' => $request->country,
                //         'amount' => $request->amount,
                //         'current_amount' => $request->amount+$totalWithInt,
                //         'gained_interest' => $totalhInt,
                //         'account_type' => $request->account_type,
                //         'comments' => $comment,
                //         'date' => $request->date,
                //     ]);
    
                //     $records = DB::table('finances')->where('date' , '>', $request->date)->get();
                //     $lRecord = DB::table('finances')->where('date' , '<=', $request->date)->latest('date')->first();
                //     $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
                //     $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
    
    
                //     // $secLastRecord = Finance::where('date', '>' , $request->date)->skip(1)->take(1)->get();
    
                //     foreach($records as $record)
                //     {
    
                //         $diff = abs(strtotime($lRecord->date) - strtotime($record->date));
                //         $noOfDays =  round($diff / (60 * 60 * 24));
    
                //         $skipOne =  DB::table('finances')->where('customer_id' , $id)->where('date', '>=' , $record->date)->latest()->first();
    
                //         $totalRecWithInt =  $lRecord->current_amount*($rate**($noOfDays/365));
                //         $totalRecInt = $totalRecWithInt - $skipOne->current_amount;
    
                //          DB::table('finances')->where('date' ,'>=' , $record->date)->update([
                //             'current_amount' => $totalRecWithInt,
                //             'gained_interest' =>  $totalRecInt,
                //           ]);
    
                //     }
                //     return redirect()->back()
                //         ->with('success', 'Customer Finance Changed successfully.');
                // }
                //FOR BACKDATED FIRST ENTRY IN FINANCE TABLE..

                $data =  collect($financialYears)->map(function($item, $key) use ($request, $id, $financialYears , $lastDbDate){
                    $rate =  Customer::where('id',$id)->latest()->first()->interest_rate;
                    if($key == 0)
                    {
                        $comment =  "Today's Total";
                        $currentAmount = $request->amount;
                        $gainedInterest = 0;
    
                    }
                    else if($request->date <= $lastDbDate )
                    {
                        
                    }
                    else  
                    {
                        $lastAmount =  Finance::where("date", $financialYears[$key-1])->latest()->first()->current_amount;
                        $currentAmount = $lastAmount * ($rate**($this->getNoOfDays($financialYears[$key-1],$financialYears[$key])/365));
                        $gainedInterest = $currentAmount - $request->amount;
                        $comment =  "Financial Year Not Editable";
                    }
                    $data = [
                        'country' => $request->country,
                        'customer_id' => $id,
                        // 'amount' => $request->amount,
                        'current_amount' => $currentAmount,
                        'gained_interest' => $gainedInterest ,
                        'account_type' => $request->account_type,
                        'withdrawal' => NULL,
                        'comments' => $comment,
                        'date' =>  $item
                    ];
                    Finance::create($data);
                    return $data;

                })->toArray();
                $prevFy =  Finance::where('date','<=',$request->date)->orderBy('date','desc')->latest()->first();
                        $nextFy =  Finance::where('date','>=',$request->date)->first()->date;

                        $rate =  Customer::where('id',$id)->latest()->first()->interest_rate;

                        $currentAmount = $prevFy->current_amount * ($rate**($this->getNoOfDays($request->date,$prevFy->date)/365));
                        $gainedInterest = $currentAmount - $prevFy->current_amount;
                        $comment =  "Today's Total".' '.$request->amount;
        
                        Finance::updateOrCreate([
                            'country' => $request->country,
                            'customer_id' => $id,
                            // 'amount' => $request->amount,
                            'current_amount' => $currentAmount,
                            'gained_interest' => $gainedInterest ,
                            'account_type' => $request->account_type,
                            'withdrawal' => NULL,
                            'comments' => $comment,
                            'date' =>  $request->date
                        ]);
                $code = 'success';
                $msg = 'Customer Finance Changed successfully.'; 
                
                break;

            case "2": 
                InterestRate::create(['customer_id' => $id,'rate' => $request->amount,'year' => $request->date]);    
                // enter the date from whiuch we change
                // from prevFy object we will get  last current amont/gained interest
                // create new  record in finance withn new date   

                $prevFy =  Finance::where('date','<=',$request->date)->orderBy('date','desc')->latest()->first();
                $nextFy =  Finance::where('date','>=',$request->date)->first()->date;
                
                /** Must change the logic  */
                $rate =  Customer::where('id',$id)->latest()->first()->interest_rate;

                $currentAmount = $prevFy->current_amount * ($rate**($this->getNoOfDays($request->date,$prevFy->date)/365));
                $gainedInterest = $currentAmount - $prevFy->current_amount;
                $comment =  "Updated Interest Rate Changed".$request->amount;

                Finance::create([
                    'country' => $request->country,
                    'customer_id' => $id,
                    // 'amount' => $request->amount,
                    'current_amount' => $currentAmount,
                    'gained_interest' => $gainedInterest ,
                    'account_type' => $request->account_type,
                    'withdrawal' => NULL,
                    'comments' => $comment,
                    'date' =>  $requestedDate
                ]);
                // echo "<pre>";
                //     print_r($requestedDate.' '. $currentAmount);
                // echo "</pre>";


                $updatedInterestRates = InterestRate::whereCustomerId($id)->get();

                if(!$updatedInterestRates->isEmpty()) {
                    foreach($updatedInterestRates as $interestRate)
                    {
                        // get finance dat need to be updated
                        // get finance data from the date on which new interes rate created in interest rate table
                        $financeData = Finance::where('date','>',$interestRate->year)->orderBy('date','asc')->get(); 

                        $dateDiff = Finance::where('date','>=' , $request->date)->latest()->first()->date;
                        $amountForCalInterest = Finance::where('date','>=' , $request->date)->latest()->first()->current_amount;



                        $financeData->map(function($finance) use ($request, $interestRate, $prevFy, $nextFy, $id , $dateDiff , $amountForCalInterest ) {

                            $currentAmount = $finance->current_amount * ($interestRate->rate**($this->getNoOfDays($request->date,$nextFy)/365));
                            $gainedInterest = $currentAmount - $amountForCalInterest;
                            $comment =  "Updated Interest Rate Changed".$request->amount;

                
                            Finance::updateOrCreate(
                                ['date'=>$finance->date],
                                [
                                    'country' => $request->country,
                                    'customer_id' => $id,
                                    // 'amount' => $request->amount,
                                    'current_amount' => $currentAmount,
                                    'gained_interest' => $gainedInterest ,
                                    'account_type' => $request->account_type,
                                    'withdrawal' => NULL,
                                    // 'comments' => $comment,
                                    'date' =>  $finance->date
                                ]
                            );
                            // echo "<pre>";
                            //     print_r($finance->date.' '. $currentAmount);
                            // echo "</pre>";

                        });


                    }

                } // end empty check
                
                $code = 'success';
                $msg = 'Interest rate updated successfully.'; 
                break;

             case "3":
                $lastDbDate  = DB::table('finances')->where('customer_id',  $id)->latest('date')->first();
                $lastInterest  = DB::table('customers')->where('id',  $id)->latest('interest_rate')->first();


                if($request->date <= $lastDbDate)
                {
                    $country = DB::table('finances')->where('customer_id' , $id)->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
                    $records = DB::table('finances')->where('date' , '>' , $request->date)->get();
                    $getrequesteddate = DB::table('finances')->where('date','<',$request->date)->get();
                    $getrequesteddateless = $getrequesteddate->max('date');
                    $getlatestam = $getrequesteddate->max('current_amount');
    
                    $diff = abs(strtotime($request->date) - strtotime($getrequesteddateless));
                    $noOfDays =  round($diff / (60 * 60 * 24));
    
                    $totalWithInt =  $getlatestam*($lastInterest->interest_rate**($noOfDays/365));
                    $totalhInt =  $totalWithInt - $getlatestam ;
    
                    $comment = "Withdrawal To". $request->amount;
                    DB::table('finances')->insert([
                        'customer_id' => $id,
                        'country' => $request->country,
                        'amount' => $request->amount,
                        'current_amount' => $totalWithInt - $request->amount,
                        'gained_interest' => $totalhInt,
                        'account_type' => $request->account_type,
                        'comments' => $comment,
                        'date' => $request->date,
                    ]);
    
                    $records = DB::table('finances')->where('date' , '>', $request->date)->get();
                    $lRecord = DB::table('finances')->where('date' , '<=', $request->date)->latest('date')->first();
                    $amRec =  DB::table('finances')->where('customer_id',  $id)->latest('current_amount')->first();
    
    
                    // $secLastRecord = Finance::where('date', '>' , $request->date)->skip(1)->take(1)->get();
    
                    foreach($records as $record)
                    {
                        $diff = abs(strtotime($lRecord->date) - strtotime($record->date));
                        $noOfDays =  round($diff / (60 * 60 * 24));
    
                        $skipOne =  DB::table('finances')->where('date', '=' , $record->date)->latest()->first();
    
                        $totalRecWithInt =  $lRecord->current_amount*($lastInterest->interest_rate**($noOfDays/365));
                        $totalRecInt =  $skipOne->current_amount - $totalRecWithInt;
    
                         DB::table('finances')->where('date' ,'>=' , $record->date)->update([
                            'current_amount' => $totalRecWithInt,
                            'gained_interest' =>  $totalRecInt,
                          ]);
    
                    }
                    return redirect()->back()
                        ->with('success', 'Customer Finance Changed successfully.');
                }
                
                $code = "success";
                $msg = "Amount withdrawal Success";
                break;

            default:
                $code =  'warning';
                $msg =  'Something went wrong.';         

        }

        return redirect()->back()->with('success', $msg);

    }


    public function getNoOfDays($startDate, $endDate)
    {
        $to = Carbon::parse($endDate);
        $from = Carbon::parse($startDate);

        $days = $to->diffInDays($from);
        return $days;
    }

    public function generateFinancialYears($startDate, $endDate)
    {
        $selectedYear =  Carbon::parse($startDate)->format('Y');
        $listOfFyDates[] =  Carbon::parse($startDate)->format('Y-m-d H:i:s');
        for ($nYear = $selectedYear; $nYear <= date('Y'); $nYear++) {
            $listOfFyDates[] = Carbon::parse($nYear . "-07-01")->format('Y-m-d H:i:s');
        }
        $listOfFyDates[] =  $endDate;
        return $listOfFyDates;
    }

    // MK Code Ends

    public function EditFinance($id)
    {
        $data = DB::table('finances')->where('id' , $id)->get();
        return $data;
    }
    public function UpdateFinance(Request $request, $id)
    {
        $data = Finance::where('id' , $id)->update([
            'date' => $request->date,
            'amount' => $request->deposit,
            'current_amount' => $request->total,
            'gained_interest' => $request->gained,
            'withdrawal' => $request->withdrawal,
            'comments' => $request->comment
        ]);
        return $data;
    }
     public function DeleteFinance($c_id , $f_id)
    {
        $requestedDeletedRow = Finance::where('id' , $f_id)->where('customer_id' , $c_id)->first();
        if($requestedDeletedRow->amount != NULL && $requestedDeletedRow->current_amount != NULL && $requestedDeletedRow->gained_interest != NULL ) 
        {
            $latestInterest = DB::table('customers')->where('id' , $c_id)->latest()->first();
            $datas = Finance::where('date', '<' , $requestedDeletedRow->date)->orderBy('date','desc')->first();
            $requestedDeletedRow->delete();

            $afterDeleteFirstRow = Finance::where('date','>',$datas->date)->latest()->first();
            $afterDeleteUpdateRows = Finance::where('date','>',$datas->date)->get();
                foreach($afterDeleteUpdateRows as $row)
                {
                    $data = Finance::where('date', '<' , $requestedDeletedRow->date)->orderBy('date','desc')->first();
                   
                    $noOfDays = Carbon::parse($row->date)->diffInDays(Carbon::parse($data->date));  
                    $totalRecWithInt =  $data->current_amount*($latestInterest->interest_rate**($noOfDays/365));
                    $forCalInt = Finance::where('date',$row->current_amount)->get();

                    $totalRecInt = $totalRecWithInt - $forCalInt->current_amount;

                      DB::table('finances')->where('customer_id' , $c_id)->where('date' ,'>=' , $row->date)->update([
                        'current_amount' => $totalRecWithInt,
                        'gained_interest' =>  $totalRecInt,
                    ]);
                }
                return redirect()->back()->with('success', 'Deleted Successfully');
        }
           
        else
        {
            return redirect()->back()
            ->with('error', 'Could not find the data entry. Perhaps this entry is automatically
             created for the Financial Year calculation.If this is so, it is not data that can be altered.');
        }
        
    }
    public function viewClientsHistory($id)
    {
        $clients = DB::table('finances')->where('customer_id' , $id)
        ->join('customers', 'customers.id', '=', 'finances.customer_id')
        ->select('finances.date', 'finances.amount','finances.customer_id', 'finances.current_amount', 'finances.withdrawal', 'finances.gained_interest',
            'finances.comments','finances.id', 'customers.name','customers.country','customers.account_number','customers.interest_rate','customers.email')
        ->orderBy('date','desc')->get();
        $totalInterest = DB::select('SELECT YEAR(date) as year  ,SUM(gained_interest) as total FROM dstallio_austin.finances where customer_id = "'.$id.'" GROUP BY YEAR(date)');
        
        return view('clienthistory' , compact('clients','totalInterest'));
    }


}

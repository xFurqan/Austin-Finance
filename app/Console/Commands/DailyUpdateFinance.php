<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

//use http\Env\Request;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\FinanceController;
use App\Models\Customer;
use DB;


class DailyUpdateFinance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Update Finance';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {    
        $customersFinance = DB::table('finances')->join('customers' , 'customers.id' , '=' , 'finances.customer_id')->get();
        foreach ($customersFinance as $data)
        {
            $latestCurrentAmount  = DB::table('finances')->where('customer_id', $data->customer_id)->latest('date')->first();
            $ausFYears = DB::table('fiscal_years')->where('country' , 'australia')->get();
            $usFYears = DB::table('fiscal_years')->where('country' , 'America')->get();

            $latestDbDate = Carbon::parse($latestCurrentAmount->date);

            $latestDbAmount = $latestCurrentAmount->current_amount;
            $nowDate = Carbon::now();

            $noOfDays = $nowDate->diffInDays($latestDbDate);
            $noOfYears = $nowDate->diffInYears($latestDbDate);
            $noOfMonths = $nowDate->diffInMonths($latestDbDate);
            $gained_interest =  $latestDbAmount*($data->interest_rate**($noOfDays/365));

            if($noOfDays >= 1)
            {
                $comment = "Today's Total";
                DB::table('finances')->insert([
                   'customer_id' => $data->customer_id,
                   'country' => $data->country,
                   'date' => Carbon::now('America/Los_Angeles')->toDateTimeString(),
                   'current_amount' => $gained_interest,
                   'comments' => $comment,
                   'gained_interest' => $gained_interest-$latestDbAmount,
                ]);
            }
            // else if ($noOfDays > 1.0 && $data->amount == NULL )
            // {
            //     $comment = "Today's Total";
            //     DB::table('finances')->where('date',$latestDbDate)->where('gained_interest' , '!=' , NULL)->update([
            //         'customer_id' => $data->customer_id,
            //         'date' => Carbon::now('Asia/Karachi')->toDateTimeString(),
            //         'current_amount' => $gained_interest,
            //         'comments' => $comment,
            //         'gained_interest' => $gained_interest-$latestDbAmount,
            //      ]);
            // }

                  
                
                     
        }
        
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AshAllenDesign\LaravelExchangeRates\ExchangeRate;

use Guzzle\Http\Exception\ClientErrorResponseException;

use carbon\Carbon;
use App\Models\Finance;
use DB;

class CurrencyController extends Controller
{
    //

    public function exchangeCurrency(Request $request , $currency , $id) 
    {
        $changeCurrency  = Finance::where('customer_id' , $id)->orderBy('date','desc')->get();
        return response()->json($changeCurrency);
    }

}
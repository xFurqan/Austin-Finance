<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    //
    public function getFinance()
    {
        $data = DB::table('finances')->get();
        return response()->json($data);


    }

}

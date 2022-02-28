<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use voku\helper\ASCII;
use App\Models\Finance;
use Mail;
use DB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return view('Customers.customers' , compact('customers'));
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lastCustomerId = Customer::latest('id')->first();
        isset($lastCustomerId)  ? $lastId = $lastCustomerId->id : NULL;
        if(isset($lastId))
        {
            $lastId++;
            return view('Customers.create_customer' , compact('lastId'));

        }
        else{
            return view('Customers.create_customer');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->joint_account == 'check'){
            $request->validate([
                'account_number' => 'required',
                'account_title' => 'required',
                'interest_rate' => 'required',
                'email' => 'required|unique:customers,email',
                'login' => 'required',
                'name' => 'required',
                'surname' => 'required',
                'password' => 'required',
                'joint_account_title' => 'required',
                'joint_account_given_name' => 'required',
                'joint_account_surname' => 'required',
            ]);
        }else{
            $request->validate([
                'account_number' => 'required',
                'account_title' => 'required',
                'interest_rate' => 'required',
                'email' => 'required|unique:customers,email',
                'login' => 'required',
                'name' => 'required',
                'surname' => 'required',
                'password' => 'required',
            ]);
        }
        if($request->joint_account == 'check'){
            DB::table('customers')->insert([
               'account_number' => $request->account_number,
                'account_title' => $request->account_title,
                'interest_rate' => $request->interest_rate,
                'email' => $request->email,
                'status' => $request->status,
                'country' => $request->country,
                'login' => $request->login,
                'name' => $request->name,
                'surname' => $request->surname,
                'password' => $request->password,
                'joint_account_title' => $request->joint_account_title,
                'joint_account_given_name' => $request->joint_account_given_name,
                'joint_account_surname' => $request->joint_account_surname,
            ]);
        }else{
            DB::table('customers')->insert([
                'account_number' => $request->account_number,
                'account_title' => $request->account_title,
                'interest_rate' => $request->interest_rate,
                'email' => $request->email,
                'country' => $request->country,
                'status' => $request->status,
                'login' => $request->login,
                'name' => $request->name,
                'surname' => $request->surname,
                'password' => $request->password,
            ]);
        }
        $user = [
            'login' => $request->login,
            'password' => $request->password,
        ];
        $email = $request->email;
        Mail::to($email)->send( new \App\Mail\WelcomeMail($user));
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
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
        $data = Customer::find($id);
        return view('Customers.edit_customer' , compact('data'));
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
        $data = Customer::where('id' , $id)->update([
            'name' => $request->ac_name,
            'surname' => $request->surname,
            'account_number' => $request->ac_number,
            'login' => $request->login,
            'password' => $request->password,
            'status' => $request->status,
        ]);
        return redirect()->back()
            ->with('success', 'Updated Successfully');
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
        $record = Customer::where('id' , $id)->update([
            'status' => '0'
        ]);
        return $record;
    }
    
    public function customerLoginForm()
    {
        
        return view('Customers.auth.login');
    }
    
    public function customerLoginPost(Request $request)
    {
        $customers = DB::table('customers')->get();
        foreach($customers as $customer)
        {
            if($customer->login == $request->login && $customer->password == $request->password)
            {
                $userID = $customer->id;
                return redirect()->to('customers/dashboard/'.$userID);
            }
            
        }
    
        return redirect()->back()->with('error' , 'Invalid Credentials');
            

    }
    public function customerDashboard(Request $request ,  $id)
    {
        $data = Customer::find($id);
        $totalAmount = Finance::where('customer_id', $id)->sum('current_amount');
        $totalInterest = Finance::where('customer_id', $id)->sum('gained_interest');

        return view('Customers.clientDashboard' , compact('data','totalAmount','totalInterest'));
    }
    
    public function customerProfile($id)
    {
        $clients['data'] = Customer::find($id);
        $clients['clients'] = DB::table('finances')->where('customer_id' , $id)
        ->join('customers', 'customers.id', '=', 'finances.customer_id')
        ->select('finances.date', 'finances.amount','finances.customer_id', 'finances.current_amount', 'finances.withdrawal', 'finances.gained_interest',
            'finances.comments','finances.id', 'customers.name','customers.country','customers.account_number','customers.interest_rate','customers.email')
        ->orderBy('date','desc')->get();
        
        $clients['totalInterest'] = DB::select('SELECT YEAR(date) as year  ,SUM(gained_interest) as total FROM dstallio_austin.finances where customer_id = "'.$id.'" GROUP BY YEAR(date)');
        return view('Customers.profile' , $clients);
    }
    public function editClientProfile($id)
    {
        $data = Customer::find($id);
        return view('Customers.edit_client' , compact('data')); 
    }
    public function updateClientProfile(Request $request , $id)
    {
        $data = Customer::where('id' , $id)->update([
            'password' => $request->password,
            'name' => $request->ac_name,
            ]);
            
            return redirect()->to('client/profile/'.$id)->with('success' , "Profile Updated");
         
    }

}

<?php

namespace App\Http\Controllers\ecocorp\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Vehicle;
use App\Model\Quatataion;
use App\User;
use auth;
use File;
use DB;

class CustomerController extends Controller
{
    

    public function __construct(){
        $this->middleware('auth');
    }

    public function add_customer(Request $request){


          // return $request->all();


           $username = $request->input('username');
           $password = $request->input('password');
           $business = $request->input('customerbn');

           if($username == null || $password == null){

            $defaultpass = "ecoclient";
            $Customer = New Customer;
            $Customer->name = $request->input('name');
            $Customer->address = $request->input('address');
            $Customer->phoneno = $request->input('phone');
            $Customer->contactno = $request->input('cellno');
            $Customer->tin = $request->input('tin');
            $Customer->business_name = $request->input('customerbn');
            $Customer->email = $request->input('email');
            $Customer->save();

            $cid = $Customer->id;

            // $cuser = New User;
            // $cuser->name = $request->input('name');
            // $cuser->email = $request->input('email');
            // $cuser->customer_id = $cid;
            // $cuser->username = $request->input('email');
            // $cuser->password = $defaultpass;
            // $cuser->remember_token = str_random(60);
            // $cuser->save();

           }else{

            $Customer = New Customer;
            $Customer->name = $request->input('name');
            $Customer->address = $request->input('address');
            $Customer->phoneno = $request->input('phone');
            $Customer->contactno = $request->input('cellno');
            $Customer->tin = $request->input('tin');
            $Customer->business_name = $request->input('customerbn');
            $Customer->email = $request->input('email');
            $Customer->save();

            $cid = $Customer->id;

            // $cuser = New User;
            // $cuser->name = $request->input('name');
            // $cuser->email =$request->input('email');
            // $cuser->customer_id = $cid;
            // $cuser->username = $request->input('username');
            // $cuser->password = bcrypt($request->input('password'));
            // $cuser->remember_token = str_random(60);
            // $cuser->save();

           }

            session()->flash('success','Customer Sucessfully Registered');
            return redirect('/customers');
            
    }
    public function customerinfo($id){

        return $this->customer_details($id);
    }

    public function update_customer(Request $request){

        
        $c_username = $request->input('username');
       // return $request->all();
        $user_acc = User::where('username','=',$c_username)->count();
        $password = $request->input('c-password');
        $cid = $request->input('cid');

        $Customer = Customer::findorfail($cid);
        $Customer->name = $request->input('name');
        $Customer->address = $request->input('address');
        $Customer->phoneno = $request->input('phone');
        $Customer->contactno = $request->input('cellno');
        $Customer->tin = $request->input('tin');
        $Customer->business_name = $request->input('customerbn');
        $Customer->email = $request->input('email');
        $Customer->save();

        session()->flash('success','Customer Info Sucessfully Updated');

        // $userid = User::where('customer_id','=',$cid)->value('id');
        // $account = User::findorfail($userid);


        // if($user_acc == 1 && $c_username !== $account->username){
           
        //     session()->flash('error','Customer Username Already Exist! Please Try Other Username');
        //     return redirect('/customers');

        // }else{

            
            // if ($password != null) {
            //     # code..
            //     $account->name = $request->input('name');
            //     $account->email =$request->input('email');
            //     $account->customer_id = $cid;
            //     $account->username = $request->input('username');
            //     $account->password = bcrypt($password);
            //     $account->save();

            //     session()->flash('success','Customer Info Sucessfully Updated');
            //     return redirect('/customers');

            // }else{

            //     $account->name = $request->input('name');
            //     $account->email =$request->input('email');
            //     $account->customer_id = $cid;
            //     $account->username = $request->input('username');
            //     $account->save();


            //     session()->flash('success','Customer Info Sucessfully Updated');
            //     return redirect('/customers');

            // }


        // }
    }

    public function vcustomer_inquiries(){


        $inquiries = Quatataion::where('status','=','0')
        ->get();

        $leads = Quatataion::where('status','!=','0')
        ->get();

       // return $inquiries;
        
        return view('pages.Records.customer-inquiries')
        ->with('leads',$leads)
        ->with('inquiries',$inquiries);
    }

    public function get_inquiries($id){


        $inquiries = Quatataion::findorfail($id);

        return $inquiries;

    }

    public function add_lead(Request $request){


        $inquiry = Quatataion::findorfail($request->input('inquiry_id'));
        $inquiry->status = '1';
        $inquiry->save();

        return "1";

    }
    public function lead_customer(Request $request){

        $inquiry = Quatataion::findorfail($request->input('inquiry_id'));
        $inquiry->status = '3';
        $inquiry->save();
        
        $Customer = New Customer;
        $Customer->name = $inquiry->fullname;
        $Customer->address = $inquiry->address;
        $Customer->contactno = $inquiry->contact;
        $Customer->business_name = $inquiry->company;
        $Customer->save();

        return "1";


    }

    public function inquiry_delete(Request $request){

        $inquiry = Quatataion::findorfail($request->input('inquiry_id'));
        $inquiry->delete();
        
        return "1";

    }




}

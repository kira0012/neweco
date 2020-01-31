<?php

namespace App\Http\Controllers\ecocorp\Jobs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JobOrder;
use App\Model\JoCategory;
use App\Model\JoPayment;
use App\PaymentType;
use App\Model\BankAccount;
use App\Model\TransactionDenomination;
use App\Model\BankTransaction;
use DB;
use auth;

class JobOrderController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    } 
    
    public function vjo_list(){

        $jocats = JoCategory::all();

        $jos = JobOrder::join('jo_categories','job_orders.cat_id','=','jo_categories.id')
        ->select('job_orders.*','jo_categories.category')
        ->where('job_orders.status','!=','3')->get();

        $jo_count = JobOrder::where('status','!=','3')->count();

        $jo_recievables = JobOrder::sum('amount') - JoPayment::sum('amount');

       // return $jo_recievables;

        $today = date('Y-m-d');

      //  return $today;
        return view('pages.JobOrder.jo-list')
        ->with('today',$today)
        ->with('jos',$jos)
        ->with('jo_count',$jo_count)
        ->with('jo_recievables',$jo_recievables)
        ->with('jocats',$jocats);
    }

    public function new_jo(Request $request){

       // return $request->all();

        $jo = New JobOrder;
        $jo->customer = $request->input('jo_customer');
        $jo->cat_id = $request->input('jo_cat');
        $jo->jo_date = $request->input('jo_date');
        $jo->description = $request->input('description');
        $jo->amount = $request->input('jo_amount');
        $jo->cost = $request->input('jo_cost');
        $jo->status = '0';
        $jo->post_by = auth()->user()->id;
        $jo->save();

        session()->flash('success','Job Order Successfully Added');
        return redirect('/job-order/list');  

       
    }

    public function update_jo(Request $request){

        //return $request->all();
        $id = $request->input('jo_id');

        $jo = JobOrder::findorfail($id);
        $jo->customer = $request->input('jo_customer');
        $jo->cat_id = $request->input('jo_cat');
        $jo->jo_date = $request->input('jo_date');
        $jo->description = $request->input('description');
        $jo->amount = $request->input('jo_amount');
        $jo->cost = $request->input('jo_cost');
        $jo->status = $request->input('jo_status');
        $jo->post_by = auth()->user()->id;
        $jo->save();

        session()->flash('success','Job Order Successfully Updated');
        return redirect('/job-order/list');  


    }

    public function jo_history(){
     
        $jos = JobOrder::join('jo_categories','job_orders.cat_id','=','jo_categories.id')
        ->select('job_orders.*','jo_categories.category')
        ->where('job_orders.status','=','3')->get();

        $month = date('m');
        $mon = ltrim($month, '0');

        $ongoing = JobOrder::where('status','!=','3')
        ->where(db::raw('month(jo_date)'),'=',$mon)->count();

        $done = JobOrder::where('status','=','3')
        ->where(db::raw('month(jo_date)'),'=',$mon)->count();

        return view('pages.JobOrder.jo-history')
        ->with('ongoing',$ongoing)
        ->with('done',$done)
        ->with('jos',$jos);
    }

    public function jo_delete($id){

        $jo = JobOrder::findorfail($id);

        if ($jo->status == '0') {
            # code...
            $jo->delete();

            return "1";
            
        }else{
            
            return "bayad na bawal delete";
        }

    }

    public function jo_byid($id){

        $report = JobOrder::findorfail($id);

        return $report;

    }

    public function jo_bycat($cid){

        $report = JobOrder::where('cat_id','=',$cid)
        ->where('status','=','0')
        ->get();

        return $report;
    }

    public function vjo_cat(){

        $jocats = JoCategory::all();



        return view('pages.JobOrder.jo-cat')
        ->with('jocats',$jocats);

    }

    public function new_jocat(Request $request){

        $jocat = New JoCategory;
        $jocat->category = $request->input('jo-cat');
        $jocat->description = $request->input('description');
        $jocat->save();

        session()->flash('success','Job Order Category Successfully Added');
        return redirect('/job-order/category');  

    }

    public function update_jocat(Request $request){

    //    return $request->all();

        $cat_id = $request->input('cat_id');

        $cat = JoCategory::findorfail($cat_id);
        $cat->category = $request->input('category');
        $cat->description = $request->input('description');
        $cat->save();

        session()->flash('success','Job Order Category Successfully Updated');
        return redirect('/job-order/category');  

      
    }

    public function vjo_payment(){

        $jocats = JoCategory::all();
        $jo_count = JobOrder::where('status','=','0')->count();
        $jo_recievables = JobOrder::where('status','=','0')->sum('amount');
        $today = date('Y-m-d');
        $p_type = PaymentType::all();

        $payments = JoPayment::join('job_orders','job_orders.id','=','jo_payments.jo_id')
        ->join('jo_categories','job_orders.cat_id','=','jo_categories.id')
        ->select('jo_payments.*','job_orders.description',db::raw('job_orders.id as jo_id'),'jo_categories.category','job_orders.jo_date','job_orders.customer')
        ->get();
        //return $payments;
        $banks = BankAccount::all();



        return view('pages.JobOrder.jo-payment')
        ->with('today',$today)
        ->with('p_type',$p_type)
        ->with('jo_count',$jo_count)
        ->with('payments',$payments)
        ->with('banks',$banks)
        ->with('jo_recievables',$jo_recievables)
        ->with('jocats',$jocats);

    }


    public function new_payment(Request $request){


       // return $request->all();

        $jid = $request->input('jo_id');
        $payment_type = $request->input('payment_type');
        $uid = auth()->user()->id;
        $payment = New JoPayment;

        if ($payment_type == '1') {
            # code...
            //cash
            $payment->jo_id = $request->input('jo_id');
            $payment->payment_date = $request->input('jo_date');
            $payment->amount = $request->input('jo_paid');
            $payment->recieve_by = $uid;
            $payment->status = '1';
            $payment->remarks = $request->input('jo_premarks');
            $payment->$payment_type;
            $payment->save();

            $denomination = New TransactionDenomination;
            $denomination->trans_id = $payment->id;
            $denomination->group_id = '2';
            $denomination->ca1000 = $request->input('dem1000');
            $denomination->ca500 = $request->input('dem500');
            $denomination->ca200 = $request->input('dem200');
            $denomination->ca100 = $request->input('dem100');
            $denomination->ca50 = $request->input('dem50');
            $denomination->ca20 = $request->input('dem20');
            $denomination->ca10 = $request->input('dem10');
            $denomination->ca5 = $request->input('dem5');
            $denomination->ca1 = $request->input('dem1');
            $denomination->ca025c = $request->input('dem025');
            $denomination->ca010c = $request->input('dem010');
            $denomination->ca05c = $request->input('dem005');
            $denomination->save();
        } 
        if ($payment_type == '2'){
            # code...
            //cheque
            $payment->jo_id = $request->input('jo_id');
            $payment->payment_date = $request->input('jo_date');
            $payment->amount = $request->input('jo_paid');
            $payment->checkno = $request->input('cheque_no');
            $payment->payee = $request->input('payee_name');
            $payment->recieve_by = $uid;
            $payment->remarks = $request->input('jo_premarks');
            $payment->status = '1';
            $payment->$payment_type;
            $payment->save();
        }


        if ($payment_type == '3'){
            # code...
            //cheque
            $payment->jo_id = $request->input('jo_id');
            $payment->payment_date = $request->input('jo_date');
            $payment->amount = $request->input('jo_paid');
            $payment->bank_id = $request->input('bankname');
            $payment->trans_no = $request->input('Transaction-no');
            $payment->recieve_by = $uid;
            $payment->remarks = $request->input('jo_premarks');
            $payment->status = '1';
            $payment->$payment_type;
            $payment->save();

            $bank = BankAccount::findorfail($request->input('bankname'));
                
            $trans = New BankTransaction;
            $trans->bank_id = $bank->id;
            $trans->transaction_date = $request->input('jo_date');
            $trans->trans_type = '1';
            $trans->amount = $request->input('jo_paid');
            $trans->balance = $bank->balance;
            $trans->process_by = auth()->user()->id;
            $trans->save();
        }

        if ($payment_type > '3') {
            # code...
            session()->flash('error','Job Order payment Not Supported in this Section');
            return redirect('/job-orders/payment');  
            
            
        }


        //check if fullypaid
        $balance = $this->job_order_balance($jid);

        // if ($balance == '0' ){
        //     # code...
        //     $jo_request = JobOrder::findorfail($jid);
        //     $jo_request->status = '1';
        //     $jo_request->save();
        // }
      

        session()->flash('success','Job Order payment Successfully Added');
        return redirect('/job-orders/payment');  
        
    }

    public function print_jo($jid){

        $jo = JobOrder::findorfail($jid);
        $service = JoCategory::findorfail($jo->cat_id);

        //return $service;

        return view('pages.JobOrder.print-jo-payment')
        ->with('jo',$jo)
        ->with('service',$service)
        ->with('jid',$jid);
    }

    public function posted_dated_payment(){

        $today = date('Y-m-d');
       $to = date('Y-m-d', strtotime($today. ' + 7 days'));
        $now = time();
        $your_date = strtotime($to);

        $datediff = $now - $your_date;

        $no_days = round($datediff / (60 * 60 * 24));
       

        $record = JoPayment::whereBetween('payment_date', [$today,$to])
                    ->where('checkno','!=',null)
                    ->get();

        return $record;
    }

    public function job_order_balance($jo_id){


        $total_paid = JoPayment::where('jo_id','=',$jo_id)
                        ->sum('amount');
    
        $jo = JobOrder::findorfail($jo_id);
      
        $balance = $jo->amount - $total_paid;

            return $balance;

    }

    public function jopayment_details($jid){


        $transaction = JoPayment::findorfail($jid);

        $did = TransactionDenomination::where('trans_id',$jid)->where('group_id','2')->value('id');
        $denomination = TransactionDenomination::findorfail($did);
        $job_order = JObOrder::findorfail($transaction->jo_id);



        return view('pages.JobOrder.jo-summary')
     
        ->with('transaction',$transaction)
        ->with('denomination',$denomination)
        ->with('job_order',$job_order);


    }

    public function jopayment_summary($jo_id){

        $job_order = JObOrder::findorfail($jo_id);

        return view('pages.jobOrder.jo-paymentsum')
        ->with('job_order',$job_order);
    }

    
}

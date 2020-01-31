<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
// use Illuminate\Database\Elequent\Collection;
use App\Http\Controllers\Controller;
use App\Model\BankAccount;
use App\Model\BankTransaction;
use App\Model\ChequeRequest;
use App\User;

class BankAccountController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    
    public function vbanks(){


       $banks = BankAccount::all();

      // return $banks;

        return view('pages.Transaction.Banking.bank-account')
        ->with('banks',$banks);

    }

    public function banking_transactions($bid){

        $records = BankTransaction::join('users','users.id','=','bank_transactions.process_by')
        ->select('bank_transactions.*','users.name')
        ->where('bank_transactions.bank_id','=',$bid)->get();

        return $records;

    }
    public function vbank_transaction(){

        $banks = BankAccount::distinct()->get('bank');

        $bank_accounts = BankAccount::all();
    
        // return $bank_accounts->banktransaction()->get();
       // return $bank_accoounts;
      
        $records = BankTransaction::join('bank_accounts','bank_transactions.bank_id','=','bank_accounts.id')
        ->select('bank_transactions.*','bank_accounts.bank','bank_accounts.bank_account')
        ->get();

        //return $records;

        //return $banks;
        //return $this->update_balance(1);
        return view('pages.Transaction.Banking.bank-transaction')
        ->with('banks',$banks)
        ->with('bank_accounts',$bank_accounts)
        ->with('records',$records);
    }

    public function new_bankaccount(Request $request){

     

        $Bank = new BankAccount;
        $Bank->bank = $request->input('bankname');
        $Bank->bank_account = $request->input('bankaccount');
        $Bank->bank_holder = $request->input('holder');
        $Bank->currency = $request->input('currency');
        $Bank->balance = '0';
        $Bank->save();

        session()->flash('success','Bank Account Successfully Added');
        return redirect('/bank-accounts');   

    }

    public function posted_dated_payment(){

        $today = date('Y-m-d');

        $records = BankTransaction::join('bank_accounts','bank_transactions.bank_id','=','bank_accounts.id')
        ->select('bank_transactions.*','bank_accounts.bank','bank_accounts.bank_account')
        ->where('transaction_date','>=',$today)
        ->where('cheque_no','!=',null)
        ->where('payee','!=',null)
        ->get();

        return $records;
    }

    public function get_bankaccounts($bank){

        $bank_accounts = BankAccount::where('bank','=',$bank)->get();

        return $bank_accounts;
    }

    public function my_bankaccount($bid){


        $bank = BankAccount::findorfail($bid);
        return $bank;

    }

    public function update_balance($bid){

        $today = date('Y-m-d');

        $deposit = BankTransaction::where('bank_id','=',$bid)
        ->where('trans_type','=','1')
        ->where('transaction_date','<=',$today)
        ->sum('amount');

        $withdraw = BankTransaction::where('bank_id','=',$bid)
        ->where('trans_type','=','2')
        ->where('transaction_date','<=',$today)
        ->sum('amount');


        $balance = $deposit - $withdraw;

        $bank = BankAccount::findorfail($bid);
        $bank->balance = $balance;
        $bank->save();

        

        return $balance;
    }

    public function update_balance_transaction($trans_id){

        $transaction = BankTransaction::findorfail($trans_id);

        $deposit = BankTransaction::where('bank_id','=',$transaction->bank_id)
        ->where('trans_type','=','1')
        ->where('id','<=',$trans_id)
        ->sum('amount');

        $withdraw = BankTransaction::where('bank_id','=',$transaction->bank_id)
        ->where('trans_type','=','2')
        ->where('id','<=',$trans_id)
        ->sum('amount');



        $balance = $deposit - $withdraw;
        $transaction->balance = $balance;
        $transaction->save();
        $this->update_balance($transaction->bank_id);
    }

    public function transaction_info($tid){

        $record = BankTransaction::join('bank_accounts','bank_accounts.id','=','bank_transactions.bank_id')
        ->select('bank_transactions.*','bank_accounts.bank','bank_accounts.bank_account')
        ->where('bank_transactions.id','=',$tid)
        ->get();

        return response()->json($record);

    }


    public function add_transaction(Request $request){

    
        $bid = $request->input('bank_accounts');

        $bank = BankAccount::findorfail($bid);

        if ($request->input('trans_type') == '1') {
            # code...
            $balance = $bank->balance + $request->input('amount');
        } else {
            # code...
            $balance =   $bank->balance - $request->input('amount');
        }
        

        $trans = New BankTransaction;
        $trans->bank_id = $bid;
        $trans->transaction_date = $request->input('transactiondate');
        $trans->trans_type = $request->input('trans_type');
        $trans->term = $request->input('trans_term');
        $trans->amount = $request->input('amount');
        $trans->balance = $balance;
        $trans->cheque_no = $request->input('chequeno');
        $trans->payee = $request->input('payee');
        $trans->process_by = auth()->user()->id;
        $trans->remarks = $request->input('remarks');
        $trans->save();

        $this->update_balance($bid);


        
        session()->flash('success','Bank Transaction Successfully Added');
        return redirect('/bank-transactions');  

    }

    public function update_transaction(Request $request){

         //return $request->all();
        $trans = BankTransaction::findorfail($request->input('trans_id'));
        $trans->transaction_date = $request->input('transactiondate');
        $trans->trans_type = $request->input('trans_type');
        $trans->term = $request->input('trans_term');
        $trans->cheque_no = $request->input('chequeno');
        $trans->payee = $request->input('payee');
        $trans->process_by = auth()->user()->id;
        $trans->remarks = $request->input('remarks');
        $trans->save();

        $transactions = BankTransaction::where('bank_id','=',$trans->bank_id)->get();
        foreach ($transactions as $key => $value) {

            $this->update_balance_transaction($value->id);
        }
        $this->update_balance_transaction($request->input('trans_id'));



        session()->flash('success','Bank Transaction Successfully Updated');
        return redirect('/bank-transactions');  
    }

    public function remove_transaction(Request $request){

        $tid = $request->input('trans_id');
        $trans = BankTransaction::findorfail($tid);
        $bank_id = $trans->bank_id;
        $trans->delete();
        $this->update_balance($bank_id);

        $transactions = BankTransaction::where('bank_id','=',$bank_id)->get();
        foreach ($transactions as $key => $value) {

            $this->update_balance_transaction($value->id);
        }

        $done = 'Done';
        
        return response()->json($done);


    }


    public function transaction_summary($transdate){


        $reports = BankTransaction::join('bank_accounts','bank_transactions.bank_id','=','bank_accounts.id')
        ->select('bank_transactions.*','bank_accounts.bank','bank_accounts.bank_account','bank_accounts.balance')
        ->where('bank_transactions.transaction_date','=',$transdate)
        ->get();
    //    return $report;
      
        return view('pages.Reports.Financial.print-transum')
        ->with('transdate',$transdate)
        ->with('reports',$reports);
    }

    public function vcheque_request(){

        $today = date('Y-m-d');

        $rfcs = ChequeRequest::join('users','users.id','=','cheque_requests.request_by')
                ->select('cheque_requests.*','users.name')
                ->where('cheque_requests.status','=',0)
                ->get();


        $arfc = ChequeRequest::join('users','users.id','=','cheque_requests.request_by')
                ->select('cheque_requests.*','users.name')
                ->where('cheque_requests.status','!=',0)
                ->get();

        return view('pages.Transaction.Financial.cheque-request')
        ->with('today',$today)
        ->with('arfc',$arfc)
        ->with('rfcs',$rfcs);
       
    }

    public function cheque_voucher($vid){

        $voucher = ChequeRequest::findorfail($vid);
        $requestby = User::findorfail($voucher->request_by);

        if ($voucher->approved_by == null) {
            # code...
            $approvedby = "Not Yet Approved";

        } else {
            # code...
            $approvedby = User::findorfail($voucher->approved_by);
        }
      
        return view('pages.Transaction.Financial.cheque-voucher')
        ->with('voucher',$voucher)
        ->with('approvedby',$approvedby)
        ->with('requestby',$requestby);

    }

    public function cheque_details($id){

        $rfc = ChequeRequest::findorfail($id);

        return response()->json($rfc);
    }

    public function store_cheque_request(Request $request){

       // return $request->all();

        $rfc = new ChequeRequest;
        $rfc->request_date = $request->input('rdate');
        $rfc->payee = $request->input('payee');
        $rfc->remarks = $request->input('remarks');
        $rfc->amount = $request->input('amount');
        $rfc->status = 0;
        $rfc->request_by = auth()->user()->id;
        $rfc->save();

        session()->flash('success','Request Successfully Added');
        return redirect('/checque-request');  

    }

    public function update_cheque_request(Request $request){

        $vid = $request->input('vid');

        $rfc = ChequeRequest::findorfail($vid);
        $rfc->request_date = $request->input('rdate');
        $rfc->payee = $request->input('payee');
        $rfc->remarks = $request->input('remarks');
        $rfc->amount = $request->input('amount');
        $rfc->status = 0;
        $rfc->request_by = auth()->user()->id;
        $rfc->save();

        session()->flash('success','Request Successfully Updated');
        return redirect('/checque-request'); 
    }

    public function approved_voucher(Request $request){

            $vid = $request->input('vid');
            $action = $request->input('action');
            $today = date('Y-m-d');
            $rfc = ChequeRequest::findorfail($vid);
            $rfc->approved_date = $today;
            $rfc->status = $action;
            $rfc->approved_by = auth()->user()->id;
            $rfc->save();

            $status = 'done';
            return response()->json($status);

    }
    public function voucher_remove(Request $request){

        $vid = $request->input('vid');
        
        $rfc = ChequeRequest::findorfail($vid);
        $rfc->delete();

        $status = 'delete';

        return response()->json($status);
    }


}

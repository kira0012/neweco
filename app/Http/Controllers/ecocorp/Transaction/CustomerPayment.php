<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Warehouse;
use App\Model\StockRecord;
use App\Model\CustomerOrder;
use App\Model\CustomerProduct;
use App\Model\Unit;
use App\Model\Intransit;
use App\PaymentType;
use App\Model\TripSchedule;
use App\Model\OrderPayment;
use App\Model\BankAccount;
use App\Model\BankTransaction;
use App\Model\RemittanceCategory;
use App\Model\TransactionDenomination;
use App\Model\CustomerFund;
use App\Model\CaTransaction;
use App\Model\ExpenseCategory;
use App\Model\Expenses;
use auth;
use DB;

class CustomerPayment extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function vpayment(){

        $Recievables = CustomerOrder::leftjoin('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        //->join('intransits','customer_orders.id','intransits.dr_no')
        ->select('customer_orders.*','customers.business_name','customers.name','customers.address','payment_types.type')
        ->where('customer_orders.status','=','3')
        ->get();

        $Paid = CustomerOrder::leftjoin('order_payments','customer_orders.id','=','order_payments.drno')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        //->join('intransits','customer_orders.id','intransits.dr_no')
        ->select('customer_orders.*','customers.business_name','customers.name','customers.address','payment_types.type',db::raw('order_payments.id as payment_id'),db::raw('order_payments.status as payment_status'),'order_payments.payment_date',db::raw('order_payments.amount as amount_paid'))
        ->where('order_payments.status','=','1')
        ->get();

        $incometax = CustomerOrder::leftjoin('order_payments','customer_orders.id','=','order_payments.drno')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        //->join('intransits','customer_orders.id','intransits.dr_no')
        ->select('customer_orders.*','customers.business_name','customers.name','customers.address','payment_types.type',db::raw('order_payments.status as payment_status'),'order_payments.payment_date',db::raw('order_payments.amount as amount_paid'))
        ->where('order_payments.status','=','2')
        ->get();



        $categories = RemittanceCategory::all();
        $types = PaymentType::all();
        $today = date('Y-m-d');

        $amount_recievables = CustomerOrder::where('status','!=','9')->sum('balance');

        $m = date('m');
        $month = ltrim($m, '0');
        
        $income = OrderPayment::where(db::raw('month(payment_date)'),'=',$month)->sum('amount');
        $banks = BankAccount::all();
        //return $Recievables;

        return view('pages.Transaction.Payment.customer-payment')
        ->with('Recievables',$Recievables)
        ->with('Paid',$Paid)
        ->with('amount_recievables',$amount_recievables)
        ->with('income',$income)
        ->with('banks',$banks)
        ->with('incometax',$incometax)
        ->with('types',$types)
        ->with('categories',$categories)
        ->with('today',$today);
    }

    public function order_payment(Request $request){

      // return $request->all();

        $uid = auth()->user()->id;
        $type = $request->input('payment-type');
        $drno = $request->input('drno');
        $payment = New OrderPayment;

        if ($type == 'Cash') {
            # code...
                $payment->drno = $request->input('drno');
                $payment->payment_date = $request->input('payment_date');
                $payment->amount = $request->input('payment');
                $payment->recieve_by = $uid;
                $payment->status = '1';
                $payment->payment_desc = $type;
                $payment->Remarks = $request->input('premarks');
                $payment->remittance_id = $request->input('remittance');
                $payment->save();

                $denomination = New TransactionDenomination;
                $denomination->trans_id = $payment->id;
                $denomination->group_id = '1';
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
        if($type == 'Cheque') {
            # code...
            $payment->drno = $request->input('drno');
            $payment->payment_date = $request->input('payment_date');
            $payment->checkno = $request->input('cheque_no');
            $payment->payee = $request->input('payee_name');
            $payment->amount = $request->input('payment');
            $payment->status = '1';
            $payment->recieve_by = $uid;
            $payment->payment_desc = $type;
            $payment->Remarks = $request->input('premarks');
            $payment->remittance_id = $request->input('remittance');
            $payment->save();
        }
        if ($type == 'Direct Deposit') {
            # code...
                $payment->drno = $request->input('drno');
                $payment->payment_date = $request->input('payment_date');
                $payment->amount = $request->input('payment');
                $payment->recieve_by = $uid;
                $payment->status = '1';
                $payment->payment_desc = $type;
                $payment->bank_id = $request->input('bankname');
                $payment->trans_no = $request->input('Transaction-no');
                $payment->Remarks = $request->input('premarks');
                $payment->remittance_id = $request->input('remittance');
                $payment->save();

                $bank = BankAccount::findorfail($request->input('bankname'));
                
                $trans = New BankTransaction;
                $trans->bank_id = $bank->id;
                $trans->transaction_date = $request->input('payment_date');
                $trans->trans_type = '1';
                $trans->amount = $request->input('payment');
                $trans->balance = $bank->balance;
                $trans->process_by = auth()->user()->id;
                $trans->save();
                
        }

        if ($type == 'Cash Advance') {
            # code...

            $payment->drno = $request->input('drno');
            $payment->payment_date = $request->input('payment_date');
            $payment->amount = $request->input('payment');
            $payment->recieve_by = $uid;
            $payment->status = '1';
            $payment->payment_desc = $type;
            $payment->Remarks = $request->input('premarks');
            $payment->remittance_id = $request->input('remittance');
            $payment->save();

            $order = CustomerOrder::findorfail($payment->drno);
            $ctrans = New CaTransaction;
            $ctrans->drno = $order->id;
            $ctrans->transaction_id = $payment->id;
            $ctrans->customer_id = $order->customer_id;
            $ctrans->amount = $payment->amount;
            $ctrans->save();
     
        }

        if ($type == 'Withholding Tax') {
            # code...
            $payment->drno = $request->input('drno');
            $payment->payment_date = $request->input('payment_date');
            $payment->amount = $request->input('payment');
            $payment->recieve_by = $uid;
            $payment->status = '2';
            $payment->payment_desc = $type;
            $payment->Remarks = $request->input('premarks');
            $payment->remittance_id = $request->input('remittance');
            $payment->save();

        }

        if ($type == 'Commission') {
            # code...

            $payment->drno = $request->input('drno');
            $payment->payment_date = $request->input('payment_date');
            $payment->amount = $request->input('payment');
            $payment->recieve_by = $uid;
            $payment->status = '3';
            $payment->payment_desc = $type;
            $payment->Remarks = $request->input('premarks');
            $payment->remittance_id = $request->input('remittance');
            $payment->save();

            $expenseid = ExpenseCategory::where('expenses','=','Commission')->value('id');

            if ($expenseid == null) {
                # code...

                $cat = new ExpenseCategory;
                $cat->expenses = 'Commission';
                $cat->description = 'Client/Employee Comission';
                $cat->save();

                $expense = New Expenses;
                $expense->expense_id = $cat->id;
                $expense->expense_date = $request->input('payment_date');
                $expense->amount = $request->input('payment');
                $expense->remarks = $request->input('premarks');
                $expense->process_by = auth()->user()->id;
                $expense->save();
            }else{            
                $expense = New Expenses;
                $expense->expense_id = $expenseid;
                $expense->expense_date = $request->input('payment_date');
                $expense->amount = $request->input('payment');
                $expense->remarks = $request->input('premarks');
                $expense->process_by = auth()->user()->id;
                $expense->save();
            }


        }

        $balance = $this->customer_balance($drno);

        if ($balance == 0) {
            # code...
            $amount_paid = OrderPayment::where('drno','=',$drno)->sum('amount');
            $Order = CustomerOrder::findorfail($drno);
            $Order->status = '4';
            $Order->balance = $Order->balance - $amount_paid;
            $Order->save();

        }
      
        
        session()->flash('success','Payment Successfully Added');
        return redirect('/transaction/payment');    


    }

    public function posted_dated_order(){

       $today = date('Y-m-d');
       $to = date('Y-m-d', strtotime($today. ' + 7 days'));
        $now = time();
        $your_date = strtotime($to);

        $datediff = $now - $your_date;

        $no_days = round($datediff / (60 * 60 * 24));
       

        $record = OrderPayment::whereBetween('payment_date', [$today,$to])
                    ->where('checkno','!=',null)
                    ->get();

        return $record;

}

public function customer_balance($drno){

    $dr = CustomerOrder::findorfail($drno);
    $amount_paid = OrderPayment::where('drno','=',$drno)->sum('amount');
    $balance = $dr->total_amount - $amount_paid;

    return $balance;
}

public function customer_afund($drno){

    $dr = CustomerOrder::findorfail($drno);

    $customer_id = $dr->customer_id;

    $customer = Customer::findorfail($customer_id);

    $total = $customer->myfunds()->sum('amount');
    $trans = $customer->ca_transaction()->sum('amount');

    //return $trans;

    $available = $total - $trans;

    return $available;

   
}

public function vcustomer_funds(){

    $customers = Customer::all();

    $transactions = CustomerFund::join('customers','customers.id','=','customer_funds.customer_id')
                    ->select('customer_funds.*','customers.name','customers.business_name')
                    ->get();

    return view('pages.Transaction.Customer.customer-funds')
    ->with('customers',$customers)
    ->with('transactions',$transactions);

}

public function transaction_list($tid){

    $customer = Customer::findorfail($tid);

  

    return view('pages.Transaction.Customer.fund-transaction')
    ->with('customer',$customer);
    

}
 
public function csfund_transaction($tid){

    $trans = CustomerFund::findorfail($tid);

    return $trans;
}

public function store_csfunds(Request $request){

        $request->validate([
            'trasns_date' => 'required',
            'customer_id' => 'required',
            'amount' => 'required',
        ]);

        $fund = New CustomerFund;
        $fund->transaction_date = $request->input('trasns_date');
        $fund->customer_id = $request->input('customer_id');
        $fund->amount = $request->input('amount');
        $fund->save();

        session()->flash('success','Customer Funds Successfully Added');
        return redirect('/transactions/customer-funds');
}

public function update_csfunds(Request $request){

    $request->validate([
        'tid' => 'required',
        'trasns_date' => 'required',
        'customer_id' => 'required',
        'amount' => 'required',
    ]);

        $fund = CustomerFund::findorfail($request->input('tid'));
        $fund->transaction_date = $request->input('trasns_date');
        $fund->customer_id = $request->input('customer_id');
        $fund->amount = $request->input('amount');
        $fund->save();

        session()->flash('success','Customer Funds Successfully Updated');
        return redirect('/transactions/customer-funds');

}




}

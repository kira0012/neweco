<?php

namespace App\Http\Controllers\ecocorp\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderPayment;
use App\Model\CustomerOrder;
use App\Model\BankAccount;
use App\Model\BankTransaction;
use App\Model\StoreRemittance;
use App\Model\Customer;
use App\Model\JobOrder;
use App\Model\PoDetail;
use App\Model\PoPayment;
use App\Model\Supplier;
use App\Model\TransactionDenomination;
use App\Model\ExpenseCategory;
use DB;

class FinancialController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //banking
    public function vbanking(){

        $report = db::table(db::raw('(SELECT transaction_date,count(id) as Total_Transaction FROM bank_transactions GROUP by(transaction_date))as Main'))
        ->leftjoin(db::raw('(select transaction_date, sum(amount) as deposit
        from bank_transactions WHERE trans_type = 1 '.'
        GROUP by(transaction_date)) as temp_deposit'),'temp_deposit.transaction_date','=','Main.transaction_date')
        ->leftjoin(db::raw('(select transaction_date, sum(amount) as withdraw
        from bank_transactions WHERE trans_type = 2 '.'
        GROUP by(transaction_date)) as temp_withdraw'),'temp_withdraw.transaction_date','=','Main.transaction_date')
        ->select('Main.transaction_date','Main.Total_Transaction','temp_deposit.deposit','temp_withdraw.withdraw')
        ->get();
        
        //return $report;
        //return $this->transaction_summary($from,$to);
        return view('pages.Reports.Financial.Bankingsum')
        ->with('report',$report);

    }

    public function transactions($from,$to){

        //to be continue here...
        $transactions = db::table('bank_transactions')
                        ->join('bank_accounts','bank_transactions.bank_id','=','bank_accounts.id')
                        ->select('bank_transactions.*','bank_accounts.bank')
                        ->whereBetween('bank_transactions.transaction_date',[$from,$to])
                        ->get();

                        return $transactions;   

    }

    public function transaction_summary($from,$to){

        $report = db::table('bank_accounts')
                  ->leftjoin(db::raw('(select bank_id, sum(amount) as deposit, count(id) as total_deposit
                  from bank_transactions WHERE trans_type = 1 and transaction_date BETWEEN '."'".$from."'".' and '."'".$to."'".'
                  GROUP by(bank_id)) as temp_deposit'),'temp_deposit.bank_id','=','bank_accounts.id')
                  ->leftjoin(db::raw('(select bank_id, sum(amount) as withdraw, count(id) as total_withdraw
                  from bank_transactions WHERE trans_type = 2 and transaction_date BETWEEN '."'".$from."'".' and '."'".$to."'".'
                  GROUP by(bank_id)) as temp_withdraw'),'temp_withdraw.bank_id','=','bank_accounts.id')
                  ->select('bank_accounts.bank','bank_accounts.bank_account','temp_deposit.deposit','temp_withdraw.withdraw',db::raw('(temp_withdraw.total_withdraw + temp_deposit.total_deposit) as total_transactions'))
                  ->get();

     return $report;

    } 

    public function vsales(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');

        return view('pages.Reports.Financial.sales-report')
        ->with('first',$first)
        ->with('last',$last);
    }

    public function income_sale($from,$to){

        $income = CustomerOrder::whereBetween('order_date',[$from,$to])
        ->where('status','!=','9')
        ->sum(db::raw('truncate(total_amount,2)'));

        $remittance = StoreRemittance::whereBetween('remittance_date',[$from,$to])
        ->sum('amount');
        
        $josale = JobOrder::whereBetween('jo_date',[$from,$to])
                    ->sum('amount');
    
        $sales = array(array(
            'category' => 'Orders',
            'sale' => $income
        ),
        array(
            'category' => 'Remittance',
            'sale' => $remittance
        ),
        array(
            'category' => 'Job Order Sale',
            'sale' => $josale
        )

    
    );

        // $test = db::table('job_orders')
        //         ->join('jo_categories','jo_categories.id','=','job_orders.cat_id')
        //         ->select('jo_categories.category',db::raw('sum(job_orders.amount) as sale'))
        //         ->whereBetween('job_orders.jo_date',[$from,$to])
        //         ->groupby('jo_categories.category')
        //         ->get();

        

        // $sales2 = $test->toArray();

        // $result = array_merge_recursive($sales,$sales2);

        // return $result;

        return $sales;
    }

    public function my_expenses($from,$to){


            $test = db::table('expenses')
                    ->join('expense_categories','expense_categories.id','=','expenses.expense_id')
                    ->select(db::raw('expense_categories.expenses as category, sum(expenses.amount) as expense'))
                    ->whereBetween('expenses.expense_date',[$from,$to])
                    ->groupby('expense_categories.expenses')
                    ->get();

                    // $purchase = db::table('po_payments')
                    // ->whereBetween('payment_date',[$from,$to])
                    // ->sum('amount');

                    $purchase = DB::table('customer_orders')
                    ->join(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense 
                    FROM customer_products INNER JOIN stock_records on 
                    customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
                    //->select('order_payments.drno','order_payments.payment_date','subtab.expense')
                    ->where('customer_orders.status','!=','9')
                    ->whereBetween('customer_orders.order_date',[$from,$to])
                    ->sum('subtab.expense');

                    $jo_expenses = JobOrder::whereBetween('jo_date',[$from,$to])
                    ->sum('cost');
    

            $po = array(array(
                'category' => 'Purchase Orders',
                'expense' => $purchase
            ),
            array(
                'category' => 'Job Orders Expenses',
                'expense' => $jo_expenses
            )
        );

            // $jo_expenses = db::table('job_orders')
            // ->join('jo_categories','jo_categories.id','=','job_orders.cat_id')
            // ->select('jo_categories.category',db::raw('sum(job_orders.cost) as expense'))
            // ->whereBetween('job_orders.jo_date',[$from,$to])
            // ->groupby('jo_categories.category')
            // ->get();

            $jo_expenses = JobOrder::whereBetween('jo_date',[$from,$to])
                            ->sum('cost');
            
            
                    // $expense_jo = $jo_expenses->toArray();

                    $expensestbl = $test->toArray();

                    // expense per cat
                    // $expensef = array_merge_recursive($expensestbl,$expense_jo);

                    //$expensef = array_merge_recursive($expensestbl,$expense_jo);

                    $expenses = array_merge_recursive($expensestbl,$po);

                    return $expenses;

    }

    public function my_netincome($from,$to){

    //    $income = $this->income_sale($from,$to);
    $income = CustomerOrder::whereBetween('order_date',[$from,$to])
    ->where('status','!=','9')
    ->sum('total_amount');

        $others = JobOrder::whereBetween('jo_date',[$from,$to])
        ->sum('amount');

        // $orders = OrderPayment::whereBetween('payment_date',[$from,$to])
        // ->sum('amount');

        $remittance = StoreRemittance::whereBetween('remittance_date',[$from,$to])
        ->sum('amount');

        //return $income;
        $sale =  $others + $remittance + $income;

        $expenses =  db::table('expenses')
                    ->join('expense_categories','expense_categories.id','=','expenses.expense_id')
                    ->select(db::raw('sum(expenses.amount) as expense'))
                    ->whereBetween('expenses.expense_date',[$from,$to])
                    ->value('expense');

                    $purchase = DB::table('customer_orders')
                    ->join(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense 
                    FROM customer_products INNER JOIN stock_records on 
                    customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
                    //->select('order_payments.drno','order_payments.payment_date','subtab.expense')
                    ->whereBetween('customer_orders.order_date',[$from,$to])
                    ->where('customer_orders.status','!=','9')
                    ->sum('subtab.expense');
            $jo_expense = db::table('job_orders')
            ->join('jo_categories','jo_categories.id','=','job_orders.cat_id')
            ->select(db::raw('sum(job_orders.cost) as expense'))
            ->whereBetween('job_orders.jo_date',[$from,$to])
            ->value('expense');

        // $purchase = db::table('po_payments')
        //             ->whereBetween('payment_date',[$from,$to])
        //             ->sum('amount');

        $net_income = $sale - ($expenses + $purchase + $jo_expense);


        return $net_income;

    }

    public function customer_drpayments($drno){

        $orders = CustomerOrder::findorfail($drno);
        $customer = Customer::findorfail($orders->customer_id);
        
        
    //     $payment = OrderPayment::findorfail(13);

    //    // return $payment->depositTobank;
    //     return $payment->depositTobank;


        return view('pages.Reports.Financial.payment-sum')
        ->with('customer',$customer)
        ->with('order',$orders);

    }

    public function supplier_popayments($po_id){

        $po_order = PoDetail::findorfail($po_id);
        $supplier = Supplier::findorfail($po_order->supplier_id);

        
        return view('pages.Reports.Financial.payment-posum')
        ->with('supplier',$supplier)
        ->with('po_order',$po_order);
    }

    public function drpayment_details($transid){
    
       $transaction = OrderPayment::findorfail($transid);
        $did = TransactionDenomination::where('trans_id','=',$transid)->where('group_id','=','1')->value('id');
         $orders = CustomerOrder::findorfail($transaction->drno);
         $customer = Customer::findorfail($orders->customer_id);
        
        if ($did == null) {
        
           
            return view('pages.Reports.Financial.payment-info')
            ->with('customer',$customer)
            ->with('transaction',$transaction)
            // ->with('denomination',$denomination)
            ->with('order',$orders);

        } else {
         
            $denomination = TransactionDenomination::findorfail($did);
            return view('pages.Reports.Financial.payment-info')
            ->with('customer',$customer)
            ->with('transaction',$transaction)
            ->with('denomination',$denomination)
            ->with('order',$orders);
        }
        

       
       
    }

    public function vcollection_report(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Financial.collection-report')
        ->with('first',$first)
        ->with('last',$last);
    }

    public function total_collection($from,$to){

        $response = db::table('order_payments')
                    ->select(db::raw('count(id) as qty'), 'payment_desc',db::Raw('sum(amount) as amount'))
                    ->whereBetween('payment_date',[$from,$to])
                    ->groupby('payment_desc')   
                    ->get();

                    return response()->json($response);
    }

    public function total_jocollection($from,$to){


        $response = db::table('jo_payments')
                    ->leftjoin('payment_types','jo_payments.payment_type','=','payment_types.id')
                    ->select(db::raw('count(jo_payments.id) as qty'), 'payment_types.type',db::raw('sum(jo_payments.amount) as amount'))
                    ->whereBetween('jo_payments.payment_date',[$from,$to])
                    ->groupby('payment_types.type')   
                    ->get();

                    return response()->json($response);
    }

    public function vexpenses_report(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Financial.expenses-report')
        ->with('first',$first)
        ->with('last',$last);
    }

    public function expenses_list($from,$to){

        $expenses = db::table('expenses')
        ->join('expense_categories','expense_categories.id','=','expenses.expense_id')
        ->select('expenses.*',db::raw('expense_categories.expenses as category'))
        ->whereBetween('expenses.expense_date',[$from,$to])
        ->orderby('expenses.expense_date','asc')
        ->get();

        return $expenses;
    }

    public function vexpenses_catreport(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        $category = ExpenseCategory::all();
        
        return view('pages.Reports.Financial.expensescat-report')
        ->with('category',$category)
        ->with('first',$first)
        ->with('last',$last);
    }

    public function expenses_category($from,$to,$catid){

        $expenses = db::table('expenses')
        ->join('expense_categories','expense_categories.id','=','expenses.expense_id')
        ->select('expenses.*',db::raw('expense_categories.expenses as category'))
        ->whereBetween('expenses.expense_date',[$from,$to])
        ->where('expenses.expense_id','=',$catid)
        ->orderby('expenses.expense_date','asc')
        ->get();

        return $expenses;
    }

    public function jocat_expenses($from,$to){

         $jo_expenses = db::table('job_orders')
            ->join('jo_categories','jo_categories.id','=','job_orders.cat_id')
            ->select('jo_categories.category',db::raw('sum(job_orders.cost) as expense'))
            ->whereBetween('job_orders.jo_date',[$from,$to])
            ->groupby('jo_categories.category')
            ->get();

            return $jo_expenses;
    }



  
}

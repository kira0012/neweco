<?php

namespace App\Http\Controllers\ecocorp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PoDetail;
use App\Model\CustomerOrder;
use App\Model\OrderPayment;
use App\Model\Quatataion;
use App\Model\StockRecord;
use DB;

class DashboardController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
       
        
    }
    
    public function vdashboard(){

        $date_today = date('Y-m-d');
       // return $date_today;

      
       $delivery_orders = CustomerOrder::where('status','=',1)
       ->orwhere('status','=',2)->count();
      // $pending_orders = CustomerOrder::where('status','=',0)->count();
       $purchase_order = PoDetail::where('order_status','=',0)->count();
       $intransit_order = CustomerOrder::where('status','=',3)->count();
       $warehouse_sum = $this->warehouse_stockvalue();
       $customer_inquiries = Quatataion::where('status','=',0)->count();
    

     $sales = $this->sale_monitoring($date_today);

     
 
     $to = date('Y-m-d', strtotime($date_today. ' + 7 days'));
        
     $totalstock = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
     ->join('products','products.id','=','stock_records.product_id')
     ->select('products.product_code',db::raw('sum(stock_records.cost * stock_records.stock) as total_value'),db::raw('sum(stock_records.available) as total_available'),'stock_records.product_id','products.product_name',
                 'products.description',db::raw('sum(stock_records.stock) as total_stock'))
     ->where('stock_records.stock','>','0')
     ->groupby('product_id','product_code','product_name','description')
     ->get();
      
        return view('pages.dashboard')
        ->with('intransit_order',$intransit_order)
        ->with('purchase_order',$purchase_order)
        //->with('pending_orders',$pending_orders)
        ->with('customer_inquiries',$customer_inquiries)
        ->with('to',$to)
        ->with('date_today',$date_today)
        ->with('sales',$sales)
        ->with('totalstock',$totalstock)
        ->with('warehouse_sum',$warehouse_sum)
        ->with('delivery_orders',$delivery_orders);
    }

   public function sale_monitoring($today){
        //kulang pa to ng weekly sales;

        $month = 0;
        $net_month = 0;
        
        $today_income = db::table('customer_orders')
                        ->where('order_date','=',$today)
                        ->where('status','!=','9')
                        ->sum('total_amount');


        $daily = $this->daily_income();
        
       
          
                foreach($daily as $key => $value){
                        $month += $value->income;
                        $net_month += $value->net_income;
                }

        $week = db::table('customer_orders')
                ->select(db::raw('week(order_date) as weeky'),'total_amount')
                ->where('status','!=','9')
                ->where(db::raw('week(order_date)'),'=',db::raw('week("'.$today.'")'))
                ->sum('total_amount');
                //->groupby('weeky')
                //->get();

                        // return $week;

                        $net_today = db::table('customer_orders')
                        ->leftjoin(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense FROM customer_products INNER JOIN stock_records on customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
                        ->select(db::raw('sum(customer_orders.total_amount) - sum(subtab.expense) as net_income'))
                        ->where('customer_orders.order_date','=',$today)
                        ->where('status','!=','9')
                        ->value('net_income');

                        
                        $net_week = db::table('customer_orders')
                        ->leftjoin(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense FROM customer_products INNER JOIN stock_records on customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
                        ->select(db::raw('sum(customer_orders.total_amount) - sum(subtab.expense) as net_income'))
                        ->where(db::raw('week(order_date)'),'=',db::raw('week("'.$today.'")'))
                        ->where('status','!=','9')
                        ->value('net_income');
    
        $record = [
                'today' => $today_income,
                'net_today' => $net_today,
                'week' => $week,
                'net_week' => $net_week,
                'month' => $month,
                'net_month' => $net_month
        ];  
                
        return $record;


   }

    public function daily_income(){
        

        //sql pad string with zero 

        $month = date('m');
        $m = ltrim($month,'0');


        $sales = db::table('customer_orders')
        ->leftjoin(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense 
        FROM customer_products INNER JOIN stock_records on 
        customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
        ->select(db::raw('customer_orders.order_date as date,sum(customer_orders.total_amount) as income, sum(subtab.expense) as expense, (sum(customer_orders.total_amount) - sum(subtab.expense)) as net_income '))
        ->where('status','!=','9')
        ->where(db::raw('month(customer_orders.order_date)'),'=',$m)
        ->groupby('customer_orders.order_date')
        ->get();

        
      

        return $sales;





    }

    public function year_sale($year){

       $sales = db::table('customer_orders')
       ->select(db::raw('month(order_date) as nmon,monthname(order_date) as Month, sum(total_amount) as Sales'))
       ->where(db::raw('year(order_date)'),'=',$year)
       ->where('status','!=','9')
       ->groupby('Month','nmon')
       ->orderBy('nmon', 'Asc')
       ->get();

       return $sales;

    }

    public function month_net_income(){

        $month = date('m');

        $order_sale = db::table('customer_orders')
                        ->where(db::raw('month(order_date)'),'=',$month)
                        ->where('status','!=','9')
                        ->sum('total_amount');

        $jo_sale = db::table('job_orders')
                        ->select(db::raw('sum(amount) as jo_sales'))
                        ->where(db::raw('month(jo_date)'),'=',$month)
                        ->value('jo_sales');

        $remittance = db::table('store_remittances')
                        ->select(db::raw('sum(amount) as total'))
                        ->where(db::raw('month(remittance_date)'),'=',$month)
                        ->value('total');

        $sales = $order_sale + $jo_sale + $remittance;

        $sales_sub = array(
            array(
                'Category' => 'Order Sale',
                'Amount' => $order_sale
            ),
            array(
                'Category' => 'Job Order Sale',
                'Amount' => $jo_sale
            ),
            array(
                'Category' => 'Branch Remittance',
                'Amount' => $remittance
            )
           
            );

        $expenses1 = db::table('expenses')
                    ->select(db::raw('sum(amount) as expense_amount'))
                    ->where(db::raw('month(expense_date)'),'=',$month)
                    ->value('expense_amount');

        $expensedata = db::table('expenses')
                        ->join('expense_categories','expense_categories.id','=','expenses.expense_id')
                        ->select('expense_categories.expenses as Category',db::raw('sum(expenses.amount) as Amount'))
                        ->where(db::raw('month(expenses.expense_date)'),'=',$month)
                        ->groupby('expense_categories.expenses')
                        ->get();
                
      
                // $purchase = DB::table('po_payments')
                //             ->select(db::raw('sum(amount)'))
                //             ->where(db::raw('month(payment_date)'),'=',$month)
                //             ->value('amount');

                // $purchase = DB::table('order_payments')
                // ->join(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense 
                // FROM customer_products INNER JOIN stock_records on 
                // customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'order_payments.drno','=','subtab.dr_no')
                // //->select('order_payments.drno','order_payments.payment_date','subtab.expense')
                // ->where(db::raw('month(order_payments.payment_date)'),'=',$month)
                // ->sum('subtab.expense');

                $purchase = DB::table('customer_orders')
                ->join(db::raw('(SELECT customer_products.dr_no,sum(customer_products.qty * stock_records.cost) as expense 
                FROM customer_products INNER JOIN stock_records on 
                customer_products.stock_id = stock_records.id GROUP by(customer_products.dr_no))as subtab'), 'customer_orders.id','=','subtab.dr_no')
                //->select('order_payments.drno','order_payments.payment_date','subtab.expense')
                ->where(db::raw('month(customer_orders.order_date)'),'=',$month)
                ->where('customer_orders.status','!=','9')
                ->sum('subtab.expense');


                $jo_expenses = db::table('job_orders')
                ->join('jo_categories','jo_categories.id','=','job_orders.cat_id')
                ->select(db::Raw('jo_categories.category as Category'),db::raw('sum(job_orders.cost) as Amount'))
                ->where(db::raw('month(job_orders.jo_date)'),'=',$month)
                ->groupby('jo_categories.category')
                ->get();

                $p_array = array(
                    array (
                    'Category' => 'Purchasing',
                    'Amount' => $purchase
                    )
                );

                $expbeta = array_merge_recursive($jo_expenses->toarray(),$expensedata->toarray());

                $expense_sub = array_merge_recursive($expbeta,$p_array);

        $expenses = $expenses1 + $purchase;


        // final array..
            $net_income = array(
                array(
                    'Category' => "Sale",
                    'Amount' => $sales,
                    'sub' => $sales_sub
                    
                ),
                array(
                    'Category' => "Expenses",
                    'Amount' => $expenses,
                     'sub' => $expense_sub
                ));


        return response()->json($net_income);

    }

    public function today_sale(){

        $today = date('Y-m-d');

        $order_sale = db::table('customer_orders')
                ->select(db::raw('sum(total_amount) as order_sales'))
                ->where('order_date','=',$today)
                ->where('status','!=','9')
                ->value('order_sales');

        $jo_sale = db::table('job_orders')
                ->select(db::raw('sum(amount) as jo_sales'))
                ->where('jo_date','=',$today)
                ->value('jo_sales');

        $remittance = db::table('store_remittances')
                ->select(db::raw('sum(amount) as total'))
                ->where('remittance_date','=',$today)
                ->value('total');

                $sales_sub = array(
                    array(
                        'Category' => 'Order Sale',
                        'Amount' => $order_sale
                    ),
                    array(
                        'Category' => 'Job Order Sale',
                        'Amount' => $jo_sale
                    ),
                    array(
                        'Category' => 'Branch Remittance',
                        'Amount' => $remittance
                    )
                    );


                    return response()->json($sales_sub);
        
    }
}

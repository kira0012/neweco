<?php

namespace App\Http\Controllers\ecocorp\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CustomerOrder;
use App\Model\JobOrder;
use DB;

class SalesOrderController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth');       
    }

    public function index(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Salesorder.salesorder')
        ->with('first',$first)
        ->with('last',$last);
    }

    public function so_report($from,$to){

        $Orders = CustomerOrder::leftjoin('intransits','intransits.dr_no','=','customer_orders.id')
        ->leftjoin('pickup_orders','pickup_orders.drno','=','customer_orders.id')
        ->leftjoin('customers','customers.id','=','customer_orders.customer_id')
        ->leftjoin('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','intransits.trip_id','customers.address','customers.name','customers.business_name','payment_types.type','customer_orders.balance')
        ->where('customer_orders.status','=','4')
        ->whereBetween('customer_orders.order_date',[$from,$to])
        ->get();

        return $Orders;

    }

    public function jo_index(){

        
        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Salesorder.jobreport')
        ->with('first',$first)
        ->with('last',$last);
    }

    public function jo_report($from,$to){


        $jos = JobOrder::join('jo_categories','job_orders.cat_id','=','jo_categories.id')
        ->select('job_orders.*','jo_categories.category')
        ->whereBetween('job_orders.jo_date',[$from,$to])->get();

        return $jos;
    }

    public function recievables($item){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');

        if ($item == 'salesorder') {
            
        return view('pages.Reports.Salesorder.recievables-soreport')
        ->with('first',$first)
        ->with('last',$last);

        } 
        if($item == 'joborder') {
                 
            return view('pages.Reports.Salesorder.recievables-joreport')
            ->with('first',$first)
            ->with('last',$last);
        }

        return abort(404);
        
    }

    public function so_recievables($from,$to){

        $recievables = CustomerOrder::leftjoin('intransits','intransits.dr_no','=','customer_orders.id')
        ->leftjoin('pickup_orders','pickup_orders.drno','=','customer_orders.id')
        ->leftjoin('customers','customers.id','=','customer_orders.customer_id')
        ->leftjoin('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','intransits.trip_id','customers.address','customers.name','customers.business_name','payment_types.type','customer_orders.balance')
        ->where('customer_orders.balance','>','0')
        ->where('customer_orders.status','!=','9')
        ->whereBetween('customer_orders.order_date',[$from,$to])
        ->get();

        return $recievables;
    }

    public function jo_recievables($from,$to){

        
        $jos = JobOrder::join('jo_categories','job_orders.cat_id','=','jo_categories.id')
        ->leftjoin('jo_payments','jo_payments.jo_id','=','job_orders.id')
        ->select('job_orders.*','jo_categories.category',db::raw('IFNULL(sum(jo_payments.amount),0) as total_paid'),db::raw('job_orders.amount - IFNULL(sum(jo_payments.amount),0) as recievables'))
        ->groupby('job_orders.id')
        ->having('recievables','!=',0)
        ->whereBetween('job_orders.jo_date',[$from,$to])->get();

        return $jos;
    }
}

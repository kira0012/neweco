<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Schema;
use App\Model\DataHistory;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Product;
use App\Model\PoProduct;
use App\Model\PoDetail;
use App\Model\StockRecord;
use App\Model\Warehouse;
use App\Model\CustomerOrder;
use App\Model\CustomerProduct;
use App\Model\OrderPayment;
use App\User;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function log_history($table,$action,$datas,$userid){

        $columns = Schema::getColumnListing($table);

        $cols = array_diff($columns, array('created_at','updated_at'));
        // $data = unset($datas['created_at','updated_at']); 

        //return
       // return $cols;

        $cout = count($cols);

       

               // for ($i=0; $i < $cout; $i++) { 
                    $datalog = New DataHistory;
                    $datalog->action = $action;
                    $datalog->table = $table;
                    $datalog->data_id = $datas[$i];
                    $datalog->column = $datas[$i];
                    $datalog->columndata = $datas[$i];
                    $datalog->userid = $userid;
               // }

               return $datalog;
    }

    public function release_by($id){

        $name = User::where('id','=',$id)->value('name');

        return $name;
    }

    public function customer_details($id){

        $Customers = db::table('customers')
        ->leftjoin('users','customers.id','=','users.customer_id')
        ->select('customers.*','users.username')
        ->where('customers.id','=',$id)
        ->get();

        return $Customers;
    }

    public function supplier_products($sid){

        $Product = Product::where('supplier_id','=',$sid)->get();

        return $Product;
    }

    public function po_myorders($id){

        $Order_Products = PoProduct::join('products','products.id','=','po_products.products_id')
        ->join('units','units.id','=','products.unit')
        ->select('po_products.*','products.product_code','products.product_name','products.description','units.units')
        ->where('po_number','=',$id)->get();

        return $Order_Products;

    }

    public function update_mypo($po_id){

        $total_cost = PoProduct::where('po_number','=',$po_id)->sum('cost');
        $total_items = PoProduct::where('po_number','=',$po_id)->sum('product_qty');

        $Order = PoDetail::findorfail($po_id);
        $Order->total_cost = $total_cost;
        $Order->no_order = $total_items;
        $Order->save();

    }

    public function recieve_mypo($id){

        $today = date('Y-m-d');
        $Order = PoDetail::findorfail($id);
        $Order->order_status = 1;
        $Order->recieve_date = $today;
        $Order->save();
    }

    public function product_stock($pid){


        $stocks = StockRecord::where('product_id','=',$pid)
        ->where('stock','>','0')
        ->get();

        return $stocks;

    }

    public function product_available(){

        $report = StockRecord::join('products','products.id','=','stock_records.product_id')
        ->select('products.id', db::raw('sum(stock_records.available) as total'))
        ->where('stock_records.available','>','0')
        ->groupby('products.id')
        ->get();

        return $report;
    }

    public function warehouse_info($wid){

        $warehouse = Warehouse::findorfail($wid);

        return $warehouse;
    }

    public function warehouse_stockvalue(){

        $report = db::table('warehouses')
        ->leftjoin(db::raw('(select warehouse_id, sum(stock) as total_stock, 
                            sum(stock * cost) as total_value
                            from stock_records
                            GROUP by(warehouse_id)
                            )my_stocks'),'warehouses.id','=','my_stocks.warehouse_id')
                    ->select('warehouses.warehouse_name','my_stocks.total_stock','my_stocks.total_value')
                    ->get();

        return $report;
    }

    public function customer_orderlist($drno){

        $order_list = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        ->join('products','products.id','stock_records.product_id')
        ->join('units','units.id','=','products.unit')
        ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units','customer_products.qty',db::raw('customer_products.price * customer_products.qty as total'))
        ->where('customer_products.dr_no','=',$drno)
        ->get();

        return $order_list;
    }

    public function return_order($drno,$stock_id,$lqty){


        $upid = CustomerProduct::where('dr_no','=',$drno)
                                ->where('stock_id','=',$stock_id)
                                ->value('id');
        $payid = OrderPayment::where('drno','=',$drno)->value('id');
        
         $uporder = CustomerProduct::findorfail($upid);
         $uporder->qty = $uporder->qty - $lqty;
         $uporder->save(); 

         $payment = OrderPayment::findorfail($payid);
         $payment->amount = ($uporder->qty * $uporder->price);
         $payment->save();

         $drinfo = CustomerOrder::findorfail($drno);
         $drinfo->total_amount = $payment->amount;
         $drinfo->save();
           
    }
}

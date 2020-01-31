<?php

namespace App\Http\Controllers\ecocorp\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StockRecord;
use App\Model\Warehouse;
use App\Model\PoDetail;
use DB;
use auth;

class InventoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    
    public function vstock_onhand(){

        $stocks = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
                    ->join('warehouses','warehouses.id','=','stock_records.warehouse_id')
                    ->join('products','products.id','=','stock_records.product_id')
                    ->select('stock_records.*','products.product_code','products.product_name',
                                'products.description','warehouses.warehouse_name','warehouse_location',
                                'po_details.recieve_date')
                    ->where('stock_records.stock','>','0')
                    ->get();
        //return $stocks;

        $totalstock = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
        ->join('products','products.id','=','stock_records.product_id')
        ->select('stock_records.product_id','products.product_code',db::raw('sum(stock_records.cost * stock_records.stock) as total_value'),db::raw('sum(stock_records.available) as total_available'),'stock_records.product_id','products.product_name',
                    'products.description',db::raw('sum(stock_records.stock) as total_stock'))
        ->where('stock_records.stock','>','0')
        ->groupby('product_id','product_code','product_name','description')
        ->get();

    //return $totalstock;

        return view('pages.Reports.Inventory.stockonhand')
        ->with('stocks',$stocks)
        ->with('totalstock',$totalstock);
    }

    public function vstock_warehouse(){

        $warehouse = Warehouse::all();
        $today = date('Y-m-d');
        //return $warehouse;

        return view('pages.Reports.Inventory.stock-location')
        ->with('today',$today)
        ->with('warehouse',$warehouse);

    }
    public function warehouse_stocks($wid){


        $stocks = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
                    ->join('warehouses','warehouses.id','=','stock_records.warehouse_id')
                    ->join('products','products.id','=','stock_records.product_id')
                    ->select('stock_records.*','products.product_code','products.product_name',
                                'products.description','warehouses.warehouse_name','warehouse_location',
                                'po_details.recieve_date')
                    ->where('stock_records.stock','>','0')
                    ->where('stock_records.warehouse_id','=',$wid)
                    ->get();

                    return $stocks;

    }



    public function vwarehouse_audit(){
            //for update
        return view('pages.Reports.Inventory.warehouse-audit');
    }

    public function stock_total(){

        $totalstock = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
        ->join('products','products.id','=','stock_records.product_id')
        ->select('products.product_code',db::raw('sum(stock_records.cost * stock_records.stock) as total_value'),db::raw('sum(stock_records.available) as total_available'),'stock_records.product_id','products.product_name',
                    'products.description',db::raw('sum(stock_records.stock) as total_stock'))
        ->where('stock_records.stock','>','0')
        ->groupby('product_id','product_code','product_name','description')
        ->get();

        return view('pages.Reports.Inventory.stockp-print')
        ->with('totalstock',$totalstock);
    }

    public function do_index(){

        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Inventory.delivery-report')
        ->with('first',$first)
        ->with('last',$last);
    }
    public function do_reports($from,$to){

        $Paid = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->leftjoin('po_payments','po_payments.po_id','=','po_details.id')
        ->select('po_details.*',db::Raw('sum(po_payments.amount) as paided'),'suppliers.supplier')
        //->select('po_details.*','suppliers.supplier')

        ->groupby('po_details.id')
        //->where('po_details.order_status','=','1')
        ->whereBetween('po_details.order_date',[$from,$to])
        ->get();

        return $Paid;
    }
}

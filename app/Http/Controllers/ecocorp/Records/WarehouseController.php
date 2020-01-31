<?php

namespace App\Http\Controllers\ecocorp\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Warehouse;
use App\Model\StockRecord;
use auth;
use DB;

class WarehouseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function vwarehouse(){

        $warehouses = Warehouse::all();

        return view('pages.Records.warehouse')
        ->with('warehouses',$warehouses);
    }

    public function mywarehouse_infos($wid){

        $report = $this->warehouse_info($wid);

        return $report;

    }

    public function add_warehouse(Request $request){


        $warehouse = New Warehouse;
        $warehouse->warehouse_name = $request->input('warehouse');
        $warehouse->warehouse_location = $request->input('location');
        $warehouse->save();

        session()->flash('success','Warehouse Sucessfully Added');
        return redirect('/warehouse');

    }

    public function update_warehouse(Request $request){

       // return $request->all();

        $id = $request->input('wid');
        
        $warehouse = Warehouse::findorfail($id);
        $warehouse->warehouse_name = $request->input('warehouse');
        $warehouse->warehouse_location = $request->input('location');
        $warehouse->save();

        session()->flash('success','Warehouse Sucessfully Updated');
        return redirect('/warehouse');
    }

    public function products($id){

        $products = StockRecord::join('products','stock_records.product_id','=','products.id')
        ->select('products.*')
        ->where('stock_records.warehouse_id','=',$id)
        ->distinct('products.id')
        ->get();

        return $products;
    }

    public function products_stock($pid, $wid){


        $stocks = StockRecord::where('product_id','=',$pid)
                ->where('warehouse_id','=',$wid)
                ->get();

        return $stocks;
    }

    public function mystock($sid){

        $stock = StockRecord::findorfail($sid);

        return $stock;
    }


}

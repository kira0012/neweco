<?php

namespace App\Http\Controllers\ecocorp\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\PoProduct;
use App\Model\Warehouse;
use App\Model\StockRecord;
use App\User;
use auth;
use File;
use DB;

class StockInventory extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }
 
    public function index(){

        $mystocks = StockRecord::join('products','products.id','=','stock_records.product_id')
        ->join('warehouses','warehouses.id','=','stock_records.warehouse_id')
        ->select('stock_records.id','products.product_code','products.product_name','products.description','warehouses.warehouse_name','stock_records.stock','stock_records.available')
        ->get();

    

        return view('pages.Stocks.warehouse.stock-record')
        ->with('mystocks',$mystocks);


    }

    public function update_stock(Request $request){

        // return $request->all();

        $counter = count($request->input('stock_id'));
        $stock_ids = $request->input('stock_id');
        $stock_no = $request->input('stock');
        $stock_available = $request->input('available');


        for ($i=0; $i < $counter; $i++) { 
            $stock = StockRecord::findorfail($stock_ids[$i]);
            $stock->available = $stock_available[$i];
            $stock->stock = $stock_no[$i];
            $stock->save();
        }

        
        session()->flash('success','Stock Record Sucessfully Updated');
        return redirect('/stock-records');

    }
}

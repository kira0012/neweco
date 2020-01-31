<?php

namespace App\Http\Controllers\ecocorp\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\WatchProduct;
use App\Model\Unit;
use App\Model\StockRecord;
use App\SupplierProductReturn;
use App\SupplierReturnInfo;
use App\User;
use auth;
use File;
use DB;

class WatchlistController extends Controller
{
    //
    public function watchlist(){

        $watchlist = StockRecord::join('po_details','stock_records.po_id','=','po_details.id')
        ->join('products','products.id','=','stock_records.product_id')
        ->leftjoin('watch_products','watch_products.product_id','=','stock_records.product_id')
        ->select('stock_records.product_id','watch_products.watch_qty','products.product_code',db::raw('sum(stock_records.price * stock_records.stock) as total_value'),db::raw('sum(stock_records.available) as total_available'),'stock_records.product_id','products.product_name',
                    'products.description',db::raw('sum(stock_records.stock) as total_stock'))
        ->where('stock_records.stock','>','0')
        ->where('watch_products.status','=','1')
        ->groupby('product_id','product_code','product_name','description','watch_qty')
        ->get();

        return response()->json($watchlist);
        
    }

    public function add_watchlist(Request $request){

        $uid = auth()->user()->id;
        $pid = $request->input('pid');

        $chk = WatchProduct::where('product_id','=',$pid)->count();

        if ($chk == 1) {
            # code...
            $w = WatchProduct::findorfail($pid);
            $w->status = '1';
            $w->watch_qty = $request->input('wstock');
            $w->uid = $uid;
            $w->save();

            $response = 'Product Successfully Added To watchlist';
            
        
        } else {
            # code...
            $w = New WatchProduct;
            $w->product_id = $pid;
            $w->status = '1';
            $w->watch_qty = $request->input('wstock');
            $w->uid = $uid;
            $w->save();
            $response = 'Product Successfully Added To watchlist';
           
        }
        
        return response()->json($response);
    } 

    public function remove_towatlist(Request $request){

        $pid = $request->input('pid');
        $wid = WatchProduct::where('product_id','=',$pid)->value('id');
        $uid = auth()->user()->id;
        
        $w = WatchProduct::findorfail($wid);
        $w->status = '0';
        $w->uid = $uid;
        $w->save();

        $response = 'Product Successfully Remove To watchlist';
        return response()->json($response);
    }
}

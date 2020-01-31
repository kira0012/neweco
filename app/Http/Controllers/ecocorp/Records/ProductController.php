<?php

namespace App\Http\Controllers\ecocorp\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Vehicle;
use App\Model\Unit;
use App\Model\StockRecord;
use App\SupplierProductReturn;
use App\SupplierReturnInfo;
use App\User;
use auth;
use File;
use DB;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function add_product(Request $request){

        if($request->file('productimage') != null){
            $image = $request->file('productimage');
            $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
            $image->move('upload/products/img',$NewFilename);
            $imagePath = 'upload/products/img/'.$NewFilename;

            $Product = New Product;
            $Product->product_code = $request->input('product-code');
            $Product->product_name = $request->input('product-name');
            $Product->description = $request->input('product-description');
            $Product->supplier_id = $request->input('supplier');
            $Product->supplier_price = $request->input('supplier-price');
            $Product->srp = $request->input('srp');
            $Product->unit = $request->input('unit');
            $Product->Image = $imagePath;
            $Product->Save();

            }else{

                $Product = New Product;
                $Product->product_code = $request->input('product-code');
                $Product->product_name = $request->input('product-name');
                $Product->description = $request->input('product-description');
                $Product->supplier_id = $request->input('supplier');
                $Product->supplier_price = $request->input('supplier-price');
                $Product->srp = $request->input('srp');
                $Product->unit = $request->input('unit');
                $Product->Save();
            }

        
            session()->flash('success','Product Sucessfully Added');
            return redirect('/products');
   
    }
    public function getproduct($id){

        $product = Product::findorfail($id);
        
        return response()->json($product);
    }

    public function update_product(Request $request){

      // return $request->all();
        $id = $request->input('pid');

        $Product = Product::findorfail($id); 

        if($request->file('productimage') != null){
            $image = $request->file('productimage');
            $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
            $image->move('upload/products/img',$NewFilename);
            $imagePath = 'upload/products/img/'.$NewFilename;

                File::delete($Product->Image);
                $Product->product_code = $request->input('product-code');
                $Product->product_name = $request->input('product-name');
                $Product->description = $request->input('product-description');
                $Product->supplier_id = $request->input('supplier');
                $Product->supplier_price = $request->input('supplier-price');
                $Product->srp = $request->input('srp');
                $Product->unit = $request->input('unit');
                $Product->Image = $imagePath;
                $Product->save();
    
            }else{

                $Product->product_code = $request->input('product-code');
                $Product->product_name = $request->input('product-name');
                $Product->description = $request->input('product-description');
                $Product->supplier_id = $request->input('supplier');
                $Product->supplier_price = $request->input('supplier-price');
                $Product->srp = $request->input('srp');
                $Product->unit = $request->input('unit');
                $Product->save();
    
            }
           

     
            session()->flash('success','Product Sucessfully Updated');
            return redirect('/products');
    }

    public function vsend_back(){

        $Suppliers = Supplier::all();
        $Units = Unit::all();
        $returns = SupplierReturnInfo::join('suppliers','suppliers.id','=','supplier_return_infos.supplier_id')
        ->select('supplier_return_infos.*','suppliers.supplier')
        ->where('supplier_return_infos.status','=','0')
       
        ->get();

        $returned = SupplierReturnInfo::join('suppliers','suppliers.id','=','supplier_return_infos.supplier_id')
        ->select('supplier_return_infos.*','suppliers.supplier')
        ->where('supplier_return_infos.status','=','1')
        ->get();

        return view('pages.Stocks.warehouse.send-back')
                ->with('Suppliers',$Suppliers)
                ->with('returns',$returns)
                ->with('returned',$returned)
                ->with('Units',$Units);
    }

    public function less_stock($id,$qty){

        $StockRecords = StockRecord::findorfail($id);
        $StockRecords->available = ($StockRecords->available - $qty);
        $StockRecords->stock = ($StockRecords->stock - $qty);
    

    }

    public function add_stock($id,$qty){

        $StockRecords = StockRecord::findorfail($id);
        $StockRecords->available = ($StockRecords->available + $qty);
        $StockRecords->stock = ($StockRecords->stock + $qty);
    

    }

    public function backtosupplier(Request $request){

   //  return $request->all();

        $totalitems = count($request->input('padstockcodes'));
        $stocks = $request->input('stockcodes');
        $quantities = $request->input('rtnqties');
        $Supplier = $request->input('supplier-id');
        $returndate = $request->input('returndate');

       // return $totalitems;

        $returninfo = New SupplierReturnInfo;
        $returninfo->supplier_id = $Supplier;
        $returninfo->total_product = $totalitems;
        $returninfo->return_date = $returndate;
        $returninfo->remarks = $request->input('remarks');
        $returninfo->status = 0;
        $returninfo->uid = auth()->user()->id;
        $returninfo->save();

    //    return $this->less_stock(1,5);

        for ($i=0; $i < $totalitems; $i++) { 
            # code...
            $this->less_stock($stocks[$i],$quantities[$i]);

            $returnproduct = New SupplierProductReturn;
            $returnproduct->stock_id = $stocks[$i];
            $returnproduct->qty = $quantities[$i];
            $returnproduct->status = 0;
            $returnproduct->sreturn_id = $returninfo->id;
            $returnproduct->save();
                
        }
        return redirect('sendback/product-order');

          //  
    }

    public function recieve_myreturn(Request $request){
      
        $today = date('Y-m-d');
        $rtnid = $request->input('rtnid');

        $rtninfo = SupplierReturnInfo::findorfail($rtnid);
        $rtninfo->status = '1';
        $rtninfo->recieve_date = $today;
        $rtninfo->save();

        $products = SupplierProductReturn::where('sreturn_id','=',$rtnid)
                    ->where('status','=','0')
                    ->get();
        $chker = SupplierProductReturn::where('sreturn_id','=',$rtnid)
        ->where('status','=','0')
        ->count();


            if ($chker > 0) {
                # code...
                foreach ($products as $key => $product) {
                    # code...
                        $rid = $product['id'];

                        $return_product = SupplierProductReturn::findorfail($rid);
                        $return_product->status = '1';
                        $return_product->save();
                        $this->add_stock($return_product->stock_id,$return_product->qty);
                        
                }

                $res = "done";

                return response()->json($res); 

            }
                   

        $res = "Error";

        return response()->json($res);
        



    }

    public function recieve_returns($rtnid){

        $rtninfo = SupplierReturnInfo::findorfail($rtnid);
        $sid = $rtninfo->supplier_id;
        $uid = $rtninfo->uid;
        
        $rtnby = User::findorfail($uid);
        $Supplier = Supplier::findorfail($sid);

        $rtnproducts = SupplierProductReturn::join('stock_records','supplier_product_returns.stock_id','=','stock_records.id')
                    ->join('products','products.id','=','stock_records.product_id')
                    ->select('supplier_product_returns.*','products.product_name','products.description')
                    ->where('supplier_product_returns.sreturn_id','=',$rtnid)
                    ->get();

        

     return view('pages.Stocks.warehouse.etc.recieve-return')
     ->with('rtninfo',$rtninfo)
     ->with('rtnby',$rtnby)
     ->with('rtnid',$rtnid)
     ->with('rtnproducts',$rtnproducts)
     ->with('Supplier',$Supplier);

    }




}

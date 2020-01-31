<?php

namespace App\Http\Controllers\ecocorp\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Vehicle;
use App\Model\Unit;
use App\Model\PoDetail;
use App\Model\PoProduct;
use App\Model\Warehouse;
use App\Model\StockRecord;
use App\Model\TransferTicket;
use App\User;
use auth;
use File;
use DB;

class StockController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function vtransfer_stock(){

        $Warehouse = Warehouse::all();
        $today = date('Y-m-d');

        $mystocks = StockRecord::join('products','products.id','=','stock_records.product_id')
        ->join('warehouses','warehouses.id','=','stock_records.warehouse_id')
        ->select('stock_records.id','products.product_code','products.product_name','products.description','warehouses.warehouse_name','stock_records.stock')
        ->where('stock','>','0')->get();

        $transfer_tikets = TransferTicket::join('stock_records','stock_records.id','=','transfer_tickets.stock_id')
        ->join('products','products.id','=','stock_records.product_id')
        ->select('transfer_tickets.*','products.product_code','products.product_name','products.description')
        ->get();
    

       // return $transfer_tikets;

        return view('pages.Stocks.warehouse.transfer-stock')
        ->with('Warehouse',$Warehouse)
        ->with('mystocks',$mystocks)
        ->with('transfer_tickets',$transfer_tikets)
        ->with('today',$today);
    }

    public function transfer_stock(Request $request){

     //  return $request->all();

       $ini = $request->input('available');
       $no_transfer = $request->input('no_transfer');

       $new_stock = $ini - $no_transfer;

       $po_id = $request->input('stock_id');
       $mystock = StockRecord::findorfail($po_id);

       $mystock->stock = $new_stock;
       $mystock->save();

       $uid = auth()->user()->id;
       $Transfer = New TransferTicket;
       $Transfer->transfer_date = $request->input('transfer_date');
       $Transfer->from_wid = $request->input('from-warehouse');
       $Transfer->stock_id = $po_id;
       $Transfer->ini_qty = $ini;
       $Transfer->no_transfer = $no_transfer;
       $Transfer->to_wid = $request->input('transfer-to');
       $Transfer->status = 0;
       $Transfer->transfered_by = $uid;
       $Transfer->save();

       session()->flash('success','Transfer Ticket Successfully Created');
       return redirect('/transfer-stock');


    }

    public function ticket_info($id){


        $ticket = TransferTicket::join('stock_records','stock_records.id','=','transfer_tickets.stock_id')
        ->join('products','products.id','=','stock_records.product_id')
        ->select('transfer_tickets.*','products.product_code','products.product_name','products.description')
        ->where('transfer_tickets.id','=',$id)
        ->get();

        return $ticket;
    }

    public function vpurchase_order(){

        $Units = Unit::all();
        $Suppliers = Supplier::all();

        $Orders = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        ->where('po_details.order_status','=','0')
        ->where('po_details.p_status','=','0')
        ->get();

        $Recieved = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        ->where('po_details.order_status','=','1')
        ->where('po_details.p_status','=','0')
        ->get();

        $Paid = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        ->where('po_details.order_status','=','1')
        ->where('po_details.p_status','=','1')
        ->get();

        // return $Orders;
        

        return view('pages.Stocks.warehouse.purchase-order')
        ->with('Suppliers',$Suppliers)
        ->with('Orders',$Orders)
        ->with('Recieved',$Recieved)
        ->with('Paid',$Paid)
        ->with('Units',$Units);

    }

    public function add_po(Request $request){

        //return $request->all();

        $uid = auth()->user()->id;
        
        $no_items = array_sum($request->input('p_quantities'));
        $counter = count($request->input('products'));

        $Po_details = New PoDetail;
        $Po_details->order_date = $request->input('orderdate');
        $Po_details->supplier_id = $request->input('supplier-id');
        $Po_details->total_cost = $request->input('total_cost');
        $Po_details->remarks = $request->input('Remarks');
        $Po_details->no_order = $no_items;
        $Po_details->order_by = $uid;
        $Po_details->order_status = 0;
        $Po_details->p_status = 0;
        $Po_details->save();

        $po_id = $Po_details->id;

       $products = $request->input('products');
       $qty = $request->input('p_quantities');
       $cost = $request->input('sub_totals');
       $unit_price = $request->input('unit_price');

      // return $po_id;

    

        for ($i=0; $i < $counter; $i++) { 

            $Po_Product = New PoProduct;
            $Po_Product->po_number = $po_id;
            $Po_Product->products_id = $products[$i];
            $Po_Product->product_qty = $qty[$i];
            $Po_Product->cost = $cost[$i];
            $Po_Product->unit_price = $unit_price[$i];
            $Po_Product->save();

        }

        session()->flash('success','Purchased Order Sucessfully Added');
        return redirect('/delivery-order');

    }

    public function vpo_edit($id){


        $Order_Details = PoDetail::findorfail($id);
        $Supplier = Supplier::findorfail($Order_Details->supplier_id);
        $Order_Products = $this->po_myorders($id);
        $Units = Unit::all();
    

        return view('pages.Stocks.warehouse.etc.edit-po')
        ->with('Order_Products',$Order_Products)
        ->with('Supplier',$Supplier)
        ->with('Units',$Units)
        ->with('Order_Details',$Order_Details);
       
    }

    public function po_details($id){

        $Order_Details = PoDetail::findorfail($id);
        $Supplier = Supplier::findorfail($Order_Details->supplier_id);
        $Order_Products = $this->po_myorders($id);
        $Units = Unit::all();
        $preparedby = User::findorfail($Order_Details->order_by);

        return view('pages.Stocks.warehouse.etc.po-details')
        ->with('Order_Products',$Order_Products)
        ->with('Units',$Units)
        ->with('Supplier',$Supplier)
        ->with('preparedby',$preparedby)
        ->with('Order_Details',$Order_Details);
    }

    public function add_extrapo(Request $request){

        //return $request->all();

        $qty = $request->input('p-qty');
        $price = $request->input('price');
        $cost = $price * $qty;
        $po_id = $request->input('po_id');

        $Po_Product = New PoProduct;
        $Po_Product->po_number = $po_id;
        $Po_Product->products_id = $request->input('product_id');
        $Po_Product->product_qty = $qty;
        $Po_Product->cost = $cost;
        $Po_Product->unit_price = $price;
        $Po_Product->save();

        $this->update_mypo($po_id);


        session()->flash('success','Purchased Order Sucessfully Added');
        return redirect('/delivery-order/edit/'.$po_id);

    }

    public function get_poitem($id){

        $order = PoProduct::join('products','po_products.products_id','=','products.id')
        ->select('po_products.*','products.description','products.unit')
        ->where('po_products.id','=',$id)
        ->get();

        return $order;

    }

    public function update_po(Request $request){

        //return $request->all();

        $eid = $request->input('edit-id');
        $nqty = $request->input('p-qty');
        $nprice = $request->input('price');
        $pid = $request->input('p-id');
        $ncost = $nqty * $nprice;


        $item = PoProduct::findorfail($eid);
        $item->products_id = $pid;
        $item->product_qty = $nqty;
        $item->unit_price = $nprice;
        $item->cost = $ncost;
        $item->save();

        $po_id = $item->po_number;
        $this->update_mypo($po_id);


        session()->flash('success','Purchased Order Sucessfully Updated');
        return redirect('/delivery-order/edit/'.$po_id);
    }

    public function del_item($id){

        $item = PoProduct::findorfail($id);
        $po_id = $item->po_number;
        $item->delete();
        $this->update_mypo($po_id);

        return $po_id;

    }

    public function vrecieve_order(){


        $Units = Unit::all();
        $Suppliers = Supplier::all();

        $Orders = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        ->where('po_details.order_status','=','0')
        ->orderBy('id', 'DESC')
        ->get();

        $Recieved = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        ->where('po_details.order_status','=','1')
        ->orderBy('updated_at', 'DESC')
        ->get();

    

        return view('pages.Stocks.warehouse.recieve-order')
        ->with('Suppliers',$Suppliers)
        ->with('Orders',$Orders)
        ->with('Recieved',$Recieved)
        ->with('Units',$Units);
    }

    public function recieve_purchase_order($id){


        $Order_Details = PoDetail::findorfail($id);
        $Supplier = Supplier::findorfail($Order_Details->supplier_id);
        $Order_Products = $this->po_myorders($id);
        $Units = Unit::all();
        $Warehouse = Warehouse::all();
        $today = date('Y-m-d');

        //return $Order_Details;
        //return $Order_Products;

         return view('pages.Stocks.warehouse.etc.recieve-products')
        ->with('Order_Products',$Order_Products)
        ->with('Warehouse',$Warehouse)
        ->with('Units',$Units)
        ->with('today',$today)
        ->with('Supplier',$Supplier)
        ->with('Order_Details',$Order_Details);
    }

    public function add_stock(Request $request){

        //return $request->all();

        $wid = $request->input('warehouse-id');
        $po_id = $request->input('po_id');
        $product_ids = $request->input('product_id');
        $no_recieve = $request->input('recieve_no');
        $srp = $request->input('srp');
        $cost = $request->input('cost');
        $uid = auth()->user()->id;

        $counter = count($srp);

        for ($i=0; $i < $counter; $i++) { 
            # code...

            $Stock = new StockRecord;
            $Stock->po_id = $po_id;
            $Stock->warehouse_id = $wid;
            $Stock->product_id = $product_ids[$i];
            $Stock->no_recieve = $no_recieve[$i];
            $Stock->available = $no_recieve[$i];
            $Stock->stock = $no_recieve[$i];
            $Stock->price = $srp[$i];
            $Stock->cost = $cost[$i];
            $Stock->inserted_by = $uid;
            $Stock->save();
        }

        $this->recieve_mypo($po_id);


        session()->flash('success','Purchased Order Sucessfully Recieved');
        return redirect('/recieve-order');


    }


    public function allstock_product($pid){

        $stocks = $this->product_stock($pid);
        return $stocks;
    }

    public function available_stock(){

        $record = $this->product_available();

        return $record;

    }
}

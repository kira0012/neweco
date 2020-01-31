<?php

namespace App\Http\Controllers\ecocorp\Construction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Construction\MaterialOrder;
use App\Model\Construction\Material;
use App\Model\Construction\MaterialStock;
use App\Model\Construction\MaterialStockOut;
use App\Model\Construction\MaterialSupplier;
use App\Model\Construction\RecieveMaterial;
use App\Model\Construction\MaterialDelivery;
use App\Model\Unit;
use App\Model\Warehouse;
use App\User;
use DB;
use auth;
use File;

class EcoConsMaterialsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function vmaterials(){

        $materials = Material::join('units','materials.unit','=','units.id')
            ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
            ->select('materials.*',db::raw('material_suppliers.Supplier as supplier_name'),'units.units')
            ->get();

        $suppliers = MaterialSupplier::all();
        $units = Unit::all();

        // return $materials;

        return view('pages.Construction.cons-material')
        ->with('materials',$materials)
        ->with('suppliers',$suppliers)
        ->with('units',$units);
    }

    public function vmat_suppliers(){

        $suppliers = MaterialSupplier::all();

        return view('pages.Construction.cons-supplier')
        ->with('suppliers',$suppliers);
    }

    public function store_mat_supplier(Request $request){
     
        $supplier = New MaterialSupplier;
        $supplier->Supplier = $request->input('suppliername');
        $supplier->Address = $request->input('address');
        $supplier->email = $request->input('emailadd');
        $supplier->contact = $request->input('cellno');
        $supplier->contact_person = $request->input('contact_person');
        $supplier->c_number = $request->input('cp_no');
        $supplier->save();

        session()->flash('success','Supplier Successfully Added');
        return redirect('/Materials/Suppliers');    
        

    }



    public function store_material(Request $request){

        //return $request->all();

        if($request->file('productimage') != null){
            $image = $request->file('productimage');
            $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
            $image->move('upload/materials/img',$NewFilename);
            $imagePath = 'upload/materials/img/'.$NewFilename;

            $Product = New Material;
            $Product->Product_Code = $request->input('product-code');
            $Product->Product_Name = $request->input('product-name');
            $Product->Description = $request->input('product-description');
            $Product->supplier = $request->input('supplier');
            $Product->supplier_price = $request->input('supplier-price');
            $Product->srp = $request->input('srp');
            $Product->unit = $request->input('unit');
            $Product->uid = auth()->user()->id;
            $Product->product_image = $imagePath;
            $Product->Save();

            }else{

                $Product = New Material;
                $Product->Product_Code = $request->input('product-code');
                $Product->Product_Name = $request->input('product-name');
                $Product->Description = $request->input('product-description');
                $Product->supplier = $request->input('supplier');
                $Product->supplier_price = $request->input('supplier-price');
                $Product->srp = $request->input('srp');
                $Product->unit = $request->input('unit');
                $Product->uid = auth()->user()->id;
                $Product->Save();

            }

        
            session()->flash('success','Material Sucessfully Added');
            return redirect('/Materials');


    }

    public function material_info($mid){

        $materials = Material::join('units','materials.unit','=','units.id')
            ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
            ->select('materials.*',db::raw('material_suppliers.Supplier as supplier_name'),'units.units')
            ->where('materials.id','=',$mid)
            ->get();

            return $materials;
    }

    public function update_material(Request $request){

            if($request->file('productimage') != null){
                $image = $request->file('productimage');
                $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
                $image->move('upload/materials/img',$NewFilename);
                $imagePath = 'upload/materials/img/'.$NewFilename;

                $material = Material::findorfail($request->input('pid'));

                File::delete($material->product_image);
                $material->Product_Code = $request->input('product-code');
                $material->Product_Name = $request->input('product-name');
                $material->Description = $request->input('product-description');
                $material->supplier = $request->input('supplier');
                $material->supplier_price = $request->input('supplier-price');
                $material->srp = $request->input('srp');
                $material->unit = $request->input('unit');
                $material->uid = auth()->user()->id;
                $material->product_image = $imagePath;
                $material->Save();
            }else{
                $material->Product_Code = $request->input('product-code');
                $material->Product_Name = $request->input('product-name');
                $material->Description = $request->input('product-description');
                $material->supplier = $request->input('supplier');
                $material->supplier_price = $request->input('supplier-price');
                $material->srp = $request->input('srp');
                $material->unit = $request->input('unit');
                $material->uid = auth()->user()->id;
                $material->Save();

            }

            session()->flash('success','Material Sucessfully Updated');
            return redirect('/Materials');
            
    }

    public function mat_recieved_info(){

        $recieved_info = RecieveMaterial::join('material_suppliers','material_suppliers.id','=','recieve_materials.supplier_id')
        ->join('warehouses','warehouses.id','=','recieve_materials.warehouse_id')
        ->select('recieve_materials.*','material_suppliers.Supplier','warehouses.warehouse_name')
        ->get();

        return $recieved_info;
    }

    public function mat_stocks_list(){

        $stocks = MaterialStock::join('materials','materials.id','=','material_stocks.material_id')
        ->join('warehouses','warehouses.id','=','material_stocks.warehouse_id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->select('material_stocks.*','warehouses.warehouse_name','materials.Product_Code','materials.Product_Name','materials.Description')
        ->get();

        return $stocks;
    }

    public function stock_list_mat($mid){
        $stocks = MaterialStock::join('materials','materials.id','=','material_stocks.material_id')
        ->join('warehouses','warehouses.id','=','material_stocks.warehouse_id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->select('material_stocks.*','warehouses.warehouse_name','materials.Product_Code','materials.Product_Name','materials.Description')
        ->where('material_stocks.material_id','=',$mid)
        ->get();

        return $stocks;
    }


    public function stock_info($msid){

    
        $stocks = MaterialStock::join('materials','materials.id','=','material_stocks.material_id')
        ->join('units','units.id','=','materials.unit')
        ->join('warehouses','warehouses.id','=','material_stocks.warehouse_id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->select('material_stocks.*','units.units','warehouses.warehouse_name','materials.Product_Code','materials.Product_Name','materials.Description')
        ->where('material_stocks.id','=',$msid)
        ->get();

        return $stocks;
    }

    public function mat_stock_sum(){
        $stockall = MaterialStock::leftjoin('materials','materials.id','=','material_stocks.material_id')
        ->join('warehouses','warehouses.id','=','material_stocks.warehouse_id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->select('material_stocks.material_id','materials.Product_Code','materials.Product_Name','materials.Description',db::raw('sum(material_stocks.stock) as total_onhand, sum(material_stocks.srp) as total_value, sum(material_stocks.available) as total_available'))
        ->groupby('materials.Product_Name','materials.Product_Code','materials.Description','material_stocks.material_id')
        ->get();

        return $stockall;
        
    }


    public function vmaterials_recieve(){

        $suppliers = MaterialSupplier::all();
        $today = date('Y-m-d');
        $warehouse = Warehouse::all();

        $recieved_info = $this->mat_recieved_info();
        $stocks = $this->mat_stocks_list();      
        $stockall = $this->mat_stock_sum();


        return view('pages.Construction.cons-recieve')
        ->with('today',$today)
        ->with('stocks',$stocks)
        ->with('recieved_info',$recieved_info)
        ->with('warehouse',$warehouse)
        ->with('stockall',$stockall)
        ->with('suppliers',$suppliers);
    }


    public function list_materials_supplier($sid){

        $materials = Material::join('units','materials.unit','=','units.id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->select('materials.*',db::raw('material_suppliers.Supplier as supplier_name'),'units.units')
        ->where('material_suppliers.id','=',$sid)
        ->get();

        return $materials;

    }


    public function store_recived(Request $request){

        //return $request->all();
        //recieving of matterials
        $citems = count($request->input('materials'));

        $recieve = New RecieveMaterial;
        $recieve->recieved_date = $request->input('rdate');
        $recieve->supplier_id = $request->input('supplier');
        $recieve->total_cost = $request->input('total_cost');
        $recieve->item_recieved = $citems;
        $recieve->remarks = $request->input('remarks');
        $recieve->warehouse_id = $request->input('warehouse');
        $recieve->uid = auth()->user()->id;
        $recieve->save();


        for ($i=0; $i < $citems; $i++) { 
            # code...
            $mat_stock = New MaterialStock;
            $mat_stock->material_id = $request->input('materials')[$i];
            $mat_stock->recieve_id = $recieve->id;
            $mat_stock->no_recieved = $request->input('mat_qty')[$i];
            $mat_stock->warehouse_id = $request->input('warehouse');
            $mat_stock->price = $request->input('unit_price')[$i];
            $mat_stock->srp = $request->input('mat_srp')[$i];
            $mat_stock->stock = $request->input('mat_qty')[$i];
            $mat_stock->available = $request->input('mat_qty')[$i];
            $mat_stock->uid = auth()->user()->id;
            $mat_stock->save();

        }

        session()->flash('success','Material Stock Sucessfully Recieved');
        return redirect('/construction/recieve-materials');

    }   
    public function materials_onhand(){

        $stocks = $this->mat_stocks_list();      
        $stockall = $this->mat_stock_sum();


        return view('pages.Construction.cons-stockonhand')
            ->with('stocks',$stocks)
            ->with('stockall',$stockall);
    }

    public function print_recieve_data($rid){

        $recieve_data = RecieveMaterial::findorfail($rid);
        $supplier = MaterialSupplier::findorfail($recieve_data->supplier_id);
        $reciever = User::findorfail($recieve_data->uid);
        $warehouse = Warehouse::findorfail($recieve_data->warehouse_id);
      
       //return $recieve_data;

        $stocks = MaterialStock::join('materials','materials.id','=','material_stocks.material_id')
        ->join('warehouses','warehouses.id','=','material_stocks.warehouse_id')
        ->join('material_suppliers','material_suppliers.id','=','materials.supplier')
        ->join('units','materials.unit','=','units.id')
        ->select('material_stocks.*','units.units','warehouses.warehouse_name','materials.Product_Code','materials.Product_Name','materials.Description',db::raw('(material_stocks.no_recieved * material_stocks.price) as sub_total'))
        ->where('material_stocks.recieve_id','=',$rid)
        ->get();
        
        
        return view('pages.Construction.etc.print-recieved')
        ->with('recieve_data',$recieve_data)
        ->with('supplier',$supplier)
        ->with('stocks',$stocks)
        ->with('warehouse',$warehouse)
        ->with('reciever',$reciever);
    }

    public function vmat_order(){

        $suppliers = MaterialSupplier::all();
        $today = date('Y-m-d');
        $warehouse = Warehouse::all();

        $mat_ongoing = MaterialOrder::where('status','=',0)
                        ->get();

        $mat_del = MaterialDelivery::join('material_orders','material_orders.id','=','material_deliveries.order_id')
                                    ->select('material_deliveries.*','material_orders.Customer','material_orders.order_date')
                                    ->where('material_orders.status','=','1')
                                      ->get();


        return view('pages.Construction.cons-mat-order')
        ->with('today',$today)
        ->with('mat_ongoing',$mat_ongoing)
        ->with('warehouse',$warehouse)
        ->with('mat_del',$mat_del)
        ->with('suppliers',$suppliers);
    }

    public function my_material_order($mid){

        $mat = MaterialOrder::findorfail($mid);

        return $mat;
        

    }

    public function store_order(Request $request){

        $order = New MaterialOrder;
        $order->Customer = $request->input('cpname');
        $order->order_date = $request->input('rdate');
        $order->location = $request->input('dadd');
        $order->status = 0;
        $order->uid = auth()->user()->id;
        $order->remarks = $request->input('remarks');
        $order->save();

        
        session()->flash('success','Material Order Sucessfully Recorded');
        return redirect('/materials/cs-order');
    }

    public function update_order_info(Request $request){

        $order = MaterialOrder::findorfail($request->input('osid'));
        $order->Customer = $request->input('cpname');
        $order->order_date = $request->input('rdate');
        $order->location = $request->input('dadd');
        $order->status = 0;
        $order->uid = auth()->user()->id;
        $order->remarks = $request->input('remarks');
        $order->save();


        session()->flash('success','Material Order Sucessfully Updated');
        return redirect('/materials/cs-order');
    }

    public function add_to_order(Request $request){

            $order_stock = New MaterialStockOut;
            $order_stock->stock_id = $request->input('stockid');
            $order_stock->order_id = $request->input('osid');
            $order_stock->qty = $request->input('qty');
            $order_stock->mark_up = $request->input('srp');
            $order_stock->save();

            $stock = MaterialStock::findorfail($request->input('stockid'));
            $stock->available = ($stock->available - $request->input('qty'));
            $stock->save();
            
            $this->order_amount($request->input('osid'));
            $status = 'done';

            return response()->json($status);
            

    }

    public function order_amount($osid){

        $total = MaterialStockOut::where('order_id','=',$osid)
                ->select('order_id',db::raw('sum((qty * mark_up)) as total'))
                ->groupby('order_id')
                ->get();
        $subtotal = $total[0]['total'];

        $order = MaterialOrder::findorfail($osid);
        $order->total_amount = $subtotal;
        $order->save();
    }

    public function myorder_list($osid){

        $order = MaterialStockOut::leftjoin('material_stocks','material_stock_outs.stock_id','=','material_stocks.id')
                ->leftjoin('materials','materials.id','=','material_stocks.material_id')
                ->leftjoin('units','materials.unit','=','units.id')
                ->select('material_stock_outs.*','materials.Product_Code','materials.Product_Name','units.units','materials.Description')
                ->where('material_stock_outs.order_id','=',$osid)
                ->get();

            $this->order_amount($osid);
                return $order;
    }

    public function rmv_order($mid){


        $order = MaterialStockOut::findorfail($mid);
        $stock_id = $order->stock_id;
        
        $stock = MaterialStock::findorfail($stock_id);
        $stock->available = ($stock->available + $order->qty);
        $stock->save();

        $order->delete();
       
        $status = 'done';
        return response()->json($status);

        

    }
//deliver change status 

        public function mat_deliver(Request $request){

            $deliver = New MaterialDelivery;
            $deliver->order_id = $request->input('osid');
            $deliver->delivery_date = $request->input('ddate');
            $deliver->remarks = $request->input('remarks');
            $deliver->uid = auth()->user()->id;
            $deliver->save();

            $order = MaterialOrder::findorfail($request->input('osid'));
            $order->status = '1';
            $order->save();

            session()->flash('success','Material Order Sucessfully Set to Delivered');
            return redirect('/materials/cs-order');


        }

        public function vprint_delivery($did){    
           
            $delinfo = MaterialDelivery::findorfail($did);
            $orderinfo = MaterialOrder::findorfail($delinfo->order_id);
            $orderlist =  $this->myorder_list($delinfo->order_id);

            $prepared = User::findorfail($orderinfo->uid);
            $release = User::findorfail($delinfo->uid);
            $this->order_amount($delinfo->order_id);
            return view('pages.Construction.etc.print-delinfo')
            ->with('delinfo',$delinfo)
            ->with('orderinfo',$orderinfo)
            ->with('release',$release)
            ->with('prepared',$prepared)
            ->with('orderlist',$orderlist);
        }

}

<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Warehouse;
use App\Model\StockRecord;
use App\Model\CustomerOrder;
use App\Model\CustomerProduct;
use App\Model\Unit;
use App\Model\Intransit;
use App\Model\PickupOrder;
use App\PaymentType;
use App\Model\TripSchedule;
use App\Model\ReturnInfo;
use App\Model\ReturnItem;
use auth;
use DB;

class ShippmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function vpending(){

        $DrOrders = CustomerOrder::join('customers','customers.id','=','customer_orders.customer_id')
        ->select('customer_orders.*','customers.name','customers.address','customers.name','customers.business_name')
        ->where('status','=',0)
        ->get();


        return view('pages.Transaction.Shippment.pending-orders')
        ->with('DrOrders',$DrOrders);
    }

    public function fetch_pending($dono){

        $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        ->join('products','products.id','stock_records.product_id')
        ->join('units','units.id','=','products.unit')
        ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'),'stock_records.available')
        ->where('customer_products.dr_no','=',$dono)
        ->get();

        return $Drorders;
    }

    public function approve_pending(Request $request){

        //return $request->all();

        $do = $request->input('cid');

        $Order = CustomerOrder::findorfail($do);
        $Order->status = '1';
        $Order->save();

        
        return redirect('/customer/my-order/'.$do);
    }

    public function vcustomer_orders(){

        $customers = Customer::all();
        $Warehouse = Warehouse::all();
        $Products = Product::all();
        $DrOrders = CustomerOrder::join('customers','customers.id','=','customer_orders.customer_id')
        ->select('customer_orders.*','customers.name','customers.address','customers.name','customers.business_name')
        ->where('status','=',1)
        ->get();

        $StOrders = CustomerOrder::join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','customers.name','customers.address','customers.name','customers.business_name','payment_types.type')
        ->where('status','=',2)
        ->get();

        $today = date('Y-m-d');

        $TripTickets = TripSchedule::join('vehicles','vehicles.id','=','trip_schedules.vehicle_id')
        ->select('trip_schedules.*','vehicles.class','vehicles.model','vehicles.plateNo')
        //->where('trip_schedules.departure','>=',$today)
        ->get();

       
        return view('pages.Transaction.Shippment.customer-orders')
        ->with('Products',$Products)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$DrOrders)
        ->with('StOrders',$StOrders)
        ->with('TripTickets',$TripTickets)
        ->with('customers',$customers);
    }

    public function dr_totalamount($drno){

        $totalcost = db::table('customer_products')
        ->select(db::raw('sum(customer_products.price * customer_products.qty) as total_amount'))
        ->where('dr_no','=',$drno)
        ->value('total_amount');

        return $totalcost;


    }

    public function update_mydr($drno){


        $totalcost = $this->dr_totalamount($drno);
        $Counter = CustomerProduct::where('dr_no','=',$drno)->count();
        
        $CustomerDr = CustomerOrder::findorfail($drno);
        $CustomerDr->no_orders = $Counter;
        $CustomerDr->total_amount = $totalcost;
        $CustomerDr->balance = $totalcost;
        $CustomerDr->save();

    }

    public function view_order($drno){

     
        $DrDetails = CustomerOrder::findorfail($drno);
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $terms = PaymentType::where('id','=',$DrDetails->payment_terms)->value('type');
        $preparedby = $this->release_by($DrDetails->prepared_by);
        $releaseby = $this->release_by($DrDetails->release_by);

    

        $Drorders = $this->customer_orderlist($drno);
        
        // CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        // ->join('products','products.id','stock_records.product_id')
        // ->join('units','units.id','=','products.unit')
        // ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        // ->where('customer_products.dr_no','=',$drno)
        // ->get();
        
       // return $Drorders;


         $totalcost = $this->dr_totalamount($drno);
        
        

        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();
        
        

        return view('pages.Transaction.Shippment.print.view-myorder')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('releaseby',$releaseby)
        ->with('payments',$payments)
        ->with('preparedby',$preparedby)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$Drorders)
        ->with('terms',$terms)
        ->with('totalcost',$totalcost);

        


    }

    public function vmyorders_customer($drno){


        $DrDetails = CustomerOrder::findorfail($drno);
    
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $Drorders = $this->customer_orderlist($drno);
        // $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        // ->join('products','products.id','stock_records.product_id')
        // ->join('units','units.id','=','products.unit')
        // ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        // ->where('customer_products.dr_no','=',$drno)
        // ->get();

        

         $totalcost = $this->dr_totalamount($drno);

        $Products = Product::all();
        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();

       

        return view('pages.Transaction.Shippment.customer-orderlist')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('payments',$payments)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$Drorders)
        ->with('Products',$Products)
        ->with('totalcost',$totalcost);
        

    }



    public function add_myorder(Request $request){

           // return $request->all();

            $stock_id = $request->input('stock_id');
            $qty = $request->input('order-qty');
            $drno = $request->input('drno');

            $Stock = StockRecord::findorfail($stock_id);
            $Stock->avaialble;

            $new_available = $Stock->available - $qty;
            $Stock->available = $new_available;
            $Stock->save();

            $My_Order = New CustomerProduct;
            $My_Order->dr_no = $drno;
            $My_Order->stock_id = $request->input('stock_id');
            $My_Order->price = $request->input('price');
            $My_Order->qty = $qty;
            $My_Order->save();


            $this->update_mydr($drno);


            return redirect('/customer/my-order/'.$drno);

    }

    public function edit_myorder($id){

        $order = CustomerProduct::join('stock_records','customer_products.stock_id','stock_records.id')
        ->join('products','stock_records.product_id','=','products.id')
        ->select('customer_products.*','stock_records.product_id','products.product_code','stock_records.available','stock_records.warehouse_id',db::raw('customer_products.price * customer_products.qty as total'))
        ->where('customer_products.id','=',$id)
        ->get();

        return $order;

    }

    public function update_myorder(Request $request){

        //return $request->all();
        
        $drno = $request->input('drno');

        $nqty = $request->input('order-qty');
        $nprice = $request->input('price');
        $sid = $request->input('stock_id');

        //return $sid;

        $Stock = StockRecord::findorfail($sid);
        $Stock->available = $request->input('available');
        $Stock->save();

        //return $Stock;

        $id = $request->input('order-id'); 
        $MyOrder = CustomerProduct::findorfail($id);
        $MyOrder->price = $nprice;
        $MyOrder->qty = $nqty;
        $MyOrder->save();


        $this->update_mydr($drno);
        
        return redirect('/customer/my-order/'.$drno);
    }

    public function delete_order(Request $request){

        $cid = $request->input('cid');
        $order = CustomerOrder::findorfail($cid);
        $order->delete();

        $Products = CustomerProduct::where('dr_no','=',$cid);
        $Products->delete();

        session()->flash('success','Order Sucessfully Deleted');
        return redirect('/pending-orders');

    }


    public function remove_list($id){

        $toremove = CustomerProduct::findorfail($id);
        $addme = $toremove->qty;
        $drno = $toremove->dr_no;
        $stock_id = $toremove->stock_id;
        $toremove->delete();

        $Stock = StockRecord::findorfail($stock_id);
        $Stock->available = $Stock->available + $addme;
        $Stock->save();

        $chk = CustomerProduct::where('dr_no','=',$drno)->count();

        if($chk == 0){

            $RemoveDr = CustomerOrder::findorfail($drno);
            $RemoveDr->delete();

            
            return "0";
        }else{

            $this->update_mydr($drno);
            return "1";

        }
        
    }

    public function submit_order(Request $request){

       //return $request->all();

        $drno = $request->input('dr_no');
        $totalcost = $this->dr_totalamount($drno);
        $Counter = CustomerProduct::where('dr_no','=',$drno)->count();

       // return $Counter;
        
        $CustomerDr = CustomerOrder::findorfail($drno);
        $CustomerDr->payment_terms = $request->input('p-type');
        $CustomerDr->no_orders = $Counter;
        $CustomerDr->total_amount = $totalcost;
        $CustomerDr->balance = $totalcost;
        $CustomerDr->status = 2;
        $CustomerDr->prepared_by = auth()->user()->id;
        $CustomerDr->save();


        //change this return
        session()->flash('success','Order Sucessfully Set For Sorting Dr Created');
        return redirect('/customer-orders');
    }

    public function customer_dr(Request $request){
        
        // 0 pending
        // 1 for delivery
        // 2 for Sorting
        // 3 for Intransit
        // 4 done

        $today = date('Y-m-d');

        $Stock = StockRecord::findorfail($request->input('stock_id'));
        $Stock->avaialble;
        $qty = $request->input('order-qty');
        $new_available = $Stock->available - $qty;
        $Stock->available = $new_available;
        $Stock->save();

        $C_order = New CustomerOrder;
        $C_order->customer_id = $request->input('customer');
        $C_order->total_amount = $request->input('order-price');
        $C_order->balance = $request->input('order-price');
        $C_order->order_date = $today;
        $C_order->status = "1";
        $C_order->save();

        $drno = $C_order->id;

        $My_Order = New CustomerProduct;
        $My_Order->dr_no = $drno;
        $My_Order->stock_id = $request->input('stock_id');
        $My_Order->price = $request->input('price');
        $My_Order->qty = $qty;
        $My_Order->save();


        return redirect('/customer/my-order/'.$drno);
    }

    public function send_order(Request $request){

       // return $request->all();

        $drno = $request->input('dr-no');
        $tripticket = $request->input('trip-sched');
        $remarks = $request->input('remarks');
        $ship_type = $request->input('ship-type');

        $order_details = CustomerOrder::findorfail($drno);
        $order_details->status = '3';
        $order_details->release_by = auth()->user()->id;
        $order_details->save();

        if ($ship_type == '1') {
            $Trucking = New Intransit;
            $Trucking->trip_id = $tripticket;
            $Trucking->dr_no = $drno;
            $Trucking->Remarks = $remarks;
            $Trucking->status = '1';
            $Trucking->save();
        } else {
           $pickup = New PickupOrder;
           $pickup->drno = $drno;
           $pickup->Remarks = $remarks;
           $pickup->status = '0';
           $pickup->save();
        }

        $orders = CustomerProduct::where('dr_no','=',$drno)
        ->get();

        foreach ($orders as $key => $value) {
            # code...
            $stock_id = $value['stock_id'];
            $qty = $value['qty'];
            
            $new_stock = StockRecord::findorfail($stock_id);
            $new_stock->stock = ($new_stock->stock - $qty);
            $new_stock->save();
        }


        if ($ship_type == '1') {
            session()->flash('success','Order Sucessfully Set For Intransit');
            return redirect('/intransit-orders');
        } else {
            session()->flash('success','Order Sucessfully Set For Pick up');
             return redirect('/pickup-orders');
        }
        
      
    }

    public function recieve_pickup(Request $request){

        $id = $request->input('pickupid');

        $pickup = PickupOrder::findorfail($id);
       // $dr = CustomerOrder::findorfail($pickup->drno);

        if ($pickup->status == '1') {
            return "0";
        }
        
        $pickup->status = '1';
        $pickup->save();
        
       // $dr->status = '4';
        //$dr->save();

        return "1";
        
    }



    public function vintransit_orders(){
     

        $Orders = CustomerOrder::join('intransits','intransits.dr_no','=','customer_orders.id')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','intransits.trip_id','customers.address','customers.name','customers.business_name','payment_types.type')
        ->where('customer_orders.status','=','3')
        ->get();

        return view('pages.Transaction.Shippment.intransit-orders')
        ->with('Orders',$Orders);
    }

    public function vpickup_orders(){
     

        $Orders = CustomerOrder::join('pickup_orders','pickup_orders.drno','=','customer_orders.id')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','customers.address','customers.name','customers.business_name','payment_types.type',db::raw('pickup_orders.id as pickup_id'))
        //->where('customer_orders.status','=','3')
        ->where('pickup_orders.status','=','0')
        ->get();

        $Recieved = CustomerOrder::join('pickup_orders','pickup_orders.drno','=','customer_orders.id')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','customers.address','customers.name','customers.business_name','payment_types.type',db::raw('pickup_orders.id as pickup_id, pickup_orders.updated_at as recieve_date'))
        //->where('customer_orders.status','=','4')
        ->where('pickup_orders.status','=','1')
        ->get();

        return view('pages.Transaction.Shippment.pickup-orders')
        ->with('Orders',$Orders)
        ->with('Recieved',$Recieved);
    }

    

    public function print_drform($drno){

        $DrDetails = CustomerOrder::findorfail($drno);
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $terms = PaymentType::where('id','=',$DrDetails->payment_terms)->value('type');
        $preparedby = $this->release_by($DrDetails->prepared_by);
        $releaseby = $this->release_by($DrDetails->release_by);


        $tid = Intransit::where('dr_no','=',$drno)->value('trip_id');
        $tripsched = TripSchedule::findorfail($tid);


        $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        ->join('products','products.id','stock_records.product_id')
        ->join('units','units.id','=','products.unit')
        ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        ->where('customer_products.dr_no','=',$drno)
        ->get();


         $totalcost = $this->dr_totalamount($drno);
        
        
        // return $totalcost;

        $Products = $this->product_available();
        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();

        return view('pages.Transaction.Shippment.print.dr-form')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('releaseby',$releaseby)
        ->with('payments',$payments)
        ->with('preparedby',$preparedby)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$Drorders)
        ->with('tripsched',$tripsched)
        ->with('Products',$Products)
        ->with('terms',$terms)
        ->with('totalcost',$totalcost);

    }

    public function pickup_drform($drno){

        $DrDetails = CustomerOrder::findorfail($drno);
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $terms = PaymentType::where('id','=',$DrDetails->payment_terms)->value('type');
        $preparedby = $this->release_by($DrDetails->prepared_by);
        $releaseby = $this->release_by($DrDetails->release_by);


        $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        ->join('products','products.id','stock_records.product_id')
        ->join('units','units.id','=','products.unit')
        ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        ->where('customer_products.dr_no','=',$drno)
        ->get();


         $totalcost = $this->dr_totalamount($drno);
        
        
        // return $totalcost;

        $Products = $this->product_available();
        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();

        return view('pages.Transaction.Shippment.print.pickup-drform')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('releaseby',$releaseby)
        ->with('payments',$payments)
        ->with('preparedby',$preparedby)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$Drorders)
        ->with('Products',$Products)
        ->with('terms',$terms)
        ->with('totalcost',$totalcost);

    }


    public function print_tripform($drno){

        $DrDetails = CustomerOrder::findorfail($drno);
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $terms = PaymentType::where('id','=',$DrDetails->payment_terms)->value('type');
        $preparedby = $this->release_by($DrDetails->prepared_by);
        $releaseby = $this->release_by($DrDetails->release_by);

        $intra_id = Intransit::where('dr_no','=',$drno)->value('id');

        $intransits_record = Intransit::findorfail($intra_id);

        $tid = Intransit::where('dr_no','=',$drno)->value('trip_id');
        $tripsched = TripSchedule::findorfail($tid);

        $Drorders = $this->customer_orderlist($drno);

        // $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        // ->join('products','products.id','stock_records.product_id')
        // ->join('units','units.id','=','products.unit')
        // ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        // ->where('customer_products.dr_no','=',$drno)
        // ->get();


         $totalcost = $this->dr_totalamount($drno);
        
        
        // return $totalcost;

        $Products = $this->product_available();
        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();

        return view('pages.Transaction.Shippment.print.trip-form')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('releaseby',$releaseby)
        ->with('payments',$payments)
        ->with('preparedby',$preparedby)
        ->with('Warehouse',$Warehouse)
        ->with('DrOrders',$Drorders)
        ->with('tripsched',$tripsched)
        ->with('Products',$Products)
        ->with('terms',$terms)
        ->with('intransits_record',$intransits_record)
        ->with('totalcost',$totalcost);

    }


    public function intransit_pickup($drno){

        $DrDetails = CustomerOrder::findorfail($drno);
        $DrCustomer = Customer::findorfail($DrDetails->customer_id);

        $terms = PaymentType::where('id','=',$DrDetails->payment_terms)->value('type');
        $preparedby = $this->release_by($DrDetails->prepared_by);
        $releaseby = $this->release_by($DrDetails->release_by);

        $Drorders = $this->customer_orderlist($drno);

        $totalcost = $this->dr_totalamount($drno);
        
        $intra_id = PickupOrder::where('drno','=',$drno)->value('id');

        $intransits_record = PickupOrder::findorfail($intra_id);
      
        // return $totalcost;

        $Products = $this->product_available();
        $Warehouse = Warehouse::all();
        $Units = Unit::all();
        $payments = PaymentType::all();


        return view('pages.Transaction.Shippment.print.pickup-intransit')
        ->with('DrDetails',$DrDetails)
        ->with('DrCustomer',$DrCustomer)
        ->with('Units',$Units)
        ->with('releaseby',$releaseby)
        ->with('payments',$payments)
        ->with('preparedby',$preparedby)
        ->with('Warehouse',$Warehouse)
        ->with('intransits_record',$intransits_record)
        ->with('DrOrders',$Drorders)
        ->with('Products',$Products)
        ->with('terms',$terms)
        ->with('totalcost',$totalcost);



    }


    public function vshipped_orders(){
        $Orders = CustomerOrder::join('intransits','intransits.dr_no','=','customer_orders.id')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','intransits.trip_id','customers.address','customers.name','customers.business_name','payment_types.type')
        ->where('customer_orders.status','=','4')
        ->get();

    
        return view('pages.Transaction.Shippment.shipped-orders')
        ->with('Orders',$Orders);
    }

    public function order_return($drno){

        $Orders = CustomerOrder::join('customers','customers.id','=','customer_orders.customer_id')
        ->get();

        $Drorders = CustomerProduct::join('stock_records','stock_records.id','=','customer_products.stock_id')
        ->join('products','products.id','stock_records.product_id')
        ->join('units','units.id','=','products.unit')
        ->select('customer_products.*','products.product_code','products.product_name','products.description','units.units',db::raw('customer_products.price * customer_products.qty as total'))
        ->where('customer_products.dr_no','=',$drno)
        ->get();


        //return $Orders;
        return view('pages.Transaction.Shippment.order-return')
        ->with('Drorders',$Drorders)
        ->with('Orders',$Orders);
    }

    public function vcustomer_return(){

        
        $RtnInfo = ReturnInfo::where('status','=',0)->get();
        $Resolved = ReturnInfo::where('status','=','1')->get();


        //return $RtnInfo;

        return view('pages.Transaction.Shippment.return-product')
        ->with('RtnInfo',$RtnInfo)
        ->with('Resolved',$Resolved);


    }

    public function fetch_csorders($drno){

        $Drorders = $this->customer_orderlist($drno);

        return $Drorders;


    }

    public function fetch_returnitems($id){

        $items = ReturnItem::join('stock_records','stock_records.id','=','return_items.stock_id')
                            ->join('products','stock_records.product_id','=','products.id')
                            ->select('return_items.*','products.product_code','products.description','products.product_name')
                             ->where('return_items.rtn_id','=',$id)
            ->get();

            return $items;

    }

    public function resolve_return(Request $request){

        $rsv_id = $request->input('rsv_id');

        $items = ReturnItem::where('rtn_id','=',$rsv_id)->get();
        $update = ReturnInfo::findorfail($rsv_id);
        $update->status = '1';
        $update->save();

        $drno = $update->drno;



        foreach ($items as $key => $item) {
            # code...
            //return $value['stock_id'];
            switch ($item['action']) {
                case 'Return':
                    # code...
                    $sid = $item['stock_id'];
                    $stkid = StockRecord::findorfail($sid);
                    $stkid->stock = $stkid->stock + $item['qty'];
                    $stkid->available = $stkid->available + $item['qty'];
                    $stkid->save();

                    $this->return_order($drno,$item['stock_id'],$item['qty']);

                    $rid = ReturnItem::findorfail($item['id']);
                    $rid->status = '1';
                    $rid->save();
                    break;
                case 'Replace':
                    # code...
                    $rid = ReturnItem::findorfail($item['id']);
                    $rid->status = '1';
                    $rid->save();

                    break;
                case 'Disposed':
                        # code...

                        $sid = $item['stock_id'];
                        $stkid = StockRecord::findorfail($sid);
                        $stkid->stock = $stkid->stock - $item['qty'];
                        $stkid->available = $stkid->available - $item['qty'];
                        $stkid->save();

                        $rid = ReturnItem::findorfail($item['id']);
                        $rid->status = '1';
                        $rid->save();

                        break;
                
                default:
                    # code...
                    break;
            }
        }

        return response()->json('ok');

    }

    public function store_return(Request $request){

        //return $request->input('cs_action')[0];

       // return $request->all();

        $stock_ids = $request->input('stock_id');
        $qtys = $request->input('cs_qty');
        $action = $request->input('cs_action');

        $RtnInfo = New ReturnInfo;
        $RtnInfo->drno = $request->input('drno');
        $RtnInfo->customer = $request->input('cs_name');
        $RtnInfo->total_return = count($request->input('cs_qty'));
        $RtnInfo->remarks = $request->input('remarks');
        $RtnInfo->action_by = auth()->user()->id;
        $RtnInfo->status = '0';
        $RtnInfo->save();

        
        //return $RtnInfo;
        for ($i=0; $i < count($stock_ids) ; $i++) {
            $RtnItem = New ReturnItem;
            $RtnItem->rtn_id = $RtnInfo->id;
            $RtnItem->stock_id = $stock_ids[$i];
            $RtnItem->qty = $qtys[$i];
            $RtnItem->action = $action[$i];
            $RtnItem->status = '0';
            $RtnItem->save();
        }


        return redirect('/customer-order/return-order');
    }

    public function cancel_myorder(){

        $orders = CustomerOrder::join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','customers.name','customers.address','customers.name','customers.business_name','payment_types.type')
        ->where('status','=',9)
        ->get();

        return view('pages.Transaction.Shippment.canceled-orders')
                ->with('orders',$orders);
    }

    public function cancel_csorder(Request $request){


     $oid = $request->input('orderid');

     $order = CustomerOrder::findorfail($oid);
    
  
     switch ($order->status) {
         case '2':
             # code...

             $products = CustomerProduct::where('dr_no','=',$oid)->get();
            
             foreach ($products as $key => $product) {
                 # code...
                 $stock = StockRecord::findorfail($product['stock_id']);
                 $stock->available = $stock->available + $product['qty'];
                 $stock->save();
    
             }


             $orderinfo = CustomerOrder::findorfail($oid);
             $orderinfo->status = 9;
             $orderinfo->save();
             break;
        case '3':
            # code...
            $isintransit = Intransit::where('dr_no','=',$oid)->count();
                if ($isintransit == 0) {
                    # code...
                    $pickupid = PickupOrder::where('drno','=',$oid)->value('id');
                    $pickup = PickupOrder::findorfail($pickupid);
                    $pickup->status = 9;
                    $pickup->save();
                } else {
                    # code...
                    $intid = Intransit::where('dr_no','=',$oid)->value('id');
                    $intransit = Intransit::findorfail($intid);
                    $intransit->status = 9;
                    $intransit->save();
                } 

            $products = CustomerProduct::where('dr_no','=',$oid)->get();
            
            foreach ($products as $key => $product) {
                # code...
                $stock = StockRecord::findorfail($product['stock_id']);
                $stock->available = $stock->available + $product['qty'];
                $stock->stock = $stock->stock + $product['qty'];
                $stock->save();

                
            }

            $orderinfo = CustomerOrder::findorfail($oid);
            $orderinfo->status = 9;
            $orderinfo->save();

            break;
         
         default:
             # code...
             break;
     }

        return response()->json('done');

    }





}

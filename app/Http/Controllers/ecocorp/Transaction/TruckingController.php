<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\customer;
use App\Model\Product;
use App\Model\Warehouse;
use App\Model\StockRecord;
use App\Model\CustomerOrder;
use App\Model\CustomerProduct;
use App\Model\Unit;
use App\Model\Vehicle;
use App\Model\TripSchedule;
use App\Model\Intransit;
use App\PaymentType;
use auth;
use DB;

class TruckingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function vtrucking(){

        $vehicles = Vehicle::all();

        $TripTickets = TripSchedule::join('vehicles','vehicles.id','=','trip_schedules.vehicle_id')
                    ->select('trip_schedules.*','vehicles.class','vehicles.model','vehicles.plateNo')
                    ->get();

        return view('pages.Transaction.Shippment.Trucking.trucking')
        ->with('Vehicles',$vehicles)
        ->with('TripTickets',$TripTickets);
    }

    public function new_schedule(Request $request){


        // return $request->all();

         $vehicle = $request->input('vehicle_id');
         $departure = $request->input('departure');

         $trip_sched = TripSchedule::where('vehicle_id','=',$vehicle)
         ->where('departure','=',$departure)->count();

         if ($trip_sched >= 1) {
            session()->flash('error','The Vehicle Already Registered For delivery on Selected Date');
         }else{

        $sched = New TripSchedule;
        $sched->vehicle_id = $request->input('vehicle_id');
        $sched->driver = $request->input('driver');
        $sched->departure = $request->input('departure');
        $sched->save();

        
        session()->flash('success','Schedule Sucessfully Added');
         }

        return redirect('/trucking/schedule');

    }

    public function vehicle_cargos($tripid){

        $cargos = Intransit::join('customer_orders','intransits.dr_no','=','customer_orders.id')
        ->join('customers','customers.id','=','customer_orders.customer_id')
        ->join('payment_types','payment_types.id','=','customer_orders.payment_terms')
        ->select('customer_orders.*','customers.address','customers.business_name','payment_types.type')
        ->where('intransits.trip_id','=',$tripid)
        ->get();

        //return $cargos;

        $tripsched = TripSchedule::join('vehicles','vehicles.id','=','trip_schedules.vehicle_id')
        ->select('trip_schedules.*','vehicles.plateNo','vehicles.model','vehicles.class')
        ->where('trip_schedules.id','=',$tripid)
        ->get();
       // return $tripsched;
       // return $tripsched['0']['id'];
        return view('pages.Transaction.Shippment.Trucking.trucking-cargo')
        ->with('cargos',$cargos)
        ->with('tripsched',$tripsched);



    }
}

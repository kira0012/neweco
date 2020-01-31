<?php

namespace App\Http\Controllers\ecocorp\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Model\Product;
use App\Model\Vehicle;
use App\Model\Supplier;
use App\Model\Warehouse;
use auth;
use File;
use DB;


class VehicleController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
   
    public function vVehicles(){

        $Vehicles = db::table('vehicles')
                    ->select('vehicles.*',db::raw('year(CURDATE())-year(purchase_date) as age'))
                    ->get();

        return view('pages.Records.vehicles')
        ->with('Vehicles',$Vehicles);
        
    }
    public function add_vehicle(Request $request){


        $chk = Vehicle::where('plateNo','=',$request->input('plateno'))->count();

        if($chk != 0){

            session()->flash('error','Vehicle Plate No Already Registred To other Vehicle');
            return redirect('/vehicles');
    
        }

        if($request->file('vehicleimage') != null){
            $image = $request->file('vehicleimage');
            $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
            $image->move('upload/vehicle/img',$NewFilename);
            $imagePath = 'upload/vehicle/img/'.$NewFilename;

            $Vehicle = New Vehicle;

            $Vehicle->model = $request->input('model');
            $Vehicle->color = $request->input('color');
            $Vehicle->plateNo = $request->input('plateno');
            $Vehicle->class = $request->input('vclass');
            $Vehicle->price = $request->input('price');
            $Vehicle->purchase_date = $request->input('dateofpurchase');
            $Vehicle->depreciation_rate = $request->input('drate');
            $Vehicle->dor = $request->input('dateofregistration');
            $Vehicle->Image = $imagePath;
            $Vehicle->save();

        }else{
            $Vehicle = New Vehicle;

            $Vehicle->model = $request->input('model');
            $Vehicle->color = $request->input('color');
            $Vehicle->plateNo = $request->input('plateno');
            $Vehicle->class = $request->input('vclass');
            $Vehicle->price = $request->input('price');
            $Vehicle->purchase_date = $request->input('dateofpurchase');
            $Vehicle->depreciation_rate = $request->input('drate');
            $Vehicle->dor = $request->input('dateofregistration');
            $Vehicle->save();

        }



        session()->flash('success','Vehicle Sucessfully Added');
        return redirect('/vehicles');
    }

    public function my_vehicle($vid){

        $data = Vehicle::findorfail($vid);

        return $data;
        

    }

    public function update_vehicle(Request $request){

        $vid = $request->input('v-id');

        $Vehicle = Vehicle::findorfail($vid);

        if ($request->input('plateno') != $Vehicle->plateNo) {
            $chk = Vehicle::where('plateNo','=',$request->input('plateno'))->count();
            if($chk != 0){
                session()->flash('error','Vehicle Plate No Already Registred To other Vehicle');
                return redirect('/vehicles');
        
            }
        }

        if($request->file('vehicleimage') != null){

            File::delete($Vehicle->Image);

            $image = $request->file('vehicleimage');
            $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
            $image->move('upload/vehicle/img',$NewFilename);
            $imagePath = 'upload/vehicle/img/'.$NewFilename;

            $Vehicle->model = $request->input('model');
            $Vehicle->color = $request->input('color');
            $Vehicle->plateNo = $request->input('plateno');
            $Vehicle->class = $request->input('vclass');
            $Vehicle->price = $request->input('price');
            $Vehicle->purchase_date = $request->input('dateofpurchase');
            $Vehicle->depreciation_rate = $request->input('drate');
            $Vehicle->dor = $request->input('dateofregistration');
            $Vehicle->Image = $imagePath;
            $Vehicle->save();

            session()->flash('success','Vehicle Sucessfully Updated');
            return redirect('/vehicles');

        }else{

            $Vehicle->model = $request->input('model');
            $Vehicle->color = $request->input('color');
            $Vehicle->plateNo = $request->input('plateno');
            $Vehicle->class = $request->input('vclass');
            $Vehicle->price = $request->input('price');
            $Vehicle->purchase_date = $request->input('dateofpurchase');
            $Vehicle->depreciation_rate = $request->input('drate');
            $Vehicle->dor = $request->input('dateofregistration');
            $Vehicle->save();

            session()->flash('success','Vehicle Sucessfully Updated');
            return redirect('/vehicles');

        }



    }
}

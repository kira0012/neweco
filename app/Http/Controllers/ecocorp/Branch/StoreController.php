<?php

namespace App\Http\Controllers\ecocorp\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EcoStore;
use App\Model\StoreRemittance;
use App\User;
use App\PaymentType;
use DB;
use auth;
use File;


class StoreController extends Controller
{
    //


    public function __construct(){
        $this->middleware('auth');
    }

    public function vstore_records(){

        $stores = EcoStore::all();
        return view('pages.Store.store-record')
        ->with('stores',$stores);
    }

    public function store_infos($sid){

        $store = EcoStore::findorfail($sid);

        return response()->json($store);
    }

    public function new_stores(Request $request){

        $request->validate([
            'eco_store' => 'required',
            'location' => 'required',
        ]);

        $store = New EcoStore;
        $store->store_name = $request->input('eco_store');
        $store->store_location = $request->input('location');
        $store->store_head = $request->input('store_head');
        $store->Details = $request->input('details');
        $store->save();

        session()->flash('success','Store Sucessfully Added');
        return redirect('/Branch/Store');
    }

    public function update_store(Request $request){

        //return $request->all();

        $request->validate([
            'eco_store' => 'required',
            'location' => 'required',
        ]);

        $store = EcoStore::findorfail($request->input('store_id'));

    
        $store->store_name = $request->input('eco_store');
        $store->store_location = $request->input('location');
        $store->store_head = $request->input('store_head');
        $store->Details = $request->input('details');
        $store->save();

        session()->flash('success','Store Sucessfully Updated');
        return redirect('/Branch/Store');
    }

    //remittance infos..

    public function vremittance(){

        $today = date('Y-m-d');
        $stores = EcoStore::all();

        $records = StoreRemittance::join('users','users.id','=','store_remittances.recieved_by')
                    ->join('eco_stores','eco_stores.id','=','store_remittances.store_id')
                    ->select('store_remittances.*','eco_stores.store_name','users.name')
                    ->get();

        return view('pages.Store.store-remittance')
        ->with('stores',$stores)
        ->with('records',$records)
        ->with('today',$today);
    }

    public function remittance_info($rid){

        $record = StoreRemittance::findorfail($rid);
        return response()->json($record);
    }

    public function new_remittance(Request $request){

        $request->validate([
            'remit_date' => 'required',
            'store_id' => 'required',
            'remit_amt' => 'required',
        ]);

        $remittance = New StoreRemittance;

        $remittance->store_id = $request->input('store_id');
        $remittance->remittance_date = $request->input('remit_date');
        $remittance->amount = $request->input('remit_amt');
        $remittance->recieved_by = auth()->user()->id;
        $remittance->remarks = $request->input('remarks');
        $remittance->save();


        session()->flash('success','Store Remittance Sucessfully Recorded');
        return redirect('/Branch/Remittance');

    }

    public function update_remittance(Request $request){

        $request->validate([
            'remit_date' => 'required',
            'store_id' => 'required',
            'remit_amt' => 'required',
        ]);
        
        $remittance = StoreRemittance::findorfail($request->input('remit_id'));
        $remittance->store_id = $request->input('store_id');
        $remittance->remittance_date = $request->input('remit_date');
        $remittance->amount = $request->input('remit_amt');
        $remittance->remarks = $request->input('remarks');
        $remittance->save();


        session()->flash('success','Store Remittance Record Updated');
        return redirect('/Branch/Remittance');
    }

   
}

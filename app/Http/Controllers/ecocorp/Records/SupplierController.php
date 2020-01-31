<?php

namespace App\Http\Controllers\ecocorp\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Vehicle;
use auth;
use DB;

class SupplierController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    //

    public function vsupplier(){
        
        $Suppliers = Supplier::all();
        return view('pages.Records.suppliers')
        ->with('Suppliers',$Suppliers);
    }

    public function add_supplier(Request $request){


        // return $request->all();

            $Supplier = New Supplier;
            $Supplier->supplier = $request->input('suppliername');
            $Supplier->address = $request->input('address');
            $Supplier->email = $request->input('emailadd');
            $Supplier->tin = $request->input('tinno');
            $Supplier->phone = $request->input('phoneno');
            $Supplier->cellno = $request->input('cellno');
            $Supplier->contact_person = $request->input('contact_person');
            $Supplier->cp_number = $request->input('cp_no');
            $Supplier->faxno = $request->input('faxno');
            $Supplier->save();

            session()->flash('success','Supplier Sucessfully Added');
            return redirect('/suppliers');
    
    }

    public function update_supplier(Request $request){

        $id = $request->input('sid');

        $Supplier = Supplier::findorfail($id);
        $Supplier->supplier = $request->input('suppliername');
        $Supplier->address = $request->input('address');
        $Supplier->email = $request->input('emailadd');
        $Supplier->tin = $request->input('tinno');
        $Supplier->phone = $request->input('phoneno');
        $Supplier->cellno = $request->input('cellno');
        $Supplier->contact_person = $request->input('contact_person');
        $Supplier->cp_number = $request->input('cp_no');
        $Supplier->faxno = $request->input('faxno');
        $Supplier->save();

        session()->flash('success','Supplier Sucessfully Updated');
        return redirect('/suppliers');

    }

    public function supplier_profile($id){

        $Supplier = Supplier::findorfail($id);
        $products = $this->supplier_products($id);

        return view('pages.Records.profiles.supplier-profile')
        ->with('products',$products)
        ->with('Supplier',$Supplier);


    }

    public function my_products($sid){

        $products = $this->supplier_products($sid);

        return response()->json($products);
    }
}

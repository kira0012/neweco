<?php

namespace App\Http\Controllers\ecocorp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Vehicle;
use App\Model\Unit;
use App\Model\RemittanceCategory;
use App\User;
use auth;
use DB;
use File;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RecordsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function vproduct(){

        $Suppliers = Supplier::all();
        $units = Unit::all();
        $Products = Product::join('suppliers','suppliers.id','=','products.supplier_id')
        ->join('units','units.id','=','products.unit')
        ->select('products.*','suppliers.supplier','units.units')
        ->get();

       // return $Products;

        return view('pages.Records.Products')
        ->with('Suppliers',$Suppliers)
        ->with('Products',$Products)
        ->with('units',$units);

    }

  

    public function vunits(){


        $units = Unit::all();

        return view('pages.Records.units')
        ->with('units',$units);
    }

    public function add_units(Request $request){

        //return $request->all();

        $unit = New Unit;

        $unit->units = ucfirst($request->input('unit'));
        $unit->description = ucfirst($request->input('description'));
        $unit->save();

        session()->flash('success','Unit Sucessfully Added');
        return redirect('/units');


    }

    public function vcustomer(){

        
        $Customers = db::table('customers')
        ->leftjoin('users','customers.id','=','users.customer_id')
        ->select('customers.*','users.username')
        ->get();

        return view('pages.Records.customer')
        ->with('Customers',$Customers);
    }

    public function vusers(){

        $users = User::all();
        return view('pages.Records.users')
        ->with('users',$users);
    }

    public function new_user(Request $request){

      //return $request->all();

        $email = $request->input('email');
        $username = $request->input('username');
        
        $chk_user = User::where('username','=',$username)->count();
        $chk_email = User::where('email','=',$email)->count();

      

        if($chk_email >= 1){
            session()->flash('error','User Email Already Exist');
            return redirect('/users');
        }

        if($chk_user >= 1){
            session()->flash('error','User Username Already Exist');
            return redirect('/users');
        }

        if($request->file('productimage') != null){
        $image = $request->file('productimage');
        $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
        $image->move('upload/profile/img',$NewFilename);
        $imagePath = 'upload/profile/img/'.$NewFilename;

        $user = New User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->con_number = $request->input('con_num');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->profile = $imagePath;
        $user->save();
        
        }else{

            $user = New User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->con_number = $request->input('con_num');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }

        if($request->input('role') == '1'){

            $user->assignRole('admin');
        }

        

        session()->flash('success','User Sucessfully Added');
        return redirect('/users');
    }

    public function user_profile(Request $request){
        
        //return $request->all();

        $uid = $request->input('uid');

        $user = User::findorfail($uid);
        
        return view('pages.Records.user-profile')
        ->with('user',$user);

    }

    public function update_user(Request $request){

       // return $request->all();

        $uid = $request->input('uid');
        $n_email = $request->input('email');
        $n_username = $request->input('username');
        $user = User::findorfail($uid);

        if ($n_email != $user->email) {
            
            $chk = User::where('email','=',$n_email)->count();

            if ($chk > 0) {
                # code...
                session()->flash('error','Email Already in Use');
                  return redirect('/users');
            }
        }

        if ($n_username != $user->username) {
            # code...
            $chk = User::where('username','=',$n_username)->count();

            if ($chk > 0) {
                # code...
                session()->flash('error','Username Already in Use');
                return redirect('/users/profile/'.$uid);
            }
        }

      
        $user->name = $request->input('name');
        $user->username = $n_username;
        $user->email = $n_email;
        $user->con_number = $request->input('con_num');
        $user->save();

        session()->flash('success','User Sucessfully Updated');
        return redirect('/users');

    }
    public function update_password(Request $request){
        

        //return $request->all();
        $uid = $request->input('uid');
        $user = User::findorfail($uid);
        $user->password = bcrypt($request->input('cpassword'));
        $user->save();

        session()->flash('success','User Sucessfully Updated');
        return redirect('/users');
        
    }
    
    public function upload_profile(Request $request){

    $uid = $request->input('uid');

      $user = User::findorfail($uid);

      
      if($request->file('productimage') == null){
        session()->flash('error','Please Upload Photo To save');
        return redirect('/users/profile/'.$uid);
    }

      $image = $request->file('productimage');
      $NewFilename = uniqid().'_'.date('Ymd').'_'.time().'.webp';
      $image->move('upload/profile/img',$NewFilename);
      $imagePath = 'upload/profile/img/'.$NewFilename;
 

      if ($user->profile == null) {

          $user->profile = $imagePath;
          $user->save();   

      } else {
          # code...
          File::delete($user->profile);
          $user->profile = $imagePath;
          $user->save();
      }

      session()->flash('success','User Profile Image Sucessfully Updated');
      return redirect('/users');
      


    }

    public function update_units(Request $request){

        $unit = Unit::findorfail($request->input('uid'));
        $unit->units = ucfirst($request->input('unit'));
        $unit->description = ucfirst($request->input('description'));
        $unit->save();

        session()->flash('success','Unit Sucessfully Updated');
        return redirect('/units');

    }


    //permissions...

    public function fetch_userpermission($uid){

        $permission = db::table('model_has_permissions')
        ->where('model_id','=',$uid)
        ->get();

        return $permission;
        
    }

    public function assigned_permission(Request $request){

            $permissionid = $request->input('permission_id');
            $userid = $request->input('userid');
            $user = User::findorfail($userid);
            $permission = Permission::findorfail($permissionid);
            
            $chk = db::table('model_has_permissions')
                    ->where('permission_id','=',$permissionid)
                    ->where('model_id','=',$userid)
                    ->count();

            if ($chk > 0) {
                # code...
                $res = array(
                    "permission" => $permissionid,
                    "userid" => $userid,
                    "status" => 'error',  
                );
                return response()->json($res);
            } else {
                # code...
                $user->givePermissionTo($permission->name);

                $res = array(
                    "permission" => $permissionid,
                    "userid" => $userid,
                    "status" => 'done',  
                );
                return response()->json($res);
            }
    }

    public function revoke_permission(Request $request){

        $permissionid = $request->input('permission_id');
        $userid = $request->input('userid');
        $user = User::findorfail($userid);
        $permission = Permission::findorfail($permissionid);
        
        $chk = db::table('model_has_permissions')
                ->where('permission_id','=',$permissionid)
                ->where('model_id','=',$userid)
                ->count();

                if ($chk == 0) {
                    # code...
                    $res = array(
                        "permission" => $permissionid,
                        "userid" => $userid,
                        "status" => 'error',  
                    );
                    return response()->json($res);
                } else {
                    # code...
                    $user->revokePermissionTo($permission->name);
                    $res = array(
                        "permission" => $permissionid,
                        "userid" => $userid,
                        "status" => 'done',  
                    );
                    return response()->json($res);
                }
    }



    public function vremittance(){

            $category = RemittanceCategory::all();

        return view('pages.Records.remittance-category')
        ->with('category',$category);
    }

    public function store_remittance(Request $request){

        $request->validate([
            'cat' => 'required',
            'description' => 'required',
            ]);

        // return $request->all();

        $remittance = New RemittanceCategory;
        $remittance->Remittance = $request->input('cat');
        $remittance->Details = $request->input('description');
        $remittance->save();
        
        session()->flash('success','Category Sucessfully Added');
        return redirect('/Remittance/Categories');
    

        
    }

    public function patch_remittance(Request $request){

       
        $request->validate([
            'uid' => 'required',
            'cat' => 'required',
            'description' => 'required',
            ]);

            $remittance = RemittanceCategory::findorfail($request->input('uid'));
            $remittance->Remittance = $request->input('cat');
            $remittance->Details = $request->input('description');
            $remittance->save();
            
            session()->flash('success','Category Sucessfully Added');
            return redirect('/Remittance/Categories');

    }
    

    public function history($table){

    
            $test = $this->log_history($table);

            return $test;
    }
}

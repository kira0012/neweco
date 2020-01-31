<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Quatataion;

class ecoController extends Controller
{
    public function home(){
    	return view ('pages.website.home');
    }
    public function papers(){
        return view('product.papers');
    }   
    public function stickers(){
        return view('product.stickers');
    }
    public function flyers(){
        return view('product.flyers');
    }
    public function posters(){
        return view('product.posters');
    }
    public function calendars(){
        return view('product.calendars');
    }
    public function books(){
        return view('product.books');
    }
    public function mugs(){
        return view('product.mugs');
    }
    public function manuals(){
        return view('product.manuals');
    }
    public function invitations(){
        return view('product.invitations');
    }
    public function forms(){
        return view('product.forms');
    }
    public function brochures(){
        return view('product.brochures');
    }
    public function booklets(){
        return view('product.booklets');
    }
    public function receipts(){
        return view('product.receipts');
    }
    public function callingcards(){
        return view('product.callingcards');
    }

    public function planners(){
        return view('product.planners');
    }

    public function quatation(){
        return view('pages.website.home');
    }

    

    public function orderlandingpage(){
        return view('pages.orderform.orderlandingpage');
    }

   public function addQuataion(Request $request){
    
        $flight = new Quatataion;
        $flight->fullname = $request->input('fullname');
        $flight->company = $request->input('company');
        $flight->address = $request->input('address');
        $flight->contact = $request->input('contact');
        $flight->discription = $request->input('description');
        $flight->status = 0;
        $flight->save();
        

        return view('pages.orderform.orderlandingpage');


        // 2nd way to insert data 
        // Quatation::insert([
        //     'name' => $input['fullname'],
        // ]);

        // 3rd way to insert data
        // DB::table('eco')->insert([
        //     ['name' => $input['fullname'], 
            
        // ]);

        

   }
}

<?php

namespace App\Http\Controllers\ecocorp\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EcoStore;
use App\Model\StoreRemittance;
use App\User;
use App\PaymentType;
use DB;
use auth;
use File;

class RemittanceReportController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function vreport(){
        $first = date('Y-m-01');
        $last  = date('Y-m-t');
        
        return view('pages.Reports.Remittance.remittance-report')
        ->with('first',$first)
        ->with('last',$last);
       
    }

    public function remit_sum($from,$to){

        $records = StoreRemittance::leftjoin('eco_stores','eco_stores.id','=','store_remittances.store_id')
        ->select('store_remittances.store_id',db::raw('sum(store_remittances.amount) total_amount'),'eco_stores.store_name',db::raw('count(store_remittances.id) as qty'))
        ->whereBetween('remittance_date',[$from,$to])
        ->groupby('store_remittances.store_id')
        ->get();

        return response()->json($records);
    }
}

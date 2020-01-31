<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PoDetail;
use App\Model\PoProduct;
use App\Model\Supplier;
use App\Model\PoPayment;
use App\PaymentType;
use auth;
use DB;


class PoPaymentController extends Controller
{
    //

    public function vpo_payment(){

        $po_order = PoDetail::join('suppliers','po_details.supplier_id','=','suppliers.id')
        ->select('po_details.*','suppliers.supplier')
        //->where('po_details.order_status','=','0')
        ->where('po_details.p_status','=','0')
        ->get();
        

        $po_paid = PoPayment::join('po_details','po_details.id','=','po_payments.po_id')
                            ->join('suppliers','po_details.supplier_id','=','suppliers.id')
                            ->join('users','users.id','=','po_payments.process_by')
                            ->select('po_details.order_date','suppliers.supplier','users.name','po_payments.*')
                            ->where('po_payments.status','=','1')
                            ->get();

        $types = PaymentType::all();
        $today = date('Y-m-d');
        $m = date('m');
        $month = ltrim($m, '0');

        $total_po = PoDetail::where(db::raw('month(order_date)'),'=',$month)->count();

        $total_cost = PoPayment::where(db::raw('month(payment_date)'),'=',$month)->sum('amount');

        return view('pages.Transaction.Payment.po-payment')
        ->with('today',$today)
        ->with('types',$types)
        ->with('po_paid',$po_paid)
        ->with('total_cost',$total_cost)
        ->with('total_po',$total_po)
        ->with('po_order',$po_order);
    }

    public function purchase_payment(Request $request){

       // return $request->all();

        $uid = auth()->user()->id;
        $type = $request->input('payment_type');
        $po_no = $request->input('po');
        $payment = New PoPayment;

        if ($type == '1') {
            # code...
                $payment->po_id = $request->input('po');
                $payment->payment_date = $request->input('payment_date');
                $payment->amount = $request->input('payment');
                $payment->process_by = $uid;
                $payment->status = '1';
                $payment->save();
        } else {
            # code...
            $payment->po_id = $request->input('po');
            $payment->payment_date = $request->input('payment_date');
            $payment->checkno = $request->input('cheque_no');
            $payment->payee = $request->input('payee_name');
            $payment->amount = $request->input('payment');
            $payment->status = '1';
            $payment->process_by = $uid;
            $payment->save();
        }


        $balance = $this->po_balance($po_no);

        if ($balance == 0) {
            # code...
            $Order = PoDetail::findorfail($po_no);
            $Order->p_status = '1';
            $Order->save();
        }
 
        session()->flash('success','Payment Successfully Added');
        return redirect('/po-order/payment');    

    }

    public function posted_dated_payment(){

        $today = date('Y-m-d');
        $to = date('Y-m-d', strtotime($today. ' + 7 days'));
         $now = time();
         $your_date = strtotime($to);
 
         $datediff = $now - $your_date;
 
         $no_days = round($datediff / (60 * 60 * 24));
        
         $record = PoPayment::where('checkno','!=',null)
         ->whereBetween('payment_date', [$today,$to])->get();
 
         return $record;
    }

    public function po_balance($poid){

        $do = PoDetail::findorfail($poid);
        $amount_paid = PoPayment::where('po_id','=',$poid)->sum('amount');
        $balance = $do->total_cost - $amount_paid;

        return $balance;


    }
}

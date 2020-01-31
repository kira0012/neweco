<?php

namespace App\Http\Controllers\ecocorp\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ExpenseCategory;
use App\Model\Expenses;
use auth;
use DB;

class ExpensesController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function vexpenses_cat(){

        $categories = ExpenseCategory::all();


        return view('pages.Transaction.Expenses.expense-category')
        ->with('categories',$categories);

    }
    public function add_category(Request $request){

       // return $request->all();
        $chk = $request->input('expenses');

        if ($chk == 'Commission') {

            session()->flash('error','This expenses cannot be manualy created');
            return redirect('/Expenses/Categories');
        }
       

        $cat = New ExpenseCategory;
        $cat->expenses = $request->input('expenses');
        $cat->description = $request->input('description');
        $cat->save();

        session()->flash('success','Expense Category Sucessfully Added');
        return redirect('/Expenses/Categories');

    }
    public function update_category(Request $request){

        $cat = ExpenseCategory::findorfail($request->input('cat_id'));
        
        if ($cat->expenses == 'Commission') {

            session()->flash('error','This expenses cannot be manualy updated');
            return redirect('/Expenses/Categories');
        }
        
        $cat->expenses = $request->input('expenses');
        $cat->description = $request->input('description');
        $cat->save();

        session()->flash('success','Expense Category Sucessfully Updated');
        return redirect('/Expenses/Categories');

    }
    public function vexpenses(){

        $Expenses = Expenses::join('expense_categories','expense_categories.id','=','expenses.expense_id')
        ->select('expenses.*','expense_categories.expenses')
        ->get();


        $today = date('Y-m-d');

        //return $today;
        $categories = ExpenseCategory::all();


        return view('pages.Transaction.Expenses.expenses')
        ->with('today',$today)
        ->with('categories',$categories)
        ->with('Expenses',$Expenses);
        
    }
    public function new_expense(Request $request){

      // return $request->all();
        $expid =  $request->input('expenses');
        $refno = $request->input('refno');

        $chk = Expenses::where('expense_id','=',$expid)
                        ->where('ref_no','=',$refno)
                        ->count();
        if ($chk != 0) {
            # code...
            session()->flash('error','Reference Number On Selected Expense Category Already Exist');     

        }else{

        $expense = New Expenses;
        $expense->expense_id = $request->input('expenses');
        $expense->ref_no = $refno;
        $expense->expense_date = $request->input('expense-date');
        $expense->amount = $request->input('amount');
        $expense->remarks = $request->input('remarks');
        $expense->process_by = auth()->user()->id;
        $expense->save();

        session()->flash('success','Expense Sucessfully Added');
        }

        return redirect('/Expenses/Expenses');
    }

    public function update_expense(Request $request){

        //return $request->all();

        $expid =  $request->input('expenses');
        $refno = $request->input('refno');
        $expense = Expenses::findorfail($request->input('exp_id'));

        $chk = Expenses::where('expense_id','=',$expid)
        ->where('ref_no','=',$refno)
        ->count();
       

        if ($expense->expense_id == $expid){

            if ($expense->ref_no == $refno) {
              
                $expense->expense_id = $request->input('expenses');
                $expense->ref_no = $refno;
                $expense->expense_date = $request->input('expense-date');
                $expense->amount = $request->input('amount');
                $expense->remarks = $request->input('remarks');
                $expense->process_by = auth()->user()->id;
                $expense->save();
                session()->flash('success','Expense Sucessfully Updated');
            }

            if ($chk != 0) {
              
                session()->flash('error','Reference Number On Selected Expense Category Already Exist');     
            }else{
                
                $expense->expense_id = $request->input('expenses');
                $expense->ref_no = $refno;
                $expense->expense_date = $request->input('expense-date');
                $expense->amount = $request->input('amount');
                $expense->remarks = $request->input('remarks');
                $expense->process_by = auth()->user()->id;
                $expense->save();
                session()->flash('success','Expense Sucessfully Updated');

            }
           
        }
        else{
           
            if ($chk != 0) {
                # code...
                session()->flash('error','Reference Number On Selected Expense Category Already Exist');     
            }else{

                $expense->expense_id = $request->input('expenses');
                $expense->ref_no = $refno;
                $expense->expense_date = $request->input('expense-date');
                $expense->amount = $request->input('amount');
                $expense->remarks = $request->input('remarks');
                $expense->process_by = auth()->user()->id;
                $expense->save();
            }

        }

       
     
      return redirect('/Expenses/Expenses');

    }

    public function delete_expense($id){

        $expense = Expenses::findorfail($id);
        $expense->delete();

        return "1";
    }

    public function expense_refno($expid){


        $refno = Expenses::where('expense_id','=',$expid)
                    ->max('ref_no');

            $data = $refno + 1;

            return response()->json($data);
    }
}

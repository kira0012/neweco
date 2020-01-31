@extends('layouts.template')
@section('htmlhead')

    
@endsection
<style>
.modal-header{
    background-color: #007bff;
    margin-left: -10px;
    margin-right: -10px;
    margin-top: -12px;
}
.mcontent{

    margin-left: -20px;
    margin-right: -20px;
}
#imgp{

    width: 350px;
    height: 280px;
}
</style>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Expenses</h4>
                        </li>
                    </ul>
                    @include('inc.message')
                </div>
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                @can('Payments')
                <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right;width:140px;"><i data-feather="aperture" style="height:15px"></i> <span>Add Expenses </span></button>
                @endcan
                </div>
            </div>
        </div>
        
        <!-- Exportable Table -->

        @foreach ($categories as $category)
            
      
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-6">
                                    <h1><strong>{{$category->expenses}}</strong></h1>
                                    <h5><strong>Total Expense : {{number_format($category->transactions->sum('amount'))}}</strong></h5>
                            </div>
                            <div class="col-lg-6">
                              
                            </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Ref NO</th>
                                        <th>Expense Date</th>
                                        <th>Expenses</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->transactions as $expense)
                                    <tr>
                                    <td class="text-center" id="rec-ref-{{$expense->id}}">{{$expense->ref_no}}</td>
                                    <td id="rec-date-{{$expense->id}}" class="text-center">{{$expense->expense_date}}</td>
                                    <td class="text-center"><input type="hidden" value="{{$expense->expense_id}}" id="rec-exp-{{$expense->id}}"  />{{$category->expenses}}</td>
                                    <td class="text-center">
                                    <input type="hidden" id="rec-amount-{{$expense->id}}" value="{{$expense->amount}}" />
                                        {{number_format($expense->amount,2)}}
                                    </td>
                                    <td id="rec-remarks-{{$expense->id}}" class="text-center">{{$expense->remarks}}</td>
                                    <td class="text-center">
                                            <button type="button" onclick="update_rec(this)"
                                            value = "{{$expense->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">list</i>
                                            </button> | 
                                        <button type="button" onclick="del_rec(this)"
                                        value = "{{$expense->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        <!-- #END# Exportable Table -->
    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Expense Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/expenses/new/expenses" method="post">
                            @csrf
                            <div class="form-group">
                                    <label for="expense-date">Date</label>
                                    <div class="form-line">
                                    <input type="date"  name="expense-date" value="{{$today}}"class="form-control" placeholder="Expense Title" required>
                                    </div>
                                </div>

                                <div class="form-group default-select">
                                    <label for="expenses">Expense</label>
                                        <select class="form-control select2 exs"  name="expenses" required>
                                            <option value="" >Select Expense</option>
                                                @foreach ($categories as $category)
                                                 <option value="{{$category->id}}">{{$category->expenses}}</option>
                                              @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Ref NO:</label>
                                        <div class="form-line">
                                            <input class="form-control refno" type="number" name="refno" value="" required/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                        <div class="form-line">
                                            <input class="form-control" step="0.0001" type="number" name="amount" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                            <div class="form-line">
                                                <textarea name="remarks" cols="70" rows="50"></textarea>
                                        </div>
                                    </div>

                               

                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="update-expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update Expense Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/expenses/update/expenses" method="post" id="form-update">
                            @csrf
                            <input type="hidden" id="exp_id" value="" name="exp_id"/>
                            <div class="form-group">
                                    <label for="expense-date">Date</label>
                                    <div class="form-line">
                                    <input type="date" id="expense-date" name="expense-date" value="" class="form-control" placeholder="Expense Title" required>
                                    </div>
                                </div>

                                <div class="form-group default-select">
                                    <label for="expenses">Expense</label>
                                        <select class="form-control select2 exs" data-placeholder="Select" id="expenses" name="expenses" required>
                                            <option value="0" selected="true" disabled="true">Select Expense</option>
                                            @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->expenses}}</option>
                                                
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Ref NO:</label>
                                        <div class="form-line">
                                            <input class="form-control refno" type="number" id="refno" name="refno" value="" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                        <div class="form-line">
                                            <input class="form-control" type="number" id="amount" name="amount" value="" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                            <div class="form-line">
                                                <textarea name="remarks" id="remarks" cols="70" rows="50" required></textarea>
                                        </div>
                                    </div>

                               

                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-update" class="btn btn-info waves-effect">Save</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



<script>
        window.onload = function () {
            $('.nav-transaction').click();
            $('.nav-expenses').addClass('active');
            $('.nav-expenselist').addClass('active');
        
            $.each($(".menu .list li.active"), function(i, val) {
              var $activeAnchors = $(val).find("a:eq(0)");
              console.log('1');
              console.log($activeAnchors);
              $activeAnchors.addClass("toggled");
              $activeAnchors.next().show();
            });
        
        }



        
        </script>

@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script>
   function update_rec(id){

    const exp_id = id.value;
    const refno = $('#rec-ref-'+exp_id).text();
    const date = $('#rec-date-'+exp_id).text();
    const expense = $('#rec-exp-'+exp_id).val();
    const amount = $('#rec-amount-'+exp_id).val();
    const remarks = $('#rec-remarks-'+exp_id).text();
    console.log(amount);

    $('#expense-date').val(date);
    $('#exp_id').val(exp_id);
    $('#expenses').select2("val",expense);
    $('#amount').val(amount);
    $('#remarks').val(remarks);
  
    $('#update-expense').modal('show');
    

  
  setTimeout(function(){ 
      $('.refno').val(refno);
      }, 1000);

   }


function del_rec(id){

    const exp_id = id.value;

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'danger',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
        if (result.value) {
            
            Swal.fire(
            'Updated!',
            'Selected Expense has been Deleted.',
            'success'
            ).then( ()=>{

                fetch('/expense/delete/'+exp_id)
                    .then((res) => res.json())
                        .then((data)=>{
                        console.log(data);
                        location.reload();
                    }).catch((error)=>{
                        console.log(error);
                    })
            })         
        }
    })


   }

const send_update = ()=>{

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'info',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
        if (result.value) {
            
            Swal.fire(
            'Updated!',
            'Selected Expense has been Updated.',
            'success'
            ).then( ()=>{
            
                $('#form-update').submit();
            })         
        }
    })
}

$('#btn-update').on('click', ()=>{

    send_update();
});

$('.exs').on('change',(id)=>{

    const exp = id.target.value;

    fetch('/expense/refno/'+exp)
        .then((res) => res.json())
            .then((refno) => {
                console.log(refno);
                $('.refno').val(refno);

            })

    
})

// $('#expenses').on('change',(id)=>{

// const exp = id.target.value;

// fetch('/expense/refno/'+exp)
//     .then((res) => res.json())
//         .then((refno) => {
//             console.log(refno);
//             $('.refno').val(refno);

//         })


// })


</script>

@endsection
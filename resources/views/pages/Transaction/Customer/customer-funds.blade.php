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
                            <h4 class="page-title">Customer Accounts Records</h4>
                        </li>
                    </ul>
                    @include('inc.message')
                </div>
            </div>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-6">
                                    <h2><strong>List of Customer Accounts</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Payments')
                                    <button class="btn-hover btn-border-radius color-8" onclick="funds(this)" value = "0" style="float:right;width:160px"><i data-feather="aperture" style="height:15px"></i> <span>Add Funds</span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr class="text-center">
                                        <th>Customer</th>
                                        <th>Total Funds</th>
                                        <th>Transaction List</th>

                                    </tr>
                                </thead>
                                <tbody>
                                       @foreach ($customers as $customer)
                                           <tr>
                                           <td class="text-center">{{$customer->business_name == null ? $customer->name : $customer->business_name}}</td>
                                           <td class="text-center">{{$customer->myfunds()->sum('amount')}}</td>
                                           <td class="text-center">
                                               <button type="button" onclick="trans_list(this)"
                                                value = "{{$customer->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
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
        <!-- #END# Exportable Table -->
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>List of Customer Accounts Transactions</strong></h2>
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
                                        <tr class="text-center">
                                            <th>Customer</th>
                                            <th>Transaction Date</th>
                                            <th>Amount</th>
                                            <th>details</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @foreach ($transactions as $transaction)
                                               <tr>
                                               <td class="text-center">{{$transaction->business_name == null ? $transaction->name : $transaction->business_name}}</td>
                                               <td class="text-center">{{$transaction->transaction_date}}</td>
                                               <td class="text-center">{{$transaction->amount}}</td>
                                               <td class="text-center">
                                                   <button type="button" onclick="funds(this)"
                                                    value = "{{$transaction->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">list</i>
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






    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="trans-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="fund-header">Add Funds To Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="form-fund">
                            @csrf
                            <input type="hidden" id="tid" name="tid" value="" />
                            <label for="trans-date">Transaction Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input class="form-control"  type="date" id="trans-date" name="trasns_date" required>
                                </div>
                            </div>
                            
                            <div class="form-group default-select">
                                <label for="customer">Customer</label>
                                    <select class="form-control select2" data-placeholder="Select Customer" id="customer" name="customer_id" required>
                                            @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->business_name == null ? $customer->name : $customer->business_name }}</option>      
                                            @endforeach
                                </select>
                            </div>

                            <label for="total-funds">Funds Amount</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="number" id="total-funds" name="amount" />
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



<script>
        window.onload = function () {
            $('.nav-transaction').click();
            $('.nav-trans-customer').addClass('active');
            $('.nav-trans-customer-funds').addClass('active');
        
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
    
    const funds = (id)=> {

        const trans = id.value;
        
        $('#tid').val('');

        if (trans == '0') {

            $('#fund-header').text('Add Funds To Customer');
            $('#form-fund').attr('action','/transaction/new/customer-funds');
            $('#trans-modal').modal('show');

        } else {

            fetch('/transaction/csfund/info/'+trans)
                .then((res) => res.json())
                    .then((data) => {

                        console.log(data);
                       $('#trans-date').val(data.transaction_date);
                       $('#total-funds').val(data.amount);
                       $('#customer').select('val',data.customer_id);
                    
                      
                    })

                    $('#tid').val(trans);
                    $('#fund-header').text('Update Funds Transaction');
                    $('#form-fund').attr('action','/transaction/update/customer-funds');
                    $('#trans-modal').modal('show');
           
            
        }
    }


    const trans_list = (id)=>{

        const cid = id.value;

        location.href = '/customer/transaction/'+cid;
    }
</script>

@endsection
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
                            <h4 class="page-title">Payments</h4>
                        </li>
                    </ul>
                    @include('inc.message')
                </div>
            </div>
        </div>
        <!-- Exportable Table -->
        <div class="row">
            <div class="col-md-12 col-xl-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="m-t-5 m-b-20">This Month Total Purchased</h4>
                            <h3 class="f-w-700 col-blue n-counter">{{$total_po}}</h3>
                                {{-- <p class="m-b-0">40% High Then Last Month</p> --}}
                            </div>
                            <div class="col-auto">
                                {{-- <div class="chart chart-bar"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12 col-xl-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="m-t-5 m-b-20">This Month Purchased Cost</h4>
                            <h3 class="f-w-700 col-green n-counter">{{$total_cost}}</h3>
                                {{-- <p class="m-b-0">40% High Then Last Month</p> --}}
                            </div>
                            <div class="col-auto">
                                {{-- <div class="chart chart-bar"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6">
                                <h2><strong>List Delivery Order</strong></h2>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                        <thead>
                            <tr>
                                <th>DO number</th>
                                <th>DO Date</th>
                                <th>Supplier</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th>Payment</th>
                               
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($po_order as $order)
                                <tr>
                                <td id="po-{{$order->id}}"class="text-center">DO-{{STR_PAD($order->id,8,"0",STR_PAD_LEFT)}}</td>
                                <td id="date-{{$order->id}}" class="text-center">{{$order->order_date}}</td>
                                <td class="text-center">{{$order->supplier}}</td>
                                {{-- <td class="text-center" id="no-orders-{{$order->id}}">{{$order->remarks}}</td> --}}
                                <td class="text-center" id="remarks-{{$order->id}}">{{$order->remarks}}</td>
                                <td id="total-{{$order->id}}" class="text-center">{{$order->total_cost}}</td>
                                <td class="text-center">
                                    @can('Payments')
                                        <button type="button" onclick="add_payment(this)"
                                        value = "{{$order->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">add</i>
                                        </button> Payment 
                                    @endcan
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
                                <h2><strong>List Of Paid Order</strong></h2>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                        <thead>
                            <tr>
                                <th>DO number</th>
                                <th>DO Date</th>
                                <th>Payment Date</th>
                                <th>payment Type</th>
                                <th>Supplier</th>
                                <th>Amount</th>
                                <th>Process By</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($po_paid as $order)
                                <tr>
                                <td class="text-center">DO-{{STR_PAD($order->po_id,8,"0",STR_PAD_LEFT)}}</td>
                                <td class="text-center">{{$order->order_date}}</td>
                                <td class="text-center">{{$order->payment_date}}</td>
                                <td class="text-center">{{$order->checkno == null ? 'Cash' : 'Cheque'}} </td>
                                <td class="text-center">{{$order->supplier}}</td>
                                <td class="text-center">{{number_format($order->amount,4)}}</td>
                                <td class="text-center">{{$order->name}}</td>
                                <td class="text-center">
                                        <button type="button" onclick="view_sum(this)"
                                        value = "{{$order->po_id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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
<div class="modal fade" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-white" id="exampleModalCenterTitle">New Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                    <div class="modal-body">
                        <form action="/po/transaction/payment" id="order-payment" method="post">
                           @csrf
                           <input type="hidden" value="" id="po" name="po" />
                            <div class="form-group">
                                    <label for="unit">Payment Date</label>
                            <input class = "form-control" type="date" value="{{$today}}" id="p-date" name="payment_date" />
                                    </select>
                                </div>
                            <div class="form-group default-select">
                                <label for="unit">Payment Type</label>
                                    <select class="form-control select2" name="payment_type" id="payment-type" required>
                                        <option value="">Select Payment Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{$type->type}}</option>       
                                        @endforeach
                                    </select>
                                </select>
                            </div>

                            <div class="cheque-info">
                            <div class="form-group">
                                    <label for="unit">Cheque Number</label>
                                        <input class="form-control" type="number" id="cheque_no" name="cheque_no" value="" >
                                </div>
                                <div class="form-group">
                                        <label for="unit">Payee Name</label>
                                            <input class="form-control" type="text" id="payee_name" name="payee_name" value="" >
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                            <label for="no_orders">Remarks:</label>
                                                <input class = "form-control" type="text" value="" id="no-orders" readonly/>  
                                            </select>
                                        </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="unit">DO NO:</label>
                                            <input class = "form-control" type="text" value="" id="payment-po" readonly/>  
                                        </select>
                                    </div>
                                </div>
                            </div>
{{-- Cheque Section --}}
                            
                            <div class="form-group">
                                <label for="unit">Total Amount</label>
                                    <input class="form-control" type="text" id="payment-amount" name="to_paid" value="" readonly>
                            </div>

                            <div class="form-group">
                                    <label for="unit">Remaining Balance</label>
                                        <input class="form-control" type="text" id="remaining-balance" name="r_balance" value="" readonly>
                                </div>

                            <div class="form-group">
                                <label for="unit">Payment</label>
                                    <input class="form-control" type="number" id="payment" name="payment">
                            </div>
                                    
                        
                        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="paid-order" class="btn btn-info waves-effect">Paid Order</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
                window.onload = function () {
                    // $('.nav-transaction').click();
                    $('.nav-payment').addClass('active');
                    $('.nav-order-po-payment').addClass('active');
                
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
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('assets/js/myjs/transactions/po-payment.js')}}"></script>
<script>
$('.n-counter').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
}, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
                $(this).text(Math.ceil(now));
        }
    });
});



const view_sum = (id)=>{

    const po_id = id.value;

    // console.log(po_id);

    location.href = '/payments/po-sum/'+po_id;

}

</script>


@endsection
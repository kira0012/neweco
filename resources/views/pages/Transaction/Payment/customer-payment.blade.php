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

.fblack{
    
    color:black !important;
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
                                <h4 class="m-t-5 m-b-20">Total Recievables</h4>
                            <h3 class="f-w-700 col-blue n-counter">{{$amount_recievables}}</h3>
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
                                <h4 class="m-t-5 m-b-20">This Month Income</h4>
                            <h3 class="f-w-700 col-green n-counter">{{$income}}</h3>
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
                                <h2><strong>List of Payment Order</strong></h2>
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
                                <th>DR number</th>
                                {{-- <th>Trip Ticket</th> --}}
                                <th>Customer</th>
                                <th>Location</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($Recievables as $recievable)
                                <tr>
                                <td id="dr-{{$recievable->id}}"class="text-center">DR-{{STR_PAD($recievable->id,8,"0",STR_PAD_LEFT)}}</td>
                                {{-- <td id="t-{{$recievable->id}}" class="text-center">T-{{STR_PAD($recievable->trip_id,8,"0",STR_PAD_LEFT)}}</td> --}}
                                <td class="text-center">{{$recievable->business_name == null ? $recievable->name : $recievable->business_name}}</td>
                                <td class="text-center">{{$recievable->address}}</td>
                                <td id="total-{{$recievable->id}}" class="text-center">{{$recievable->total_amount}}</td>
                                <td class="text-center">
                                <input type="hidden" id="p-type-{{$recievable->id}}" value="{{$recievable->type}}">
                                {{-- <input type="hidden" id="p-drno" value=""> --}}
                                    @if ($recievable->balance > 0)
                                    @can('Payments')
                                        <button type="button" onclick="add_payment(this)"
                                        value = "{{$recievable->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">add</i>
                                        </button> Payment
                                     @endcan
                                        
                                        
                                    @else
                                        Paid
                                    @endif
                                    
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
                                <h2><strong>List of Payment</strong></h2>
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
                                <th>DR number</th>
                                {{-- <th>Trip Ticket</th> --}}
                                <th>Customer</th>
                                <th>Location</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Summary</th>
                                <th>Info</th>
                               
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($Paid as $paided)
                                <tr>
                                <td class="text-center">DR-{{STR_PAD($paided->id,8,"0",STR_PAD_LEFT)}}</td>
                                {{-- <td id="t-{{$paided->id}}" class="text-center">T-{{STR_PAD($paided->trip_id,8,"0",STR_PAD_LEFT)}}</td> --}}
                                <td class="text-center">{{$paided->business_name == null ? $paided->name : $paided->business_name}}</td>
                                <td class="text-center">{{$paided->address}}</td>
                                <td class="text-center"><b>{{number_format($paided->amount_paid,4)}}</b></td>
                                <td class="text-center">{{$paided->payment_date}}</td>
                                <td class="text-center" style="width:150px;">
                                        <button type="button" onclick="view_sum(this)"
                                        value = "{{$paided->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
                                        </button>
                                </td>
                                <td class="text-center" style="width:70px;">
                                        <button type="button" onclick="view_info(this)"
                                        value = "{{$paided->payment_id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6">
                                <h2><strong>List of Withholding Tax</strong></h2>
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
                                <th>DR number</th>
                                {{-- <th>Trip Ticket</th> --}}
                                <th>Customer</th>
                                <th>Location</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                               
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($incometax as $tax)
                                <tr>
                                <td class="text-center">DR-{{STR_PAD($tax->id,8,"0",STR_PAD_LEFT)}}</td>
                                <td class="text-center">{{$tax->business_name == null ? $tax->name : $tax->business_name}}</td>
                                <td class="text-center">{{$tax->address}}</td>
                                <td class="text-center"><b>{{number_format($tax->amount_paid)}}</b></td>
                                <td class="text-center">{{$tax->payment_date}}</td>
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
<div class="modal fade bd-example-modal-lg" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title text-white" id="myLargeModalLabel">New Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                    <div class="modal-body">
                        <form action="/transanction/add/payment" id="order-payment" method="post">
                           @csrf

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="unit">Payment Date</label>
                                <input class = "form-control" type="date" value="" id="p-date" name="payment_date" required/>
                                {{-- <input class = "form-control" type="date" value="{{$today}}" id="p-date" name="payment_date" required/> --}}
                                    </div>
                                <div class="form-group  default-select">
                                    <label for="unit">Payment Type</label>
                                        {{-- <input class = "form-control" type="text" value="" id="payment-type" name="payment-type" readonly/> --}}
                                        <select class="form-control select2" name="payment-type" id="payment-type" required>
                                            <option value="">Select Payment Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{$type->type}}">{{$type->type}}</option>       
                                            @endforeach
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

                                    <div class="direct-deposit">
                                        <div class="form-group default-select">
                                            <label for="bank">Select Bank</label>
                                                 <select class="form-control select2" data-placeholder="Select" id="bankname" name="bankname">
                                                    <option value="" selected="true" disabled="true">Select Bank</option>
                                                        @foreach ($banks as $bank)
                                                            <option value="{{$bank->id}}">{{$bank->bank}}-{{$bank->bank_account}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
    
                                            <div class="form-group">
                                                <label for="unit">Transaction Number:</label>
                                                    <input class = "form-control" type="text" value="" id="Transaction-no" name="Transaction-no" />  
                                                </select>
                                            </div>
                                    </div>

                                   
                                        <div class="form-group">
                                            <label for="unit">Dr NO:</label>
                                                <input class = "form-control" type="text" value="" id="payment-drno" readonly/>  
                                            </select>
                                        </div>
                                   
                               
    {{-- Cheque Section --}}
                                
                                <div class="form-group">
                                    <label for="unit">Total Amount</label>
                                        <input class="form-control" type="text" id="payment-amount" name="to_paid" value="" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="unit">Total Balance</label>
                                        <input class="form-control" type="text" id="total-balance" name="total_balance" value="" readonly>
                                </div>

                                </div>
                                <div class="col-lg-6">
                                    <input type="hidden" value="" id="drno" name="drno" />

                              
                                {{--  Payment Denomination--}}
                                <hr>
                                <h6>Denomination Amount</h6>
                                <br/>
                                
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem1000">1000 - bill</label>
                                                    <input class="form-control dem" data-amount = "1000" type="text" id="dem1000" name="dem1000" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem500">500 - bill</label>
                                                    <input class="form-control dem" data-amount ="500" type="text" id="dem500" name="dem500" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem200">200 - bill</label>
                                                    <input class="form-control dem" data-amount ="200" type="text" id="dem200" name="dem200" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem100">100 - bill</label>
                                                    <input class="form-control dem" data-amount ="100" type="text" id="dem100" name="dem100" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem50">50 - bill</label>
                                                    <input class="form-control dem" data-amount ="50" type="text" id="dem50" name="dem50" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem20">20 - bill</label>
                                                    <input class="form-control dem" data-amount ="20" type="text" id="dem20" name="dem20" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem10">10 - Coin</label>
                                                    <input class="form-control dem" data-amount ="10" type="text" id="dem10" name="dem10" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem5">5 - Coin</label>
                                                    <input class="form-control dem" data-amount ="5" type="text" id="dem5" name="dem5" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem1">1 - Coin</label>
                                                    <input class="form-control dem" data-amount ="1" type="text" id="dem1" name="dem1" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem025">.25 - Coin</label>
                                                    <input class="form-control dem" data-amount =".25" type="text" id="dem025" name="dem025" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem010">.10 - Coin</label>
                                                    <input class="form-control dem" data-amount =".10" type="text" id="dem010" name="dem010" value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dem005">.05 - Coin</label>
                                                    <input class="form-control dem" data-amount =".05" type="text" id="dem005" name="dem005" value="">
                                            </div>
                                        </div>
                                        

                                    </div>

                                <hr>

                                <div class="form-group default-select">
                                    <label for="bank">Select Money Remittance</label>
                                         <select class="form-control select2" data-placeholder="Select" id="remittance" name="remittance">
                                            <option value="" selected="true" disabled="true">Select Remittance</option>
                                               @foreach ($categories as $cat)
                                                     <option value="{{$cat->id}}">{{$cat->Remittance}}</option>
                                               @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="premarks">Remarks</label>
                                            <input class="form-control" type="text" id="premarks" name="premarks" >
                                    </div>

                                <div class="form-group">
                                    <label for="unit">Payment</label>
                                        <input class="form-control" type="number" id="payment" name="payment" >
                                </div>
                            </div>
                        </div>  
{{--                         end row           --}}
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
                    $('.nav-order-payment').addClass('active');
                
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
<script src="{{asset('assets/js/myjs/transactions/order-payment.js')}}"></script>
<script>
$('.n-counter').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
}, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
                $(this).text(Math.ceil(now).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }
    });
});

const view_sum = (id)=>{

    const drno = id.value;

    location.href = '/payments/order-sum/'+drno;


}

const view_info = (id)=>{

    const transid = id.value;

    location.href = '/order-payment/details/'+transid;
}

</script>


@endsection
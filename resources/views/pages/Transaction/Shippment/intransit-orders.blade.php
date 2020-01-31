@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">

    
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
                            <h4 class="page-title">Intransit Orders</h4>
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
                                    <h2><strong>List of Orders</strong></h2>
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
                                            <th>DR number</th>
                                            <th>Trip Ticket</th>
                                            <th>Customer</th>
                                            <th>Location</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Trip Schedule</th>
                                            <th>DR Form</th>
                                            <th>Intransit Form</th>
                                            @can('Customers')
                                            <th>Cancel Order</th>
                                            @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Orders as $order)
                                    <tr>
                                    <td class="text-center">DR-{{str_pad($order->id,8,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center">T-{{str_pad($order->id,6,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center">{{$order->business_name == null ? $order->name : $order->business_name }}</td>
                                    <td class="text-center">{{$order->address}}</td>
                                    <td class="text-center">{{number_format($order->total_amount,2)}}</td>
                                    <td class="text-center">{{$order->type}}</td>
                                    <td class="text-center">TS-{{str_pad($order->trip_id,8,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center"><button type="button" onclick="print_dr(this)"
                                        value = "{{$order->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">local_shipping</i>
                                        </button></td>
                                        <td class="text-center"><button type="button" onclick="print_dc(this)"
                                            value = "{{$order->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">local_shipping</i>
                                            </button></td>
                                            @can('Customers')
                                            <td class="text-center">
                                                <button type="button" onclick="cancel_order(this)"
                                                value = "{{$order->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">cancel</i>
                                                </button>
                                            </td> 
                                            @endcan
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
    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                              order summary
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Approve</button>
                    </form>
                        <button type="button" id ="del" class="btn btn-danger waves-effect">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
                window.onload = function () {
                    // $('.nav-transaction').click();
                    // $('.nav-shippment').click();
                    $('.nav-ship-orders').addClass('active');
                    $('.nav-intransit-orders').addClass('active');
                
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
<script src="{{asset('assets/js/myjs/shippment/customer-order.js')}}"></script>
<script src="{{asset('assets/js/myjs/shippment/cancel-cs-order.js')}}"></script>
<script>

const print_dc = (id)=> {

const order = id.value;

    location.href= '/intransit/form/'+order;


}
</script>

@endsection
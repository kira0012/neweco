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
                            <h4 class="page-title">Customer Orders</h4>
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
                                    <h2><strong>Customer Orders</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Customers')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#NewDR" style="float:right"><i data-feather="layers" style="height:15px"></i>Add Orders</button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>DO number</th>
                                        <th>Customer</th>
                                        <th>Location</th>
                                        <th>Amount</th>
                                        @can('Customers')
                                        <th>Order List</th>
                                       @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DrOrders as $Orders)
                                        <tr>
                                        <td class="text-center">ON-{{str_pad($Orders->id,8,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center">{{$Orders->business_name}}</td>
                                        <td class="text-center">{{$Orders->address}}</td>
                                        <td class="text-center">{{$Orders->total_amount}}</td>
                                        
                                      
                                            @can('Customers')
                                            <td class="text-center">
                                            <button type="button" onclick="order_list(this)"
                                            value = "{{$Orders->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">list</i>
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


<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Sorting</h4>
                            </li>
                        </ul>
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
                                        <h2><strong>Sorting Orders</strong></h2>
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
                                            <th>Customer</th>
                                            <th>Location</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>print</th>
                                            @can('Customers')
                                            <th>Intransit</th>
                                            <th>Cancel</th>
                                            @endcan
                                        
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($StOrders as $Orders)
                                            <tr>
                                            <td class="text-center">DR-{{str_pad($Orders->id,8,"0",STR_PAD_LEFT)}}</td>
                                            <td class="text-center">{{$Orders->business_name}}</td>
                                            <td class="text-center">{{$Orders->address}}</td>
                                            <td class="text-center">{{number_format($Orders->total_amount,4)}}</td>
                                            <td class="text-center">{{$Orders->type}}</td>
                                            <td class="text-center">
                                                <button type="button" onclick="view_order(this)"
                                                value = "{{$Orders->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons" style="margin-left:2px;">printer</i>
                                                </button>
                                            </td>   
                                            @can('Customers')
                                            <td class="text-center"><button type="button" onclick="send_to_truck(this)"
                                                value = "{{$Orders->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">local_shipping</i>
                                                </button>
                                            </td>
                                            
                                            <td class="text-center">
                                                <button type="button" onclick="cancel_order(this)"
                                                value = "{{$Orders->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
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
<div class="modal fade" id="NewDR" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-white" id="exampleModalCenterTitle">Create DR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                    <div class="modal-body">
                        <form action="/customer-dr" id="dr-form" method="post">
                           @csrf
                                    <div class="form-group default-select">
                                        <label for="unit">Select Customer</label>
                                            <select class="form-control select2" data-placeholder="Select" id="bussiness" name="customer" required>
                                                <option value=""></option>
                                                @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->business_name == null ? $customer->name : $customer->business_name}}</option>     
                                                @endforeach       
                                        </select>
                                    </div>
                                    <div class="form-group default-select">
                                        <label for="unit">Select Product</label>
                                            <select class="form-control select2" data-placeholder="Select" id="p-product" name="p-product" required>
                                                <option value=""></option>
                                                    @foreach ($Products as $Product)
                                                        <option value="{{$Product->id}}">{{$Product->product_name}} | {{$Product->description}}</option>     
                                                @endforeach       
                                        </select>
                                    </div>
                                    <div class="form-group default-select">
                                        <label for="unit">Select Stock</label>
                                            <select class="form-control select2" data-placeholder="Select" id="p-stock" name="stock_id">
                                                <option value="" selected="true" disabled="true"></option>       
                                        </select>
                                    </div>

                                    <div class="form-group default-select">
                                        <label for="unit">Warehouse</label>
                                             <select class="form-control" data-placeholder="Select" id="p-wr" >
                                                <option value="" selected disabled="true"></option>
                                                @foreach ($Warehouse as $wr)
                                                     <option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                        <input type="hidden" id="chk-wr" value="" />
                                    </div>
                                           <div class="row">
                                               <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="available">Available Stock</label>
                                                            <div class="form-line">
                                                                <input type="text" id="available-stock" name="available" value="" class="form-control" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label for="available">Price</label>
                                                                    <div class="form-line">
                                                                        <input type="text" step="0.0001" id="stock-price" name="price" value="" class="form-control" >
                                                                    </div>
                                                                </div>

                                                     </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="available"> Order</label>
                                                            <div class="form-line">
                                                                <input type="text" id="order-qty" name="order-qty" value="" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="available">Total Price</label>
                                                            <div class="form-line">
                                                                <input type="text" id="order-price" name="order-price" value="" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                </div>


                            </div>
                        
                        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="c-dr" class="btn btn-info waves-effect">Create DR</button>
                   
                        {{-- <button type="button" id ="del" class="btn btn-danger waves-effect">Delete</button> --}}
                    </div>
                </div>
            </div>
        </div>





        <div class="modal fade" id="add-to-trip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Select Trip Schedule</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                                <div class="modal-body">
                                    <form action="/customer/order/send" id="form-Ordersend" method="post">
                                       @csrf
                                            <input type="hidden" value="" id="dr-trip" name="dr-no" />
                                                <div class="form-group default-select">
                                                     <label for="remarks">Shippment Type</label>
                                                        <select class="form-control select2" data-placeholder="Select" id="ship-type" name="ship-type" required>
                                                            <option value="" selected disabled="true">Select Shipment Type</option>
                                                            <option value="1">Deliver</option>
                                                            <option value="2">Pick Up</option>
                                                    </select>
                                                </div>
                                                    <div class="hideto">
                                                            <div class="form-group default-select">
                                                    <label for="remarks">Select Trip Schedule & Vehicle</label>
                                                        <select class="form-control select2" data-placeholder="Select" id="trip-sched" name="trip-sched" >
                                                            <option value=""></option>
                                                            @foreach ($TripTickets as $ticket)
                                                                 <option value="{{$ticket->id}}">{{$ticket->departure}}, PlateNo:{{$ticket->plateNo}}</option>
                                                            @endforeach
                                                               
                                                    </select>
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="remarks">Delivery Remarks</label>
                                                        <textarea class="form-control" name="remarks" id="remarks" cols="60" rows="7"></textarea>
                                                   
                                                </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="intransit" class="btn btn-info waves-effect">Set Delivery</button>
                               
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                            window.onload = function () {
                                // $('.nav-transaction').click();
                                // $('.nav-shippment').click();
                                $('.nav-ship-orders').addClass('active');
                                $('.nav-customer-orders').addClass('active');
                            
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


@endsection
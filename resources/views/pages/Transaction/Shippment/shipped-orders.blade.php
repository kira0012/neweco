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
.cs-top{

margin-top: 12px;
}

.item-center{
align-content: center;
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
                            <h4 class="page-title">Shipped Orders</h4>
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
                                        <th>Customer</th>
                                        <th>Location</th>
                                        <th>Total Amount</th>
                                        <th>Payment Term</th>
                                        <th>Trip Ticket</th>
                                        <th>Order List</th>
                                        <th>Return</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($Orders as $order)
                                        <tr>
                                        <td class="text-center">DR-{{str_pad($order->id,8,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center" id="cname-{{$order->id}}">{{$order->business_name == null ? $order->name : $order->business_name}}</td>
                                        <td class="text-center">{{$order->address}}</td>
                                        <td class="text-center">{{number_format($order->total_amount,4)}}</td>
                                        <td class="text-center">{{$order->type}}</td>
                                        <td class="text-center">T-{{str_pad($order->trip_id,8,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center"><button type="button" onclick="print_dr(this)"
                                            value = "{{$order->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">local_shipping</i>
                                            </button></td>
                                            <td class="text-center">
                                                @can('Customers')
                                                    <button type="button" onclick="return_item(this)"
                                                value = "{{$order->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">assignment_return</i>
                                                </button>
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
    </div>
</section>
{{-- Modals --}}     



<div class="modal fade" id="customer_return" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">Return Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form action="/customer/product-return" method="post" id="form-return">
                            @csrf
                            <input type="hidden" value="" id="drno" name="drno">
                        <div class="form-group">
                            <Label for="cs_name">Customer:</Label>
                            <input class = "form-control" type="text" name="cs_name" id="cs_name" />
                        </div>
                        <div class="form-group default-select">
                                <Label for="cs_product">Customer Products:</Label>
                                <select class="form-control select2" data-placeholder="Select" id="cs_product">
                                        <option value="0" selected disabled="true">Select Product</option> 
                                </select>
                                <div class="row cs-top">
                                    <div class="col-lg-4 item-center">
                                        <h6>Stock Code</h6>
                                        <div id="prod">
                                                <input class = "form-control" type="text" name="pad_stock"  />
                                        </div>
                                            
                                    </div>
                                    <div class="col-lg-3 item-center">
                                        <h6>Qty</h6>
                                        <div id="Qty">
                                            <input class = "form-control" type="text" name="cs_qty" />
                                        </div>
                                           
                                        </div>
                                        <div class="col-lg-5" >
                                         
                                                <h6 class="item-center">Action</h6>
                                            
                                                <div id="action">
                                                        <select class="form-control cs-top" data-placeholder="Select" id="cs_product">
                                                                <option value="Return">Return</option> 
                                                                <option value="Replace">Return/Replace</option> 
                                                                <option value="Disposed">Disposed/Replace</option> 
                                                        </select>
                                                </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                                <label for="csremarks">Remarks</label>
                                                <textarea name="remarks" id="csremarks" cols="30" rows="10"></textarea>
                                        </div>
                                       
                                </div>
                        </div>
                       

                         
                </div>
                <div class="modal-footer">
                    <button type="button" id="rtn-clear" class="btn btn-danger waves-effect">Clear</button>
                    <button type="submit" id="rtn-save" class="btn btn-info waves-effect">Return</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>

        
        <script>
                window.onload = function () {
                    $('.nav-ship-orders').addClass('active');
                    $('.nav-shipped-orders').addClass('active');
                
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
<script src="{{asset('assets/js/myjs/shippment/return-order.js')}}"></script>

<script>
    function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

const print_dr = (id)=>{

    const order = id.value;
    location.href = '/customer/print/dr-form/'+order;

    
}
</script>

@endsection
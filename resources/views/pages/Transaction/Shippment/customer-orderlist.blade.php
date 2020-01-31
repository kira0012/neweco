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
    height: 350px;
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
                            <h4 class="page-title">
                                    <button type="button" onclick="go_back(this)"
                                    value = "" class="btn btn-info btn-cback btn-circle waves-effect waves-circle waves-float">
                                       <i class="material-icons">arrow_back</i>
                                   </button>
                                   Customer Order
                            </h4>
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
                                    <h2><strong>List Of Orders</strong></h2>
                                  
                            </div>
                            <div class="col-lg-6">
                                @can('Customers')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#addDr" style="float:right"><i data-feather="user-plus" style="height:20px"></i> <span>Add Product</span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            
                            
                                <table class="table table-bordered">
                                        <thead>
                                               <tr>
                                               <input type="hidden" value="" id="s-id" />

                                               <td colspan="5">Customer: {{$DrCustomer->business_name == null ? $DrCustomer->name : $DrCustomer->business_name}}</td>  
                                               <td colspan="4">Date: {{$DrDetails->order_date}}</td>
                                               </tr>
                                               <tr>
                                               <td colspan="5">Address: {{$DrCustomer->address}} </td>
                                               <td colspan="1">Terms:</td>
                                               <td colspan="3">
                                                    {{-- @if ($DrDetails->payment_terms != null)
                                                    <input type="hidden" id="my-pterm" value="{{$DrDetails->payment_terms}}" />
                                                    @else
                                                    <input type="hidden" id="my-pterm" value="0" />
                                                    @endif --}}
                                                    <input type="hidden" id="my-pterm" value="{{$DrDetails->payment_terms}}" />
                                                <form action="/customer/order/submit" method="post" id="c-dr-form">
                                                    @csrf
                                                <input type="hidden" value="{{$DrDetails->id}}" name="dr_no" />
                                                <div class="form-group default-select">
                                                   <select class="form-control select2" data-placeholder="Select" id="p-type" name="p-type" >
                                                      <option value="" selected disabled="true"></option>
                                                         @foreach ($payments as $payment)
                                                             <option value="{{$payment->id}}">{{$payment->type}}</option>
                                                        @endforeach
                                                     </select>
                                                    </div>
                                                    </form>
                                                </td>
                                               </tr>
                                               <tr>
                                                    
                                                <td colspan="3">P.O. No: ON-{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</td>
                                               <td colspan="2"> P.O Date {{$DrDetails->order_date}}</td>
                                                <td colspan="4">Released BY: {{$DrDetails->payment_terms}}</td>
                                                </tr>
                                               
                                               <tr>
                                                   <td colspan="9"><h6></h6></td>
                                               </tr>
                                               <tr>
                                               <td class="text-center">Product Code</td>
                                               <td class="text-center">Product Name</td> 
                                               <td class="text-center">Product Description</td>
                                               <td class="text-center">Qty</td>
                                               <td class="text-center">Unit</td>
                                               <td class="text-center">Unit/Price</td>
                                               <td class="text-center">Cost</td>
                                               <td class="text-center">Edit</td>
                                               <td class="text-center">Del</td>
                                              
                                               </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($DrOrders as $Product)
                                            <tr>
                                        
                                        <td class="text-center">{{$Product->product_code}}</td>
                                        <td class="text-center">{{$Product->product_name}}</td>
                                        <td class="text-center">{{$Product->description}}</td>
                                        <td class="text-center">{{$Product->qty}}</td>
                                        <td class="text-center">{{$Product->units}}</td>
                                        <td class="text-center">{{number_format($Product->price,4)}}</td>
                                        <td class="text-center">{{number_format($Product->total,4)}}</td>
                                        <td class="text-center"><button type="button" onclick="edit_order(this)"
                                        value = "{{$Product->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">call_missed_outgoing</i>
                                        </button></td>
                                        <td class="text-center"><button type="button" onclick="del_to_itemlist(this)"
                                            value = "{{$Product->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete</i>
                                            </button></td>


                                            </tr>
                                            @endforeach
                                            <tr>
                                            <td class="text-center" colspan="6">Total Cost</td>
                                            <td class="text-center" colspan="3">{{number_format($totalcost)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" colspan="6">Proceed</td>
                                                    <td class="text-center" colspan="3">
                                                        <button class="btn-hover btn-border-radius color-8" id="create-dr" style="float:right">
                                                            <i data-feather="truck" style="height:20px"></i>
                                                    <span>Create Dr</span></button>
                                                </td>
                                            </tr>
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
 
{{-- MOdals --}}
<div class="modal fade" id="AddDR" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                        <div class="modal-body">
                            <form action="/customer/dr/add-order" id="form-add-dr" method="post">
                               @csrf
                            <input type="hidden" value="{{$DrDetails->id}}" name="drno" />
                                        <div class="form-group default-select">
                                            <label for="unit">Select Product</label>
                                                <select class="form-control select2"  id="p-product" name="p-product" required>
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
                                                 <select class="form-control select2" data-placeholder="Select" id="p-wr" >
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
                                                                            <input type="text" step="0.0001" min="0" id="stock-price" name="price" value="" class="form-control" >
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
                            <button type="button" id="add-order" class="btn btn-info waves-effect">Add Order</button>
                       
                            <button type="button" id ="del-dr" class="btn btn-danger waves-effect">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
             


            <div class="modal fade" id="editorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                    <div class="modal-body">
                                        <form action="/customer/update-order" id="edit-dr-order" method="post">
                                           @csrf
                                        <input type="hidden" value="{{$DrDetails->id}}" name="drno" />
                                        <input type="hidden" value="" id="order-id" name="order-id">
                                                    <div class="form-group default-select">
                                                        <input type="hidden" value="" id="chker-product">
                                                        <label for="unit">Select Product</label>
                                                            <select class="form-control select2" data-placeholder="Select" id="product" name="p-product" required>
                                                                <option value=""></option>
                                                                    @foreach ($Products as $Product)
                                                                    <option value="{{$Product->id}}">{{$Product->product_name}}</option>     
                                                                @endforeach       
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" value="" id="chker-stock" name="stock_id">
                                                        <label for="unit">Select Stock</label>
                                                            <input class="form-control" type="text" value="" id="stock" readonly>
                                                    </div>
                
                                                    <div class="form-group default-select">
                                                        <label for="unit">Warehouse</label>
                                                             <select class="form-control select2" data-placeholder="Select" id="wr" >
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
                                                                                <input type="hidden" id="ini-available" name = "ini-available" />
                                                                                <input type="text" id="available" name="available" value="" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="form-group">
                                                                                <label for="available">Price</label>
                                                                                    <div class="form-line">
                                                                                        <input type="text" id="stk-price" step="0.0001" name="price" value="" class="form-control" >
                                                                                    </div>
                                                                                </div>
                
                                                                     </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="available"> Order</label>
                                                                            <div class="form-line">
                                                                                <input type="hidden" id="ini-qty" value="" name="ini-qty"/>
                                                                                <input type="text" id="ord-qty" name="order-qty" value="" class="form-control" required>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="form-group">
                                                                        <label for="available">Total Price</label>
                                                                            <div class="form-line">
                                                                                <input type="text" id="nt-price" name="order-price" value="" class="form-control" readonly>
                                                                            </div>
                                                                    </div>
                                                </div>
                
                
                                            </div>
                                        
                                        
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="update-order" class="btn btn-info waves-effect">Edit Order</button>
                                   
                                        <button type="button" id ="del-dr" class="btn btn-danger waves-effect">Delete</button>
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
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('assets/js/myjs/shippment/customer-order.js')}}"></script>
<script src="{{asset('assets/js/myjs/shippment/customer-orderlist.js')}}"></script>
<script>
 pay_type();
function pay_type(){

var pid = $('#my-pterm').val();

    if(pid != 0 || pid != ''){
        $('#p-type').val(pid);
    }
}

</script>

@endsection
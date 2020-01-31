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

.list-orders{

   
}
.total{

    margin-top: 12px;
}
.order-content{
    margin: 5px 5px 5px 5px;
    height: 328px;
    width: 350px;
    border-color: black;
    border-style: solid;
    overflow: scroll;
}

/* .table-order,th {

    font-size: 10px;
    height: 15px;

} */

.del{

    height: 20px !important;
    width: 20px !important;
    background-color: red !important;
}
.del:hover{
    background-color: lightcoral !important;
}

.i-del{

   font-size: 10px !important;
   /* color: white; */
    line-height: 0.5
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
                            <h4 class="page-title">Delivery Orders</h4>
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
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>New Order </span></button>
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
                                        <th>DO Number</th>
                                        <th>Order Date</th>        
                                        <th>Supplier Name</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Orders</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($Orders as $Order)
                                  <tr>
                                <td class="text-center">DO{{str_pad($Order->id,8,"0",STR_PAD_LEFT)}}</td>
                                <td class="text-center">{{$Order->order_date}}</td>
                                <td class="text-center">{{$Order->supplier}}</td>
                                <td class="text-center">{{number_format($Order->total_cost,4)}}</td>
                                  <td class="text-center">{{$Order->remarks}}</td>
                                  <td class="text-center"><a href="/delivery-order-details/{{$Order->id}}"><button type="button"
                                        class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons">assignment</i>
                                </button></a>
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
                                        <h2><strong>Recieved Orders</strong></h2>
                                        
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
                                                <th>DO Number</th>
                                                <th>Order Date</th>
                                                <th>Recieved Date</th>
                                                <th>Supplier Name</th>
                                                <th>Amount</th>
                                                <th>Paid Amount</th>
                                                <th>Remarks</th>
                                                <th>Orders</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($Recieved as $Order)
                                          <tr>
                                        <td class="text-center">DO{{str_pad($Order->id,8,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center">{{$Order->order_date}}</td>
                                        <td class="text-center">{{$Order->recieved_date}}</td>
                                        <td class="text-center">{{$Order->supplier}}</td>
                                        <td class="text-center">{{number_format($Order->total_cost,4)}}</td>
                                        <td class="text-center">{{number_format($Order->purchase_payments->sum('amount'),4)}}</td>
                                          <td class="text-center">{{$Order->remarks}}</td>
                                          <td class="text-center"><a href="/delivery-order-details/{{$Order->id}}"><button type="button"
                                                class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">assignment</i>
                                        </button></a>
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
                                            <h2><strong>Recieved Paid Orders</strong></h2>
                                            
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
                                                    <th>DO Number</th>
                                                    <th>Order Date</th>
                                                    <th>Recieved Date</th>
                                                    <th>Supplier Name</th>
                                                    <th>Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Remarks</th>
                                                    <th>Orders</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($Paid as $Order)
                                              <tr>
                                            <td class="text-center">DO{{str_pad($Order->id,8,"0",STR_PAD_LEFT)}}</td>
                                            <td class="text-center">{{$Order->order_date}}</td>
                                            <td class="text-center">{{$Order->recieved_date}}</td>
                                            <td class="text-center">{{$Order->supplier}}</td>
                                            <td class="text-center">{{number_format($Order->total_cost,4)}}</td>
                                            <td class="text-center">{{number_format($Order->purchase_payments->sum('amount'),4)}}</td>
                                              <td class="text-center">{{$Order->remarks}}</td>
                                              <td class="text-center"><a href="/delivery-order-details/{{$Order->id}}"><button type="button"
                                                    class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">assignment</i>
                                            </button></a>
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
     
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="myLargeModalLabel">New Purchase Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
            </div>
         <div class="modal-body">
            <form action="/new-purchase-order" method="post" id="form-order">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="orderdate">Order Date</label>
                                <div class="form-line">
                                    <input type="date" id="orderdate" name="orderdate" class="form-control" required>
                                </div>
                            </div>
                            <input type="hidden" value="" id="s-check" />

                            <div class="form-group default-select">
                                <label for="supplier-id">Select Supplier</label>
                                <select class="form-control select2" id="supplier-id" name="supplier-id">
                                    <option value="0">Select Supplier</option>
                                        @foreach ($Suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier}}</option>
                                        @endforeach
                                    </select>
                                </div>
                      
                        <div class="form-group default-select">
                                <label for="product-id">Select Product</label>
                                    <select class="form-control select2" data-placeholder="Select" id="product-id" name="product-id">
                                        <option value="" selected="true" disabled="true"></option>
                                    </select>
                                </div> 

                        <div class="form-group">
                            <label for="available">Product Description</label>
                                <div class="form-line">
                                        <input type="text" id="p-description" name="description" value="" class="form-control" readonly>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-6">  
                                <div class="form-group default-select">
                                    <label for="available">Unit</label>
                                        <div class="form-line">
                                                <select class="form-control " data-placeholder="Select" id="unit-id" >
                                                    <option value="" selected="true" disabled="true"></option>
                                                        @foreach ($Units as $unit)
                                                            <option value="{{$unit->id}}">{{$unit->units}}</option>
                                                        @endforeach  
                                                    </select>
                                                </div>
                                        </div>
                            </div>
                            <div class="col-lg-6"> 
                                <div class="form-group ">
                                        <label for="available">Price/Unit</label>
                                            <div class="form-line">
                                                    <input type="number" id="p-price" name="price" placeholder ="0" min="0" step="0.0001" class="form-control" >
                                                    <input type="hidden" value="" id="p-productcode" />
                                                </div>
                                            </div>
                                        </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                            <label for="available">Quantity</label>
                                                <div class="form-line">
                                                    <input type="number" id="p-qty" name="qty" min="0" value="" class="form-control" >
                                                </div>
                                            </div>
                                <div class="form-group">
                                    <label for="available">Remarks</label>
                                        <div class="form-line">
                                            <input type="text" id="remarks" name="Remarks"  class="form-control" >
                                        </div>
                                    </div>
                            </div>

                                      <button class="btn-hover btn-border-radius color-1" type="button" id="to-orderlist" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Add Order </span></button>
                                  

                            </div>
                            </div>
                        <div class="col-lg-6">
                            <div class="list-orders">
                                <div class="order-content">
                                    <table class="table-order">
                                        <Tr class="text-center">
                                            <th>Product Code</th>
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                        </Tr>
                                        <tbody id = "po-list">
                                            
                                        </tbody>

                                    </table>
                                </div>


                                    <div class="form-group total">
                                            <label for="available">Total Cost</label>
                                                <div class="form-line">
                                                        <input type="text" id="total-cost" name="total_cost" value="" placeholder="0" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            <div class="row">
                                                 <div class="col-lg-6">
                                                
                                                 </div>
                                              <div class="col-lg-6">
                                                  <button class="btn-hover btn-border-radius color-1" type="button" id="place-order" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Place Order </span></button>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                    window.onload = function () {
                        // $('.nav-inventory').click();
                        // $('.nav-warehouse-inventory').addClass('active');
                        $('.nav-purchase-order').addClass('active');
                    
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
{{-- <script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script> --}}
<script src="{{asset('assets/js/myjs/warehouse/delivery-order.js')}}"></script>

<script>



</script>

@endsection
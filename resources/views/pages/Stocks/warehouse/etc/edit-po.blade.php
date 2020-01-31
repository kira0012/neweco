@extends('layouts.template')
@section('htmlhead')
 
@endsection
<style>
.modal-header{
    background-color: #007bff;
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
                            <h4 class="page-title">List of Delivery Order</h4>
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
                                
                                   
                    <button type="button" onclick="go_back(this)"
                    value = "{{$Order_Details->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons">arrow_back</i>
                                    </button>
                                    
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#add-extra" style="float:right"><i data-feather="user-plus" style="height:20px"></i> <span>Add Product</span></button>
                            </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            
                            
                                <table class="table table-bordered">
                                        <thead>
                                               <tr>
                                               <input type="hidden" value="{{$Supplier->id}}" id="s-id" />

                                               <td colspan="5">Supplier: {{$Supplier->supplier}}</td>  
                                               <td colspan="4">Date: {{$Order_Details->order_date}}</td>
                                               </tr>
                                               <tr>
                                               <td colspan="5">Address: {{$Supplier->address}}</td>
                                               <td colspan="4">No. of Orders: {{$Order_Details->no_order}}</td>
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
                                            @foreach ($Order_Products as $Product)
                                            <tr>
                                        
                                        <td class="text-center">{{$Product->product_code}}</td>
                                        <td class="text-center">{{$Product->product_name}}</td>
                                        <td class="text-center">{{$Product->description}}</td>
                                        <td class="text-center">{{$Product->product_qty}}</td>
                                        <td class="text-center">{{$Product->units}}</td>
                                        <td class="text-center">{{number_format($Product->unit_price,4)}}</td>
                                        <td class="text-center">{{number_format($Product->cost,4)}}</td>
                                        <td class="text-center"><button type="button" onclick="edit_order(this)"
                                        value = "{{$Product->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">call_missed_outgoing</i>
                                        </button></td>
                                        <td class="text-center"><button type="button" onclick="del_order(this)"
                                            value = "{{$Product->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">delete</i>
                                            </button></td>


                                            </tr>
                                            @endforeach
                                            <tr>
                                            <td class="text-center" colspan="6">Total Cost</td>
                                            <td class="text-center" colspan="3">{{$Order_Details->total_cost}}</td>
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
         
            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="add-extra" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-header text-white">
                            <h5 class="modal-title" id="myLargeModalLabel">Add Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-content">
                            <div class="modal-body">
                                 <form action="/add-extra-order" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <input type="hidden" value="{{$Order_Details->id}}" name="po_id">   
                                    <div class="row">
                                            <div class="col-lg-6">
                                                    <div class="form-group default-select">
                                                        <label>Select Product</label>
                                                            <select class="form-control select2" data-placeholder="Select" name="product_id" id="product-id" required>                                                                    
                                                                <option value="" disable="true" selected>Select Product</option>
                                                            </select>
                                                        </div>
                                               <div class="form-group">
                                                   <label for="p-qty">Product Quantity</label>
                                                       <div class="form-line">
                                                         <input type="number" id="p-qty" name="p-qty" class="form-control" placeholder="Quantity" required>
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                    <div class="form-line">
                                                        <input class="form-control"  type="text" id="p-description" name="p-description" placeholder=" " readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-lg 6"> 
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
                                                <div class="form-group">
                                                        <label for="available">Price/Unit</label>
                                                            <div class="form-line">
                                                                    <input type="number" id="p-price" name="price" step="0.0001" value="0" class="form-control" required >
                                                                    <input type="hidden" value="" id="p-productcode" />
                                                                </div>
                                                            </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                            </div>
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Product </span></button>
                                                        </div>
                                                    </div>
                                              </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal-edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                        <div class="modal-header text-white">
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                 <form action="/update-po" method="post" enctype="multipart/form-data" >
                                                    @csrf
                                                    <input type="hidden" value="" id="id-edit-item" name="edit-id">    
                                                    <div class="row">
                                                            <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Select Product</label>
                                                                            <select class="form-control select2" data-placeholder="Select" name="p-id" id="pr-id" required>
                                                                                   
                                                                                </select>
                                                                        </div>
                                                               <div class="form-group">
                                                                   <label for="p-qty">Product Quantity</label>
                                                                       <div class="form-line">
                                                                         <input type="number" id="qty" name="p-qty" class="form-control" placeholder="Quantity" required>
                                                                    </div>
                                                                </div>
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                    <div class="form-line">
                                                                        <input class="form-control"  type="text" id="p-desc" name="p-description" placeholder=" " readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="col-lg 6"> 
                                                            <div class="form-group">
                                                                <label for="available">Unit</label>
                                                                    <div class="form-line">
                                                                        <select class="form-control select2" data-placeholder="Select" id="unit" >
                                                                            <option value="" selected="true" disabled="true"></option>
                                                                                @foreach ($Units as $unit)
                                                                                    <option value="{{$unit->id}}">{{$unit->units}}</option>
                                                                                @endforeach  
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <div class="form-group">
                                                                        <label for="available">Price/Unit</label>
                                                                            <div class="form-line">
                                                                                    <input type="number" step="0.0001" id="price-unit" name="price" value="0" class="form-control" required readonly >
                                                                                    <input type="hidden" value="" id="p-productcode" />
                                                                                </div>
                                                                            </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                                <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                                            </div>
                                                                        <div class="col-lg-6">
                                                                                <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Save Product </span></button>
                                                                        </div>
                                                                    </div>
                                                              </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/form.min.js')}}"></script>
<script src="{{asset('assets/js/myjs/warehouse/edit-purchase.js')}}"></script>
<script>


</script>

@endsection
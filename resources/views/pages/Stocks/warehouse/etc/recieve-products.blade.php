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

.btn-dcolor{

    background-color: lightgreen !important;

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
                            <h4 class="page-title">Recieve Stock</h4>
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
                                    <h2><strong>Purchased Order Details</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">

                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">

                            <form action="/add-stock" method="post">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                        <td colspan="3">Order Date: {{$Order_Details->order_date}}</td>
                                        <td colspan="2">Date Recieve: {{$today}}</td>
                                        </tr>
                                        <tr>
                                        <td colspan="3">Supplier: {{$Supplier->supplier}}</td>
                                        <td colspan="2">Total Cost {{number_format($Order_Details->total_cost,4)}}</td>
                                        </tr>
                                        <tr>
                                        <td colspan="5">Address: {{$Supplier->address}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                        </tr>
                                        <tr>
                                            <td>Po Number: </td>
                                        <td style = "color:red;">PO-{{str_pad($Order_Details->id,8,"0",STR_PAD_LEFT)}}
                                        <input type="hidden" value="{{$Order_Details->id}}" name="po_id"></td>

                                            <td>Select Warehouse</td>
                                                <td colspan="2">
                                                    <div class="form-group default-select">
                                                        <select class="form-control select2" data-placeholder="Select" id="warehouse-id" name="warehouse-id" required>
                                                            <option value="" selected="true" disabled="true" ></option>
                                                            @foreach ($Warehouse as $wr)
                                                                 <option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        <tr>
                                            <td class="text-center">Product Code</td>
                                            <td class="text-center">Description</td>
                                            <td class="text-center">No of Order</td>
                                            <td class="text-center">No of Recieve</td>   
                                            <td class="text-center">SRP</td> 
                                        </tr>
                                        <tbody>
                                            @foreach ($Order_Products as $Product)
                                            <tr>
                                            <td class="text-center">{{$Product->product_code}}</td>
                                            <td class="text-center">{{$Product->description}}</td>
                                            <td class="text-center">{{$Product->product_qty}}
                                            <input type="hidden" value="{{$Product->products_id}}" name="product_id[]"/>
                                            
                                            </td>
                                            <td class="text-center"><center><input type="number" class="form-control col-sm-5" name="recieve_no[]" required/></center></td>
                                            <td class="text-center"><center><input type="number" class="form-control col-sm-5" step="0.0001" name="srp[]" required/></center></td>
                                        <input type="hidden" name="cost[]" value="{{$Product->unit_price}}" />
                                            
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5">
                                                    <button class="btn-hover btn-border-radius color-8" style="float:right">
                                                        <i data-feather="box" style="height:15px"></i> <span>Recieve Order</span></button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>


@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>

@endsection
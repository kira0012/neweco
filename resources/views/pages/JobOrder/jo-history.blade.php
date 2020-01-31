@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
{{-- <link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> --}}
    
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
                            <h4 class="page-title">Job Orders</h4>
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
                                <h4 class="m-t-5 m-b-20">This Month Ongoing Job Orders</h4>
                            <h3 class="f-w-700 col-blue n-counter">{{$ongoing}}</h3>
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
                                <h4 class="m-t-5 m-b-20">This Month Done Job Order</h4>
                            <h3 class="f-w-700 col-green n-counter">{{$done}}</h3>
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
                                <h2><strong>Job Order History</strong></h2>
                        </div>
                        <div class="col-lg-6">
                                {{-- <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Add J.O</span></button>
                                     --}}
                        </div>
                    </div>
                </div>
            <div class="body">
{{-- button d2 --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                        <thead>
                            <tr>
                                <th>JO number</th>
                                <th>Category</th>
                                <th>Descripton</th>
                                <th>Amount</th>
                                <th>Cost</th>
                                <th>Jo Date</th>
                                {{-- <th>Action</th> --}}
                                
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($jos as $jo)
                                    <tr>
                                    <td class="text-center">JO-{{str_pad($jo->id,5,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center">{{$jo->category}}</td>
                                    <td class="text-center">{{$jo->description}}</td>
                                    <td class="text-center">{{$jo->amount}}</td>
                                    <td class="text-center">{{$jo->cost}}</td>
                                    <td class="text-center">{{$jo->jo_date}}</td>
                                    {{-- <td class="text-center">
                                        <button type="button" onclick="update_jo(this)"
                                        value = "{{$jo->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
                                        </button> | 
                                        <button type="button" onclick="delete_jo(this)"
                                        value = "{{$jo->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </button>

                                    </td> --}}
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
 
        <script>
                window.onload = function () {
                    $('.nav-job').click();
                    $('.nav-jo-history').addClass('active');
                   // $('.nav-order-payment').addClass('active');
                
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
{{-- <script src="{{asset('assets/js/myjs/Transactions/order-payment.js')}}"></script> --}}
<script>


</script>


@endsection
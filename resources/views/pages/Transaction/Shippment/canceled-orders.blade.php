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
                            <h4 class="page-title">Cancelled Orders</h4>
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
                                            <th>Amount</th>
                                            <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">DR-{{str_pad($order->id,8,"0",STR_PAD_LEFT)}}</td>
                                            <td class="text-center">{{$order->business_name == null ? $order->name : $order->business_name  }}</td>
                                            <td class="text-center">{{number_format($order->total_amount,3)}}</td>
                                            <td class="text-center">{{$order->order_date}}</td>
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
        

        <script>
                window.onload = function () {
                    // $('.nav-transaction').click();
                    // $('.nav-shippment').click();
                    $('.nav-ship-orders').addClass('active');
                    $('.nav-shipped-cancel').addClass('active');
                
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
<script>

</script>

@endsection
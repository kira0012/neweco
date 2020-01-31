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
                                    <h2><strong>List of Pending Stock</strong></h2>
                                    
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
                                        <th>PO Number</th>
                                        <th>Order Date</th>
                                        <th>Supplier Name</th>
                                        <th>Amount</th>
                                        <th>Recieve Order</th>                                       
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($Orders as $Order)
                                        <tr>
                                      <td class="text-center">PO{{str_pad($Order->id,8,"0",STR_PAD_LEFT)}}</td>
                                      <td class="text-center">{{$Order->order_date}}</td>
                                      <td class="text-center">{{$Order->supplier}}</td>
                                      <td class="text-center">{{number_format($Order->total_cost,4)}}</td>
                                        <td class="text-center">
                                            @can('Inventory')
                                            <a href="/recieve/delivery-order/{{$Order->id}}"><button type="button"
                                              class="btn btn-dcolor btn-circle waves-effect waves-circle waves-float">
                                              <i class="material-icons">local_shipping</i>
                                      </button></a>
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



<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Recieved Stock</h4>
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
                                        <h2><strong>List of Recieved Stock</strong></h2>
                                        
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
                                            <th>PO Number</th>
                                            <th>Order Date</th>
                                            <th>Supplier Name</th>
                                            <th>Amount</th>
                                            <th>Recieve Date</th>                                       
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($Recieved as $Order)
                                            <tr>
                                          <td class="text-center">PO{{str_pad($Order->id,8,"0",STR_PAD_LEFT)}}</td>
                                          <td class="text-center">{{$Order->order_date}}</td>
                                          <td class="text-center">{{$Order->supplier}}</td>
                                          <td class="text-center">{{number_format($Order->total_cost,4)}}</td>
                                          <td class="text-center">{{$Order->recieve_date}}</td>
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
                $('.nav-inventory').click();
                $('.nav-warehouse-inventory').addClass('active');
                $('.nav-recieve-order').addClass('active');
            
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

<script>
     function imgpreview(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {           
                    $('#imgp').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

@endsection
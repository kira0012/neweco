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
                            <h4 class="page-title">Stock On Hand</h4>
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
                                    <h2><strong>List of Stock</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                    {{-- <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Print </span></button>
                                     --}}
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Stock ID</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>On Hand</th>
                                        <th>Cost</th>
                                        <th>Selling Price</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($stocks as $stock)
                                  <tr>
                                      <td class="text-center">ST-{{str_pad($stock->id,8,"0",STR_PAD_LEFT)}}</td>
                                  <td class="text-center">{{$stock->product_name}}</td>
                                  <td class="text-center">{{$stock->description}}</td>
                                  <td class="text-center">{{$stock->stock}}</td>
                                  <td class="text-center">{{number_format($stock->cost,4)}}</td>
                                  <td class="text-center">{{number_format($stock->price,4)}}</td>
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


        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>List of Product Stock</strong></h2>
                                        
                                </div>
                                <div class="col-lg-6">
                                        <button class="btn-hover btn-border-radius color-8" onclick="pstock()" style="float:right"><i data-feather="printer" style="height:15px"></i> <span>Print </span></button>
                                        
                                    </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Total Available</th>
                                            <th>Total On Hand</th>
                                            <th>Total Value</th>
                                            <th>To Watchlist</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($totalstock as $stock)
                                      <tr>
                                    <td class="text-center">{{$stock->product_code}}</td>
                                      <td class="text-center">{{$stock->product_name}}</td>
                                      <td class="text-center">{{$stock->description}}</td>
                                      <td class="text-center">{{$stock->total_available}}</td>
                                      <td class="text-center">{{$stock->total_stock}}</td>
                                      <td class="text-center">{{number_format($stock->total_value,4)}}</td>
                                      <td class="text-center">
                                        <button type="button" onclick="store_product(this)" value="{{$stock->product_id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">add</i>
                                        </button>
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
    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Units</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                                <label for="unit">Unit</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="unit" name="unit" class="form-control" placeholder="Enter Unit">
                                    </div>
                                </div>

                            <label for="description">Unit Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="description" name="description" placeholder="Unit Description">
                                    </div>
                                </div>

                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = function () {
                $('.nav-reports').click();
                $('.nav-inventory-reports').click();
                // $('.nav-ship-orders').addClass('active');
                $('.nav-inventory-stockonhand').addClass('active');
            
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

        const pstock = () => {

            location.href = '/stock/product-total';
        }
</script>

@endsection
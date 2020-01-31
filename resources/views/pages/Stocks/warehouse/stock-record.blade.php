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
                            <h4 class="page-title">Stock Record</h4>
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
                                    <h2><strong>List of Stock Stock</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">

                                </div>
                        </div>
                     
                    </div>
                   
                    <form action="/inventory/stock/update" method="Post">
                        @csrf
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Stock ID</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Available</th>
                                        <th>Onhand</th>                                       
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                        @foreach ($mystocks as $stock)
                                        <tr>
                                      <td class="text-center">ST-{{str_pad($stock->id,8,"0",STR_PAD_LEFT)}}
                                      <input type="hidden" name="stock_id[]" value="{{$stock->id}}">
                                      </td>
                                      <td class="text-center">{{$stock->product_code}}</td>
                                      <td class="text-center">{{$stock->product_name}}</td>
                                      <td class="text-center"><input class = "text-center" type="number" name="stock[]" value="{{$stock->stock}}"/></td>
                                      <td class="text-center"><input class = "text-center" type="number" name="available[]" value="{{$stock->available}}"/></td>
                                      </td>
                                      </tr>
                                        @endforeach
                                        
                                   
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    @role('admin')
                    <button class="btn-hover btn-border-radius color-8"  style="float:right"><i data-feather="box" style="height:15px"></i> <span>Save Record </span></button>
                    @endrole
                </form>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>



    <script>
            window.onload = function () {
                $('.nav-records').click();
                $('.nav-r-st').addClass('active');
                //$('.nav-recieve-order').addClass('active');
            
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
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

#p-imgp{
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
                            <h4 class="page-title">Products Records</h4>
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
                                    <h2><strong>List of Products</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#modal-add" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Product </span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Supplier</th>
                                        <th>Unit</th>
                                        <th>Srp</th>
                                        @can('Inventory')
                                        <th>Details</th>
                                       @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($Products as $Product)
                                   <tr>
                                   <td class="text-center">{{$Product->product_code}}</td>
                                   <td class="text-center">{{$Product->product_name}}</td>
                                   <td class="text-center">{{$Product->description}}</td>
                                   <td class="text-center">{{$Product->supplier}}</td>
                                   <td class="text-center">{{$Product->units}}</td>
                                   <td class="text-center">{{number_format($Product->srp,4)}}</td>
                                   @can('Inventory')
                                   <td class="text-center"><button type="button" onclick="prodts(this)" value="{{$Product->id}}"
                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">assignment</i>
                                </button>
                                <input type="hidden" value="{{asset($Product->Image)}}" id="p{{$Product->id}}-image"></td>
                                @endcan
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
 
{{-- MOdals --}}
         
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modal-add" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="myLargeModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="/add-product" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="product-code">Product Code</label>
                                             <div class="form-group">
                                                 <div class="form-line">
                                                    <input class="form-control"  type="text" id="product-code" name="product-code" placeholder="Product Code" required>
                                                </div>
                                             </div>
                                        <label for="product-name">Product Name</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="product-name" name="product-name" class="form-control" placeholder="Product Name" required>
                                                </div>
                                            </div>
                                        <label for="product-description">Description</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control"  type="text" id="product-description" name="product-description" placeholder="Product Description" required>
                                                </div>
                                            </div>
                                        <label for="supplier-price">Price</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control"  type="number" id="supplier-price" step="0.0001" name="supplier-price" placeholder="Supplier Price" required>
                                                </div>
                                            </div>
                                        <label for="srp">SRP</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control"  type="number" id="srp" step="0.0001" name="srp" placeholder="SRP" required>
                                                </div>
                                            </div>
                                        <div class="form-group default-select">
                                            <label>Select Supplier</label>
                                                <select class="form-control select2" data-placeholder="Select" id = "supplier" name="supplier" required>
                                                    <option value="" disabled="true" selected>Select Supplier</option>
                                                        @foreach ($Suppliers as $Supplier)
                                                            <option value="{{$Supplier->id}}">{{$Supplier->supplier}}</option>
                                                        @endforeach
                                                    </select>      
                                                </div>
                                        <div class="form-group default-select">
                                            <label for="cellno">Unit</label>
                                                <select class="form-control select2" data-placeholder="Select" name="unit" id="unit" required>
                                                    <option value="" disabled="true" selected>Select Unit</option>
                                                       @foreach ($units as $unit)
                                                          <option value="{{$unit->id}}">{{$unit->units}}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                        <div class="col-lg 6">
                                            <img id="imgp" src = "{{asset('assets/images/preview.png')}}" alt="image"/>
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>Select Image</span>
                                                        <input type="file" id = "productimage" name="productimage" onchange="imgpreview(this);">
                                                    </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text">
                                                </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                        <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel</span></button>
                                                    </div>
                                                <div class="col-lg-6">
                                                        <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Product</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>



                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modal-update" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-header text-white">
                                <h5 class="modal-title" id="myLargeModalLabel">Update Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                                        </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="/update-product" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="" name="pid" id="pid" />
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="product-code">Product Code</label>
                                                             <div class="form-group">
                                                                 <div class="form-line">
                                                                    <input class="form-control"  type="text" id="p-code" name="product-code" placeholder="Product Code" required>
                                                                </div>
                                                             </div>
                                                        <label for="product-name">Product Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="p-name" name="product-name" class="form-control" placeholder="Product Name" required>
                                                                </div>
                                                            </div>
                                                        <label for="product-description">Description</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input class="form-control"  type="text" id="p-description" name="product-description" placeholder="Product Description" required>
                                                                </div>
                                                            </div>
                                                        <label for="supplier-price">Price</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input class="form-control"  type="number" step="0.0001" id="s-price" name="supplier-price" placeholder="Supplier Price" required>
                                                                </div>
                                                            </div>
                                                        <label for="srp">SRP</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input class="form-control"  type="number" sstep="0.0001" id="p-srp" name="srp" placeholder="SRP" required>
                                                                </div>
                                                            </div>
                                                        <div class="form-group default-select">
                                                            <label>Select Supplier</label>
                                                                <select class="form-control select2" data-placeholder="Select" id = "supplier-id" name="supplier" required>
                                                                    <option value="0" disabled="true" selected>Select Supplier</option>
                                                                        @foreach ($Suppliers as $Supplier)
                                                                            <option value="{{$Supplier->id}}">{{$Supplier->supplier}}</option>
                                                                        @endforeach
                                                                    </select>      
                                                                </div>
                                                        <div class="form-group default-select">
                                                            <label for="cellno">Unit</label>
                                                                <select class="form-control select2" data-placeholder="Select" name="unit" id="p-unit" required>
                                                                    <option value="0" disabled="true" selected>Select Unit</option>
                                                                       @foreach ($units as $unit)
                                                                          <option value="{{$unit->id}}">{{$unit->units}}</option>
                                                                       @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                        <div class="col-lg 6">
                                                            <img id="p-imgp" src = "{{asset('assets/images/preview.png')}}" alt="image"/>
                                                                <div class="file-field input-field">
                                                                    <div class="btn">
                                                                        <span>Select Image</span>
                                                                        <input type="file" id = "p-image" name="productimage" onchange="updateimg(this);">
                                                                    </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text">
                                                                </div>
                                                        </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                        <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel</span></button>
                                                                    </div>
                                                                <div class="col-lg-6">
                                                                        <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Update Product</span></button>
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
                                           
                                            $('.nav-records').click();
                                            $('.nav-records-inventory').addClass('active');
                                            // $('.nav-shippment').click();
                                            // $('.nav-ship-orders').addClass('active');
                                            $('.nav-r-products').addClass('active');
                                        
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

        function updateimg(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {   
                    
                    
                    $('#p-imgp').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    function prodts(id){

        const pid = id.value;
        $('#pid').val(pid);
        $('#modal-update').modal('show');

       const pimg = $('#p'+pid+'-image').val();

       $('#p-imgp').attr('src',pimg);

       $.get('/get-product/'+pid, (data)=>{
        
        $('#p-code').val(data.product_code);
        $('#p-name').val(data.product_name);
        $('#p-description').val(data.description);
        $('#s-price').val(data.supplier_price);
        $('#p-srp').val(data.srp);
        $('#supplier-id').val(data.supplier_id);
        $('#p-unit').val(data.unit);

        
       });


    }
</script>

@endsection
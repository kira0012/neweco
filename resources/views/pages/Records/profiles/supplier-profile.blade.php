@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
{{-- <link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> --}}
    
@endsection
<style>
.modal-header{
    background-color: #007bff;
    /* margin-left: -10px;
    margin-right: -10px;
    margin-top: -12px; */
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
                            <h4 class="page-title">Supplier Information</h4>
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
                                    <hr/>
                                    <h4 class="page-title">Supplier Details</h4>
                                    <hr/>
                            </div>
                            <div class="col-lg-6">
                                <hr/>
                                    <h4 class="page-title">Supplier Products</h4>
                                <hr/>
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5>Supplier Name: {{$Supplier->supplier}}</h5>
                                <h5>Address: {{$Supplier->address}}</h5>
                                <h5>Email: {{$Supplier->email}}</h5>
                                <h5>Tin: {{$Supplier->tin}}</h5>
                                <hr/>
                                <h5>Contact Details:</h5>
                                <hr/>
                                <h5>Fax: {{$Supplier->faxno}}</h5>
                                <h5>phone: {{$Supplier->phone}}</h5>
                                <h5>Cell Number: {{$Supplier->cellno}}</h5>
                                <h5>Contact Person: {{$Supplier->contact_person}}</h5>
                                <h5>Contact No. #: {{$Supplier->cp_number}}</h5>

                                <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:left;width:150px;"><i data-feather="box" style="height:15px"></i> <span>Update Supplier </span></button>
                         
                            </div>
                            <div class="col-lg-6">
                            <h6>Total Product: {{count($products)}}</h6>
                                    @foreach ($products as $product)
                                        <h6>Product Code: {{$product->product_code}} | Product: {{$product->product_name}}</h6>
                                    @endforeach
                            </div>
                        </div>
                   
                       


                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
{{-- Modals --}}    


<div class="modal fade bd-example-modal-lg" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="myLargeModalLabel">Update Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                        <form action="/update-supplier" method="POST">
                            @csrf
                            <input type="hidden" value = "{{$Supplier->id}}" name="sid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="suppliername">Supplier</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input class="form-control"  type="text" id="suppliername" value = "{{$Supplier->supplier}}" name="suppliername" placeholder="Supplier Name" required>
                                        </div>
                                    </div>
                                <label for="address">Address</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="address" name="address" class="form-control" value = "{{$Supplier->address}}" placeholder="Supplier Address" required>
                                        </div>
                                    </div>
                                    <label for="emailadd">Email Address</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control"  type="email" id="emailadd" name="emailadd" value = "{{$Supplier->email}}" placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <label for="phoneno">Phone No</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control"  type="number" id="phoneno" name="phoneno" value = "{{$Supplier->phone}}" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                    <label for="cellno">Cell Number</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control"  type="number" id="cellno" name="cellno" value = "{{$Supplier->cellno}}"  placeholder="Cell Number" required>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-lg 6">
                                        <label for="faxno">Fax Number</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control"  type="number" id="faxno" name="faxno" value = "{{$Supplier->faxno}}"  placeholder="Fax Number" required>
                                            </div>
                                        </div>

                                        <label for="tinno">Tin Number</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control"  type="number" id="tinno" name="tinno"  value = "{{$Supplier->tin}}" placeholder="Tin Number" required>
                                            </div>
                                        </div>
                                        <label for="contact_person">Contact Person</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control"  type="text" id="contact_person" name="contact_person"  value = "{{$Supplier->contact_person}}" placeholder="Contact Person" required>
                                            </div>
                                        </div>
                                        <label for="cp_no">Cell Number</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control"  type="number" id="cp_no" name="cp_no" value = "{{$Supplier->cp_number}}" placeholder="Contact Person Number" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                    <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                </div>
                                            <div class="col-lg-6">
                                                    <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Update Supplier </span></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </form>
                      
                 </div>
       
        </div>
    </div>
</div>
</div>



<script>
        window.onload = function () {
            $('.nav-records').click();
            // $('.nav-shippment').click();
            // $('.nav-ship-orders').addClass('active');
            $('.nav-r-suppliers').addClass('active');
        
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
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>


@endsection
@extends('layouts.template')
<style>
.modal-header{
    background-color: #007bff;
}
.mcontent{

    margin-left: -20px;
    margin-right: -20px;
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
                            <h4 class="page-title">Suppliers Records</h4>
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
                                    <h2><strong>List of Suppliers</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Supplier </span></button>
                            </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Supplier</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Details</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                @foreach ($suppliers as $Supplier)
                                <tr>
                                <td class="text-center">{{$Supplier->Supplier}}</td>
                                <td class="text-center">{{$Supplier->Address}}</td>
                                <td class="text-center">{{$Supplier->email}}</td>
                                <td class="text-center">{{$Supplier->contact}}</td>
                                <td class="text-center"><a type="button" href="supplier/material-profile/{{$Supplier->id}}"
                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">call_missed_outgoing</i>
                                </a></td>
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
         
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-header text-white">
                            <h5 class="modal-title" id="myLargeModalLabel">Add Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-content">
                            <div class="modal-body">
                                    <form action="/materials/store/supplier" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="suppliername">Supplier</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="text" id="suppliername" name="suppliername" placeholder="Supplier Name" required>
                                                    </div>
                                                </div>
                                            <label for="address">Address</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="address" name="address" class="form-control" placeholder="Supplier Address" required>
                                                    </div>
                                                </div>
                                                <label for="emailadd">Email Address</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="email" id="emailadd" name="emailadd" placeholder="Email Address" required>
                                                    </div>
                                                </div>
                    
                                                <label for="cellno">Contact Number</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="number" id="cellno" name="cellno" placeholder="Cell Number" required>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <div class="col-lg 6">
                                                   
                                                    <label for="contact_person">Contact Person</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" id="contact_person" name="contact_person" placeholder="Contact Person" required>
                                                        </div>
                                                    </div>
                                                    <label for="cp_no">Cell Number</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="number" id="cp_no" name="cp_no" placeholder="Contact Person Number" required>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                            </div>
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Supplier </span></button>
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
                    $('.nav-records-construction').addClass('active');
                    $('.nav-cons-supplier').addClass('active');
                
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
@endsection
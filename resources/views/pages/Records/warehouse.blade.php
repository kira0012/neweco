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
                            <h4 class="page-title">Warehouse Records</h4>
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
                                    <h2><strong>List of Warehouse</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right;width:150px;"><i data-feather="layers" style="height:15px"></i><span>Add Warehouse</span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Warehouse Name</th>
                                        <th>Location</th>
                                        @can('Inventory')
                                        <th>Details</th>
                                        @endcan
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($warehouses as $warehouse)
                                    <tr>
                                            <td class="text-center">W-{{str_pad($warehouse->id,4,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center" id="wrname-{{$warehouse->id}}">{{$warehouse->warehouse_name}}</td>
                                    <td class="text-center" id="wrloc-{{$warehouse->id}}">{{$warehouse->warehouse_location}}</td>
                                    @can('Inventory')
                                            <td class="text-center"><button type="button" onclick="warehouse(this)" value="{{$warehouse->id}}"
                                                    class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">assignment</i>
                                                </button></td>
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
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Warehouse</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/add-warehouse" method="Post">
                            @csrf
                                <label for="warehouse">Warehouse Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="warehouse" name="warehouse" class="form-control" placeholder="Enter Warehouse Name" required>
                                    </div>
                                </div>

                            <label for="location">Location</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="location" name="location" placeholder="Warehouse Location" required>
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

        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update Warehouse</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        <div class="modal-body">
                            <form action="/warehouse/update-info" method="Post" id="form-update">
                                @csrf
                                    <input type="hidden" value="" id="wr-id" name="wid" />
                                    <label for="warehouse">Warehouse Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="edit-warehouse" name="warehouse" class="form-control" placeholder="Enter Warehouse Name" required>
                                        </div>
                                    </div>
    
                                <label for="location">Location</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control"  type="text" id="edit-location" name="location" placeholder="Warehouse Location" required>
                                        </div>
                                    </div>
    
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="upd-warehouse" class="btn btn-info waves-effect">Updates</button>
                        </form>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


        <script>
                window.onload = function () {
                    $('.nav-records').click();
                    // $('.nav-shippment').click();
                    // $('.nav-ship-orders').addClass('active');
                    $('.nav-records-inventory').addClass('active');
                    $('.nav-r-warehouse').addClass('active');
                
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

    const warehouse = (id) => {

        const wid = id.value;
        const warehouse_name = $('#wrname-'+wid).text();
        const Location = $('#wrloc-'+wid).text();


            $('#edit-warehouse').val(warehouse_name);
            $('#edit-location').val(Location);
            $('#wr-id').val(wid);
            $('#modal-edit').modal('show');



    }

    $('#upd-warehouse').on('click', ()=>{

            
        const wr = $('#edit-warehouse').val();
        const loc =  $('#edit-location').val();
        

        if (wr == '' || loc == '') {
            Swal.fire(
                'Error!',
                'Warehouse Name and Location Cannot be empty',
                'error'
                );
        } else {
            
            $('#form-update').submit();
        }
    });
</script>
@endsection
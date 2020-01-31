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
                            <h4 class="page-title">Remittance Categories Records</h4>
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
                                    <h2><strong>List of Categories</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8" id="btn-add" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Add Category </span></button>
                                    
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr class="text-center">
                                        <th>Remittance</th>
                                        <th>Description</th>
                                        <th></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $cat)
                                        <tr>
                                        <td class="text-center" id="cat-{{$cat->id}}">{{$cat->Remittance}}</td>
                                        <td class="text-center" id="desc-{{$cat->id}}">{{$cat->Details}}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="update_cat(this)"value="{{$cat->id}}"
                                                class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">assignment</i>
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
        <!-- #END# Exportable Table -->
    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="modal-unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Units</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/add-remittance" method="post" id="form-units">
                            @csrf
                            <input type="hidden" value="" id="uid" name="uid" />

                                <label for="cat">Remittance</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="cat" name="cat" class="form-control" placeholder="Enter Remittance Category" required>
                                    </div>
                                </div>

                            <label for="description">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="description" name="description" placeholder="Category Description" required>
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
                    $('.nav-records').click();
                    // $('.nav-shippment').click();
                    $('.nav-records-financial').click();
                    
                    $('.nav-branch-store').addClass('active');
                
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

        const update_cat = (id)=>{

            const uid = id.value;
            const cat = $('#cat-'+uid).text();
            const desc = $('#desc-'+uid).text();

            $('#form-units').attr('action',"/update-remittance");
            $('#uid').val(uid);
            $('#cat').val(cat);
            $('#description').val(desc);
            $('#modal-unit').modal('show');

        }

        $('#btn-add').on('click',()=>{

                $('#form-units').attr('action',"/add-remittance");
                $('#uid').val('');
                $('#modal-unit').modal('show');

        })

</script>

@endsection
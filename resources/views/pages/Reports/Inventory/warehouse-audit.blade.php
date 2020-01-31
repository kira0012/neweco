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
                            <h4 class="page-title">Units Records</h4>
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
                                    <h2><strong>List of Units</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="eye" style="height:15px"></i> <span>New Audit</span></button>
                                    
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Audit Date</th>
                                        <th>Warehouse Name</th>
                                        <th>Stock Value</th>
                                        <th>Audit Value</th>
                                        <th>Total Lost</th>
                                        <th>Details</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">2019-07-26</td>
                                        <td class="text-center">warehouse a</td>
                                        <td class="text-center">34837488</td>
                                        <td class="text-center">8743847</td>   
                                        <td class="text-center">837</td>
                                        <td class="text-center">view</td>      
                                    </tr>
                                     <tr>
                                            <td class="text-center">2019-07-26</td>
                                            <td class="text-center">warehouse a</td>
                                            <td class="text-center">34837488</td>
                                            <td class="text-center">8743847</td>   
                                            <td class="text-center">837</td>
                                            <td class="text-center">view</td>   
                                    </tr>
                                    <tr>
                                            <td class="text-center">2019-07-26</td>
                                        <td class="text-center">warehouse a</td>
                                        <td class="text-center">34837488</td>
                                        <td class="text-center">8743847</td>   
                                        <td class="text-center">837</td>
                                        <td class="text-center">view</td>     
                                    </tr>
                           
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
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Units</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                                <label for="auditdate">Date of Audit</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="auditdate" name="auditdate" class="form-control" >
                                    </div>
                                </div>
                                <label for="unit">Select Warehouse</label>
                                <div class="form-group default-select">
                                        <select class="form-control select2" data-placeholder="Select">
                                           <option value="" selected="true" disabled="true">Select Warehouse</option>
                                           <option value="Withdraw">Withdraw</option>
                                           <option value="Deposit">Deposit</option>
                                       </select>
                                   </div>

                                   <label for="sval">Stock Value</label>
                                   <div class="form-group">
                                       <div class="form-line">
                                           <input type="text" id="sval" name="sval" value="8734874" class="form-control" readonly>
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
</script>

@endsection
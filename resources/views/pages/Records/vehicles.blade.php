@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
{{-- <link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> --}}
    
@endsection
<style>
.modal-header{
    background-color: #007bff;
}
.mch{
    margin-top: -10px;
    margin-right: -10px;
    margin-left: -10px;
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
                            <h4 class="page-title">Vehicles Records</h4>
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
                                    <h2><strong>List of Vehicles</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8" id="m-vehicle" style="float:right"><i data-feather="truck" style="height:15px"></i> <span>Add Vehicles </span></button>
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
                                        <th>Plate No</th>
                                        <th>Class</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                        <th>Current value</th>
                                        <th>Edit</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Vehicles as $Vehicle)
                                    <tr>
                                    <td class="text-center" id="vplate-{{$Vehicle->id}}">{{$Vehicle->plateNo}}</td>
                                    <td class="text-center">{{$Vehicle->class}}</td>
                                    <td class="text-center">{{$Vehicle->model}}</td>
                                    <td class="text-center">{{$Vehicle->color}}</td>
                                    <td class="text-center">
                                    <input type="hidden" id="drate-{{$Vehicle->id}}" value="{{$Vehicle->depreciation_rate}}" />
                                    <input type="hidden" id="vprice-{{$Vehicle->id}}" value="{{$Vehicle->price}}" />
                                    <input type="hidden" id="vage-{{$Vehicle->id}}" value="{{$Vehicle->age}}" />

                                            <button type="button" onclick="depval(this)"value="{{$Vehicle->id}}"
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">assignment</i>
                                                </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" onclick="update_vehicle(this)"value="{{$Vehicle->id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">assignment</i>
                                        </button>
                                        <input type="hidden" value="{{asset($Vehicle->Image)}}" id="p{{$Vehicle->id}}-image"></td>
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
 
{{-- MOdals --}}
         
<div class="modal fade bd-example-modal-lg" id="modal-vehicle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="myLargeModalLabel">Add Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                        <form action="/add-vehicle" method="post" enctype="multipart/form-data" id="form-vehicle">
                            @csrf
                            <input type="hidden" id="v-id" name="v-id" value="" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="model">Model</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="text" id="model" name="model" placeholder="Vehicle Model" required>
                                                    </div>
                                                </div>
                                                <label for="plateno">Plate No</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="text" id="plateno" name="plateno" placeholder="Plate Number" required>
                                                    </div>
                                                </div>

                                                <label for="price">Price</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="number" id="price" name="price" placeholder="Vehicle Price" required>
                                                    </div>
                                                </div>

                                                <label for="dateofpurchase">Date of Purchase</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control" type="date" id="dateofpurchase" name="dateofpurchase" placeholder="Date  Of Purchase" required>
                                                    </div>
                                                </div>
                                                </div>
                                        <div class="col-lg-6"> 
                                            <label for="vclass">Class</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="vclass" name="vclass" class="form-control" placeholder="Vehicle Class" required>
                                                    </div>
                                                </div>

                                            <label for="color">Color</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="color" name="color" class="form-control" placeholder="Vehicle Color">
                                                    </div>
                                                </div>

                                            <label for="drate">Depreciation Rate %</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="number" min="1" id="drate" name="drate" placeholder="Vehicle Depreciation Rate" required>
                                                    </div>
                                                </div>

                                            <label for="dateofregistration">Date of Registration</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control" type="date" id="dateofregistration" name="dateofregistration" placeholder="Date Of Registration" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                           
                                        </div>
                                <div class="col-lg 6">
                                    <img id="imgp" src = "{{asset('assets/images/truckp.webp')}}" alt="image"/>
                                            <div class="file-field input-field">
                                            <div class="btn">
                                                    <span>Select Image</span>
                                                    <input type="file" id = "vehicleimage" name="vehicleimage" onchange="imgpreview(this);">
                                                </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                            </div>                            
                                        <div class="row">
                                            <div class="col-lg-6">
                                                    <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                </div>
                                            <div class="col-lg-6">
                                              <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Save Vehicle </span></button>
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


        <div class="modal fade" id="m-curval" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header mch">
                                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Depreciation Value</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               </div>
                    
                        <div class="modal-body">
                            <h6 id="m-plate"></h6>
                            <h6 id="m-deprate"></h6>
                            <table class="table">
                                <tr>
                                    <th>Year</th>
                                    <th>Value</th>
                                </tr>
                                <tbody id="d-value">
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" id="upd-warehouse" class="btn btn-info waves-effect">Updates</button> --}}
                        </form>
                            {{-- <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button> --}}
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
                    $('.nav-r-vehicles').addClass('active');
                
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

<script>

    $('#m-vehicle').on('click', ()=>{

        $('#form-vehicle').attr('action',"/add-vehicle");
        $('#modal-vehicle').modal('show');
        $('#v-id').val('');

    })

    const update_vehicle = (id)=>{

        const vid = id.value;
        
        $('#form-vehicle').attr('action',"/vehicle/update/info");
        $('#v-id').val(vid);
        fetch('/vehicle/info/'+vid)
            .then((res) => res.json())
                .then((data) =>{
                        console.log(data);
                    $('#model').val(data.model);
                    $('#plateno').val(data.plateNo);
                    $('#price').val(data.price);
                    $('#dateofpurchase').val(data.purchase_date);
                    $('#vclass').val(data.class);
                    $('#color').val(data.color);
                    $('#drate').val(data.depreciation_rate);
                    $('#dateofregistration').val(data.dor);
                    const vimg = $('#p'+vid+'-image').val();
                    if(data.Image != null){
                       $('#imgp').attr('src',vimg);
                    }
                })
        $('#modal-vehicle').modal('show');

    }

    const depval = (id)=>{

        const vid = id.value;
        const plateno = $('#vplate-'+vid).text();
        const deprate = $('#drate-'+vid).val();
        const vage = $('#vage-'+vid).val();
        const vprice = $('#vprice-'+vid).val();

        $('#m-plate').empty();
        $('#m-deprate').empty();
        $('#d-value').empty();

        $('#m-plate').append('Plate No: '+plateno);
        $('#m-deprate').append('Depreciation Rate: '+deprate+'%');
        
        let iprice = vprice;

            for (let index = 1; index <= vage; index++) {
                    
                    iprice = iprice - (Number(iprice) * .20)
                    
                    $('#d-value').append('<tr><td> Year '+index+'</td><td>'+Math.round(iprice)+'</td></tr>');

                
            }
        $('#m-curval').modal('show');
    }
</script>

@endsection
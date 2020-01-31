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
                            <h4 class="page-title">Trucking Schedules</h4>
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
                                    <h2><strong>List of Trucks</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#trip-sched" style="float:right"><i data-feather="edit" style="height:20px"></i> <span>New Schedule</span></button>
                                </div>
                                @endcan
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Trip Schedule</th>
                                        <th>Vehicle Class</th>
                                        <th>Model</th>
                                        <th>Plate No</th>
                                        <th>Driver</th>
                                        <th>Departure Date</th>
                                        <th>View Cargo</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($TripTickets as $ticket)
                                       <tr>
                                       <td class="text-center">TS-{{str_pad($ticket->id,6,"0",STR_PAD_LEFT)}}</td>
                                       <td class="text-center">{{$ticket->class}}</td>
                                       <td class="text-center">{{$ticket->model}}</td>
                                       <td class="text-center">{{$ticket->plateNo}}</td>
                                       <td class="text-center">{{$ticket->driver}}</td>
                                       <td class="text-center">{{$ticket->departure}}</td>
                                       <td class="text-center"><button type="button" onclick="view_cargo(this)"
                                        value = "{{$ticket->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">local_shipping</i>
                                        </button></td>
                                       {{-- <td class="text-center">{{$ticket->id}}</td> --}}
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
        <div class="modal fade" id="trip-sched" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Trip Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/trucking/new-sched" id="trip-ticket" method="post">
                             @csrf
                             <div class="form-group default-select">
                                    <label for="vehicle_id">Select Vehicle</label>
                                        <select class="form-control select2" data-placeholder="Select" id="vehicle_id" name="vehicle_id">
                                            <option value="" selected="true" disabled="true"></option>   
                                            @foreach ($Vehicles as $vehicle)
                                                 <option value="{{$vehicle->id}}">{{$vehicle->class}} model({{$vehicle->model}}) ,PlateNo-{{$vehicle->plateNo}}</option>
                                            @endforeach    
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="driver"></label>
                                        <div class="form-line">
                                            <input type="text" id="driver" name="driver" value="" placeholder="Driver Name" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="departure"></label>
                                                <div class="form-line">
                                                    <input type="date" id="departure" name="departure" value="" class="form-control" required>
                                                </div>
                                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="n-sched" class="btn btn-info waves-effect">Add Schedule</button>
                    </form>
                        
                    </div>
                </div>
            </div>
        </div>


        <script>
                window.onload = function () {
                    $('.nav-transaction').click();
                    $('.nav-shippment').click();
                    $('.nav-ship-trucking').addClass('active');
                    $('.nav-trucking-schedule').addClass('active');
                
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
{{-- <script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script> --}}
<script>

    const view_cargo = (id)=>{

            trip_id = id.value;
            location.href = '/trucking/vehicle/cargo/'+trip_id;
    }

$('#n-sched').on('click', ()=> {

    const departure = $('#departure').val();
    const vehicle = $('#vehicle_id').val();

    if (departure == '' || departure == null || vehicle == '' || vehicle == null) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Departure Date and Vehicle Cannot be empty',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
        
    }else{
    $('#trip-ticket').submit();   
    } 

});

</script>

@endsection
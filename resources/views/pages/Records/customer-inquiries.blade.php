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
                            <h4 class="page-title">Customer Inquiries</h4>
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
                                    <h2><strong>List of Inquiries</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                    
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Bussiness/Company</th>
                                        <th>Contact Number</th>
                                        <th>Inquiry</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiries as $inquiry)
                                    <tr>
                                    <td class="text-center">{{$inquiry->fullname}}</td>
                                    <td class="text-center">{{$inquiry->company}}</td>
                                    <td class="text-center">{{$inquiry->contact}}</td>
                                    <td class="text-center"><button type="button" onclick="show_inquiry(this)"
                                        value = "{{$inquiry->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">widgets</i>
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

        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>List of Leads</strong></h2>
                                </div>
                                <div class="col-lg-6">
                                        
                                    </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Bussiness/Company</th>
                                            <th>Contact Number</th>
                                            <th>Inquiry</th>
                                            <th>Add To Customer</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                        <tr>
                                        <td class="text-center">{{$lead->fullname}}</td>
                                        <td class="text-center">{{$lead->company}}</td>
                                        <td class="text-center">{{$lead->contact}}</td>
                                        <td class="text-center"><button type="button" onclick="show_inquiry(this)"
                                            value = "{{$lead->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">widgets</i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if ($lead->status == 1)
                                            <button type="button" onclick="addto_customer(this)"
                                            value = "{{$lead->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">widgets</i>
                                            </button>
                                            @else
                                                
                                            @endif
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
        <div class="modal fade bd-example-modal-lg" id="modal-inquiry" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="myLargeModalLabel">Customer Inquiries</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="inq-lead" />
                        <div id="inquiry-content">
                                
                        </div>
                    

                    <div class="modal-footer hidable">
                    
                        <button type="button" id="add-lead" class="btn btn-info waves-effect">Add to Lead</button>
                
                        <button type="button" id ="inq-del" class="btn btn-danger waves-effect">Delete</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
                window.onload = function () {
                    // $('.nav-transaction').click();
                    // $('.nav-shippment').click();
                    // $('.nav-ship-orders').addClass('active');
                    $('.nav-customer-inquiries').addClass('active');
                
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


const show_inquiry = (id) =>{


    const inquiry = id.value;
    
    // $('#inquiry-content').append('<h5>Customer Name: </h5>');
    // $('#inquiry-content').append('<h5>Customer Name:2 </h5>');

    $('#inq-lead').val(inquiry);
    fetch('/customer/get/inquiries/'+inquiry)
        .then((res) => res.json())
            .then((data) => {

                if (data.status != 0) {
                    $('.hidable').hide();
                }else{
                    $('.hidable').show();
                }
                
                $('#inquiry-content').empty();
                $('#inquiry-content').append('<h5>Customer Name: '+data.fullname+'</h5>'+
                '<h5>Company/Bussiness: '+data.company+'</h5>'+
                '<h5>Address: '+data.address+'</h5>'+
                '<h5>Contact Number :'+data.contact+'</h5>'+
                '<hr>'+
                '<h5>Inquiry</h5>'+
                '<textarea class="form-control" rows="4" cols="50"> '+data.discription+'</textarea>'+
                '');
                
            })
    $('#modal-inquiry').modal('show');
}

$('#add-lead').on('click',()=>{

    const url = '/customer/add/lead';
    const id =  $('#inq-lead').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Add To Lead'
        }).then((result) => {
        if (result.value) {

    fetch(url, {  
            method: 'POST',  
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({
            inquiry_id: id,
                 })
            }).then((res) =>res.json())
                .then((data) =>{
                    // console.log(data);
                    if (data == '1') {
                        Swal.fire(
                            'Success!',
                            'Customer has been Tag As Lead.',
                            'success'
                            )     
                            location.reload();   
                    }else {
                        Swal.fire(
                            'Error!',
                            'Something Wrong Please Contact Your System Administrator Or Your Service Provider.',
                            'error'
                            )       
                    }

                })
        }

    });

});

const addto_customer = (id)=>{

    const lead = id.value;
    const url = '/customer/lead/add/customer';

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Add To Customers'
        }).then((result) => {
        if (result.value) {

            fetch(url, {  
            method: 'POST',  
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({
            inquiry_id: lead,
                 })
            }).then((res) =>res.json())
                .then((data) =>{
                   
                    if (data == '1') {
                        Swal.fire(
                            'Success!',
                            'Customer has been Added',
                            'success'
                            )     
                            location.reload();   
                    }else {
                        Swal.fire(
                            'Error!',
                            'Something Wrong Please Contact Your System Administrator Or Your Service Provider.',
                            'error'
                            )       
                    }

                })
            

        }

});


}


$('#inq-del').on('click',()=>{

    
    const url = '/customer/inquiry/delete';
    const id =  $('#inq-lead').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete IT'
        }).then((result) => {
        if (result.value) {

    fetch(url, {  
            method: 'POST',  
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({
            inquiry_id: id,
                 })
            }).then((res) =>res.json())
                .then((data) =>{
                    // console.log(data);
                    if (data == '1') {
                        Swal.fire(
                            'Success!',
                            'Inquiry Deleted.',
                            'success'
                            )     
                            location.reload();   
                    }else {
                        Swal.fire(
                            'Error!',
                            'Something Wrong Please Contact Your System Administrator Or Your Service Provider.',
                            'error'
                            )       
                    }

                })
        }

    });



})
</script>

@endsection
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
                                <h4 class="page-title">Customer Records</h4>
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
                                        <h2><strong>List of Customer</strong></h2>
                                </div>
                                <div class="col-lg-6">
                                    @can('Customers')
                                        <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#customer-add" style="float:right"><i data-feather="slack" style="height:15px"></i> <span>Add Customer </span></button>
                                    @endcan
                                    </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Customer Name</th>
                                            <th>Business Name</th>
                                            <th>Address</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            @can('Customers')
                                            <th>Details</th>
                                           @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($Customers as $Customer)
                                       <tr>
                                       <td class="text-center">{{$Customer->name}}</td>
                                       <td class="text-center">{{$Customer->business_name}}</td>
                                       <td class="text-center">{{$Customer->address}}</td>
                                       <td class="text-center">{{$Customer->contactno}}</td>
                                       <td class="text-center">{{$Customer->email}}</td>
                                       @can('Customers')
                                       <td class="text-center"><button type="button" onclick="customer(this)" value="{{$Customer->id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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
     
    {{-- MOdals --}}
             
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="customer-add" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="myLargeModalLabel">Add Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                            <form action="/add-customer" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="model">Customer Name</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control"  type="text" id="name" name="name" placeholder="Customer Name" required>
                                                </div>
                                            </div>
                                                <label for="address">Address</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" id="address" name="address" placeholder="Address" required>
                                                        </div>
                                                    </div>
    
                                                <label for="cellno">Cell Number</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" id="cellno" name="cellno" placeholder="Cell Number" required>
                                                        </div>
                                                    </div>
                                                <label for="phone">Phone Number</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number"  required>
                                                        </div>
                                                    </div>
                                        
                                                   
                                                </div>
    
                                            <div class="col-lg-6"> 
                                                <label for="customerbn">Customer Business Name</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="customerbn" name="customerbn" class="form-control" placeholder="Customer Business Name" >
                                                        </div>
                                                    </div>
    
                                              
    
                                                <label for="tin">Tin Number</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="number" id="tin" name="tin" placeholder="Tin Number" >
                                                        </div>
                                                    </div>
    
                                                    <label for="email">Email</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input class="form-control"  type="email" id="email" name="email" placeholder="Email Address" >
                                                        </div>
                                                    </div>
                                                 
                                    <div class="col-lg 6">
                                        <div class="row">
                                                <div class="col-lg-6">
                                                        <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                    </div>
                                                <div class="col-lg-6">
                                                    <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Customer</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
    {{--        Customer Update   --}}
    

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="customer-update" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="myLargeModalLabel">Update Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-content">
                        <div class="modal-body">
                                <form action="/update-customer" method="post">
                                    @csrf
                                    <input type="hidden" value="" id="cid" name="cid"/>
                                    <div class="row">
                                        <div class="col-lg-6">
                                                    <label for="model">Customer Name</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input class="form-control"  type="text" id="c-name" name="name" placeholder="Customer Name" required>
                                                            </div>
                                                        </div>
                                                    <label for="address">Address</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input class="form-control"  type="text" id="c-address" name="address" placeholder="Address" required>
                                                            </div>
                                                        </div>
        
                                                    <label for="cellno">Cell Number</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input class="form-control"  type="text" id="c-cellno" name="cellno" placeholder="Cell Number" required>
                                                            </div>
                                                        </div>
                                                    <label for="phone">Phone Number</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="c-phone" name="phone" class="form-control" placeholder="Phone Number" required>
                                                            </div>
                                                        </div>
                                            
                                                       
                                                    </div>
        
                                                <div class="col-lg-6"> 
                                                    <label for="customerbn">Customer Business Name</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="c-customerbn" name="customerbn" class="form-control" placeholder="Customer Business Name" >
                                                            </div>
                                                        </div>
        
                                                  
        
                                                    <label for="tin">Tin Number</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input class="form-control"  type="number" id="c-tin" name="tin" placeholder="Tin Number" >
                                                            </div>
                                                        </div>
        
                                                        <label for="email">Email</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input class="form-control"  type="email" id="c-email" name="email" placeholder="Email Address" >
                                                            </div>
                                                        </div>
                                                       
                                                
                                        <div class="col-lg 6">
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                            <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                        </div>
                                                    <div class="col-lg-6">
                                                        <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Update Customer</span></button>
                                                    </div>
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
                                // $('.nav-shippment').click();
                                // $('.nav-ship-orders').addClass('active');
                                $('.nav-r-customer').addClass('active');
                            
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
     

    function customer(id){

        const cid = id.value;
         $('#cid').val(cid);
        $('#customer-update').modal('show');

        $.get('/customer/id/'+cid, (data)=>{
            console.log(data);
           $.each(data, (index,objdata) => {
            $('#c-name').val(objdata.name );
            $('#c-address').val(objdata.address);
            $('#c-phone').val(objdata.phoneno);
            $('#c-cellno').val(objdata.contactno);
            $('#c-tin').val(objdata.tin);
            $('#c-customerbn').val(objdata.business_name);
            $('#c-email').val(objdata.email);
            $('#c-username').val(objdata.username);

            $('#c-password').val('');
           })
            
        });
    }
</script>

@endsection
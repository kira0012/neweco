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
                            <h4 class="page-title">Pending Orders</h4>
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
                                    <h2><strong>List of Orders</strong></h2>
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
                                        <th>Customer</th>
                                        <th>Location</th>
                                        <th>Amount</th>
                                        <th>Order List</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DrOrders as $orders)
                                    <tr>
                                    <td class="text-center">{{$orders->business_name == null ? $order->name : $order->business_name}}</td>
                                    <td class="text-center">{{$orders->address}}</td>
                                    <td class="text-center">{{number_format($orders->total_amount)}}</td>
                                    <td class="text-center"><button type="button" onclick="order_list(this)"
                                        value = "{{$orders->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
                                        </button></td> 
                                    
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
        <div class="modal fade bd-example-modal-lg" id="modal-orders" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="myLargeModalLabel">Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/pending/order/approve" method="post" id="form-approve">
                            @csrf
                              <input type="hidden" value="" name="cid" id="cid" />
                              <table>
                                  <tr class="text-center">
                                  <th>Order Number</th>
                                  <th>Product Code</th>
                                  <th>Stock_Code</th>
                                  <th>Product</th>
                                  <th>Order Qty</th>
                                  <th>Available Stock</th>
                                </tr>
                                <tbody id="pnd-orders">
                                    <tr>
                                        
                                    </tr>
                                </tbody>
                              </table>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="pending-app" class="btn btn-info waves-effect">Approve</button>
                    </form>
                        <button type="button" id ="del" class="btn btn-danger waves-effect">Delete</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
                window.onload = function () {
                    $('.nav-transaction').click();
                    $('.nav-shippment').click();
                    $('.nav-ship-orders').addClass('active');
                    $('.nav-pending-orders').addClass('active');
                
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

<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
<script>

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

const order_list = (id)=>{

    pid = id.value;

    $('#cid').val(pid);

    fetch('/pending/customer/orders/'+pid)
        .then((res) => res.json())
            .then((data) => {
                $('#pnd-orders').empty();
               console.log(data);
                data.forEach(orders => {
                    $('#pnd-orders').append('<tr>'
                    +'<td class="text-center">ON-'+padDigits(orders.dr_no,8)+'</td>'
                    +'<td class="text-center">'+orders.product_code+'</td>'
                    +'<td class="text-center">ST-'+padDigits(orders.stock_id,8)+'</td>'
                    +'<td class="text-center">'+orders.product_name+'</td>'
                    +'<td class="text-center">'+orders.qty+'</td>'
                    +'<td class="text-center">'+orders.available+'</td>'
                    +'</tr>');
                });
            });

    $('#modal-orders').modal('show');
    
}

$('#pending-app').on('click', ()=>{

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
            confirmButtonText: 'Yes, Approve Order!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Procced!',
                'success'
                ).then((result) =>{
                    if(result.value){
                        $('#form-approve').attr('action',"/pending/order/approve");
                        $('#form-approve').submit();
                    }
                })
                
            }
            })

})

$('#del').on('click', ()=> {

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
            confirmButtonText: 'Yes, Delete Order!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Delete!',
                'success'
                ).then((result) =>{
                    if(result.value){
                        
                        $('#form-approve').attr('action',"/pending/order/delete");
                        $('#form-approve').submit();
                    }
                })
                
            }
            })
})

</script>

@endsection
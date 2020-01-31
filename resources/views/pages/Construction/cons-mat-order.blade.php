@extends('layouts.template')
@section('htmlhead')

    
@endsection
<style>
.modal-header{
    background-color: #007bff;
    /* margin-left: -22px;
    margin-right: -22px;
    margin-top: -12px; */
}
.modal { overflow: auto !important; }

.add-m{

     margin-left: -12px;
    margin-right: -12px;
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
.total{

margin-top: 12px;
}
.order-content{
margin: 5px 5px 5px 5px;
height: 328px;
width: 100%;
border-color: black;
border-style: solid;
overflow: scroll;
}

.del{

height: 20px !important;
width: 20px !important;
background-color: red !important;
}
.del:hover{
background-color: lightcoral !important;
}

.i-del{

font-size: 10px !important;
/* color: white; */
line-height: 0.5
}

.tb-list{

    font-size: 13px;
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
                            <h4 class="page-title"> Materials Orders</h4>
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
                                    <h2><strong>Order Material Record</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#modal-new-mat" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>New Order </span></button>
                                    @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                       
                                        <th>Order No</th>
                                        <th>Customer/Project</th>
                                        <th>Address</th>   
                                        <th>View</th>
                                        <th>Deliver Order</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                      

                                  @foreach ($mat_ongoing as $mat)
                                  <tr>
                                  <td class="text-center">OS-{{str_pad($mat->id,6,"0",STR_PAD_LEFT)}}</td>
                                  <td class="text-center">{{$mat->Customer}}</td>
                                  <td class="text-center">{{$mat->location}}</td> 
                                  <td class="text-center"><button type="button" onclick="matinfo(this)"
                                    value = "{{$mat->id}}"
                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">call_missed_outgoing</i>
                                  </button></td>
                                  <td class="text-center"><button type="button" onclick="deliver(this)"
                                    value = "{{$mat->id}}"
                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">local_shipping</i>
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
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>List of Deliveried Order</strong></h2>
                                        
                                </div>
                                <div class="col-lg-6">
                                        {{-- <button class="btn-hover btn-border-radius color-8" onclick="pstock()" style="float:right"><i data-feather="printer" style="height:15px"></i> <span>Print </span></button>
                                         --}}
                                    </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Customer/Project</th>
                                            <th>Order Date</th>
                                            <th>Delivery Date</th>
                                            <th>View</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($mat_del as $del)
                                      <tr>
                                      <td class="text-center">{{$del->id}}</td>
                                      <td class="text-center">{{$del->Customer}}</td>
                                      <td class="text-center">{{$del->order_date}}</td>
                                      <td class="text-center">{{$del->delivery_date}}</td>
                                      <td class="text-center">
                                            <button type="button" onclick="delinfo(this)"
                                            value = "{{$del->id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">local_shipping</i>
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


    </div>
</section>
{{-- Modals --}}     
<div class="modal fade bd-example-modal-lg" id="modal-new-mat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-header text-white ">
                    <h5 class="modal-title" id="myLargeModalLabel">Order Materials</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="/new/material-order" method="post" id="recieve-form">
                            @csrf
                            <div class="row">                               
                                <div class="col-lg-6"> 
                                    <div class="form-group">
                                        <label for="rdate">Customer/Project:</label>
                                            <div class="form-line">
                                            <input type="text" name="cpname" class="form-control" value="" required>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="rdate">Date:</label>
                                            <div class="form-line">
                                            <input type="date" name="rdate" class="form-control" value="{{$today}}" required>
                                            </div>
                                    </div>             
                                </div>
                            </div>
                                <div class="form-group">
                                        <label for="dadd">Delivery Address:</label>
                                            <div class="form-line">
                                            <input type="text" name="dadd" class="form-control" value="" required>
                                            </div>
                                    </div>
                                <div class="form-group"> 
                                        <label for="remarks"><b>Remarks:</b></label>
                                            <div class="form-line">
                                            <textarea class="form-control" name="remarks"  cols="30" rows="5"></textarea>
                                            </div>
                                    </div>  
                            
                                <div class="row">
                                        <div class="col-lg-6">
        
                                        </div>
                                    <div class="col-lg-6">
                                        <button class="btn-hover btn-border-radius color-1" type="submit" id="place-order" style="float:right"><i data-feather="check-square" style="height:15px"></i> <span>Save</span></button>
                                    </div>
                                </div>
                           
                                                   
                                                </form>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade bd-example-modal-lg" id="modal-order" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-header text-white">
                            <h5 class="modal-title" id="myLargeModalLabel">Order Materials</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="/mat/order-info/update" method="post" id="order-form">
                                    @csrf
                                    <input type="hidden" value="" id="osid" name="osid" />
                                    <div class="row">                               
                                        <div class="col-lg-6"> 
                                            <div class="form-group">
                                                <label for="rdate">Customer/Project:</label>
                                                    <div class="form-line">
                                                    <input type="text" id="cpname" name="cpname" class="form-control" value="" required>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="rdate">Date:</label>
                                                    <div class="form-line">
                                                    <input type="date" id="rdate" name="rdate" class="form-control" value="{{$today}}" required>
                                                    </div>
                                            </div>             
                                        </div>
                                    </div>
                                        <div class="form-group">
                                                <label for="dadd">Delivery Address:</label>
                                                    <div class="form-line">
                                                    <input type="text" id="dadd" name="dadd" class="form-control" value="" required>
                                                    </div>
                                            </div>
                                        <div class="form-group"> 
                                                <label for="remarks"><b>Order Remarks:</b></label>
                                                    <div class="form-line">
                                                    <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="5"></textarea>
                                                    </div>
                                            </div>  
                                            <div class="order-content">

                                           
                                            <table class="table table-bordered tb-list">
                                                <thead>
                                                        <tr>
                                                            <th class="text-center">Product Code</th>
                                                            <th class="text-center">Qty</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Sub Total</th>
                                                            <th class="text-center">Remove</th>
                                                        </tr>
                                                </thead>
                                                <tbody id="o-list">
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                            <button class="btn-hover btn-border-radius color-1" onclick="add_list()" type="button" id="btn-tolistmat" style="float:right"><i data-feather="check-square" style="height:15px"></i> <span>ADD Materials</span></button>
                                        <div class="row">
                                                <div class="col-lg-6">
                
                                                </div>
                                            <div class="col-lg-6">
                                                <button class="btn-hover btn-border-radius color-1" type="submit" id="place-order" style="float:right"><i data-feather="check-square" style="height:15px"></i> <span>Save</span></button>
                                            </div>
                                        </div>                    
                                    </form>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                
        <div class="modal fade" id="add-matlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header add-m">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Select Material</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                                <div class="modal-body">
                                        <div class="form-group default-select">
                                                <label for="supplier">Supplier:</label>
                                                <select class="form-control select2" data-placeholder="Select" name="supplier" id="supplier" required>
                                                    <option value="0">Select Supplier</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}">{{$supplier->Supplier}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group default-select">
                                                    <label for="product">Product:</label>
                                                    <select class="form-control select2" data-placeholder="Select" name="product" id="product" >
                                                            <option value="0">Select Product</option>
                                                           
                                                        </select>
                                                </div>
                                                <div class="form-group default-select">
                                                        <label for="stock">Stock:</label>
                                                        <select class="form-control select2" data-placeholder="Select" name="stock" id="stock" >
                                                                <option value="0">Select Stock</option>
                                                               
                                                            </select>
                                                    </div>
                                                <input type="hidden" id="mat-code" value="" />
                                                <div class="form-group">
                                                        <label for="unit">Unit:</label>
                                                        <input type="text" id="unit" name="unit" value=""  class="form-control" readonly>
                                                
                                                    </div>
                                             
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                                <div class="form-group">
                                                                        <label for="rdate">Qty:</label>
                                                                            <div class="form-line">
                                                                            <input type="number" id="qty" name="qty" class="form-control">
                                                                            <input type="hidden" value="" id="s-available">
                                                                            </div>
                                                                    </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                                <div class="form-group">
                                                                        <label for="srp">SRP:</label>
                                                                            <div class="form-line">
                                                                            <input type="number" id="srp" name="srp" class="form-control" >
                                                                            </div>
                                                                    </div>
                                                        </div>
    
                                                    </div>
                       
                    
                                        <button class="btn-hover btn-border-radius color-1" type="button" id="add-list" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Add To List</span></button>
                                                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>



                    
                
        <div class="modal fade" id="modal-dd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header add-m">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Delivery</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                                <div class="modal-body">    
                                    <form action="/send/mo-deliver" method="post">
                                        @csrf
                                        <input type="hidden" value="" id="order-no" name="osid" />

                                <div class="form-group">
                                        <label for="ddate">Delivery Date:</label>
                                            <div class="form-line">
                                            <input type="date" id="ddate" name="ddate" value="{{$today}}" class="form-control" required> 
                                            
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                        <label for="dremarks">Remarks:</label>
                                            <div class="form-line">
                                            <textarea class="form-control" name="remarks" id="dremarks" cols="30" rows="10" required></textarea>
                                            </div>
                                                             
                                </div>

                                <button class="btn-hover btn-border-radius color-1" type="submit"  style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Add To List</span></button>
                                                                
                            </form>  
                                </div>
                            </div>
                        </div>
                    </div>



        <script>
            window.onload = function () {
                $('.nav-inventory').click();
                $('.nav-warehouse-construction').click();
                // $('.nav-ship-orders').addClass('active');
                $('.nav-construction-recieve').addClass('active');
            
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
function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}


        const matinfo = (on)=>{

            onid = on.value;
                $('#osid').val(onid);
                get_orders(onid);
                

                fetch('/material-order/details/'+onid)
                    .then((res) => res.json())
                        .then((mat) => {

                            // data.forEach( mat => {

                                $('#cpname').val(mat.Customer);
                                $('#dadd').val(mat.location);
                                $('#remarks').val(mat.remarks);
                                $('#rdate').val(mat.order_date);

                            // })
                        })

                $('#modal-order').modal('show');

        }
        const add_list = ()=>{

            $('#add-matlist').modal('show');
        }




        const fill_product = (sid)=>{

const s_chk = sid
 $('#s-chk').val(s_chk);
fetch('/supplier/material-list/'+sid)
    .then((res) => res.json())
        .then((data) => {

                $('#product').empty();
                $('#product').append('<option value="0">Select Product</option>');
              
                data.forEach(mat => {
                    $('#product').append('<option value="'+mat.id+'">'+mat.Product_Name+' | '+mat.Description+'</option>');
                });
            });
}

$('#supplier').on('change',(id)=>{

    const sid = id.target.value;
    fill_product(sid);

});

$('#product').on('change',(id)=>{

        const matid = id.target.value;

        fetch('/material/stock-list/'+matid)
            .then((res) => res.json())
                .then((data) => {

                 
                $('#stock').empty();
                $('#stock').append('<option value="0">Select Product</option>');
                
                data.forEach(mat => {
                    $('#stock').append('<option value="'+mat.id+'">MS-'+padDigits(mat.id,5)+' | Available Stock: '+mat.available+' | On Hand '+mat.stock+'</option>');
                });
                        
            })
    });

    $('#stock').on('change',(id)=>{

        const msid = id.target.value;

        fetch('/material/stock-info/'+msid)
            .then((res) => res.json())
                .then((data) => {
                    console.log(data);

                    data.forEach( stock => {
                        $('#unit').val(stock.units);
                        $('#srp').val(stock.srp);
                        $('#s-available').val(stock.available);
                    });

                })
            });

const add_mat_item = async (mat) => {
  const settings = {
    method: 'POST',
    body: JSON.stringify(mat),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }
  const response = await fetch('/add/material/to-order', settings);
  try {
    const data = await response.json();
    console.log(data);
  } catch (err) {
    throw err;
  }
};


const clear_field = () =>{

    $('#srp').val('');
    $('#qty').val('');
    $('#unit').val('')
    $('#supplier').select2("val",'0');
    $('#product').empty();
    $('#product').append('<option value="0">Select Product</option>');
    $('#stock').empty();
    $('#stock').append('<option value="0">Select Product</option>');
    // $('#add-matlist').modal('hide');     
}

const get_orders = (osid) =>{

    fetch('/list/material-order/'+osid)
        .then((res) => res.json())
            .then((data) => {
                $('#o-list').empty();
                data.forEach( mat => {

                    $('#o-list').append('<tr>'+
                    '<td class="text-center">'+mat.Product_Code+'</td>'+
                    '<td class="text-center">'+mat.qty+'</td>'+
                    '<td class="text-center">'+mat.mark_up+'</td>'+
                    '<td class="text-center sbtotal">'+(Number(mat.qty) * Number(mat.mark_up)).toFixed(4)+'</td>'+
                    '<td class="text-center"><button type="button" onclick="rmvorder(this)"'+
                    'value = "'+mat.id+'" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">'+
                    '<i class="material-icons">delete</i></button></td>'+
                    '</tr>');

                })
               
            });
}


            $('#add-list').on('click',()=>{
                const stock = $('#stock').val();
                const qty = $('#qty').val();
                const available = $('#s-available').val();
                const srp = $('#srp').val();
                const osid = $('#osid').val();

                if (Number(qty) > Number(available)){

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Enter Valid Quantity!'
                        })
                        $('#qty').val('');
                        $('#qty').focus();                     
                return;
                }else{

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "If You Want To Add This Item!",
                        type: 'info',
                        showCancelButton: true,
                        animation: false,
                        customClass: {
                            popup: 'animated tada'
                        },
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Add it!',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value){

                            const mat = {
                                "osid":osid,
                                "stockid":stock,
                                "srp":srp,
                                "qty":qty
                            }
               
                            add_mat_item(mat);
                            //clear field
                            clear_field();
                            get_orders(osid);
                            //return new table
                            
                        }else if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            Swal.fire(
                                    'Cancelled',
                                    'Action Cancelled',
                                    'info'
                                    )
                            }
                   })
                }

            });



    const rmvorder = (mid) => {

        const osid = $('#osid').val();
        const oid = mid.value;


        Swal.fire({
                        title: 'Are you sure?',
                        text: " You Want To Delete This Item!",
                        type: 'warning',
                        showCancelButton: true,
                        animation: false,
                        customClass: {
                            popup: 'animated tada'
                        },
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete it!',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value){

                            fetch('/remove/from-order/'+oid)
                                .then((res) => res.json())
                                    .then((data) => { console.log(data);})
                
                            get_orders(osid);
                            //return new table
                            
                        }else if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            Swal.fire(
                                    'Cancelled',
                                    'Action Cancelled',
                                    'info'
                                    )
                            }
                   })

       

            
    }


    const deliver = (id) => {

        did = id.value;

        fetch('/list/material-order/'+did)
        .then((res) => res.json())
            .then((data) => {
                let counter = data.length;

                Swal.fire({
                        title: 'Are you sure?',
                        text: " You Want To Send This Order!",
                        type: 'info',
                        showCancelButton: true,
                        animation: false,
                        customClass: {
                            popup: 'animated tada'
                        },
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Proceed!',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.value){

                            if (counter == 0 || counter == null) {

                                Swal.fire(
                                    'Error',
                                    'Please Add Materials for this project First',
                                    'error'
                                    )
                                
                            } else {
                                $('#order-no').val(did);
                                $('#modal-dd').modal('show');
                                
                            }
                                                      
                        }else if (result.dismiss === Swal.DismissReason.cancel)
                        {
                            Swal.fire(
                                    'Cancelled',
                                    'Action Cancelled',
                                    'info'
                                    )
                            }
                   })

               
            })  

      

    }

    const delinfo = (id) => {

        did = id.value;

        location.href = '/material/print-delinfo/'+did;
        

    }

</script>

@endsection
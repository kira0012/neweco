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
width: 350px;
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

.table-order{

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
                            <h4 class="page-title">Recieved Materials</h4>
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
                                    <h2><strong>Recieve Record</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Recieved Stock </span></button>
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
                                       
                                        <th>Recieved Date</th>
                                        <th>Supplier</th>
                                        <th>Warehouse</th>
                                        <th>Total Cost</th>
                                        <th>Remarks</th>
                                        <th>View</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                               

                                  @foreach ($recieved_info as $recieve)
                                  <tr>
    
                                  <td class="text-center">{{$recieve->recieved_date}}</td>
                                  <td class="text-center">{{$recieve->Supplier}}</td>
                                  <td class="text-center">{{$recieve->warehouse_name}}</td>
                                  <td class="text-center">{{number_format($recieve->total_cost,4)}}</td>
                                  <td class="text-center">{{$recieve->remarks}}</td>
                                  <td class="text-center"><button type="button" onclick="recieveinfo(this)"
                                    value = "{{$recieve->id}}"
                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">call_missed_outgoing</i>
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

        {{-- <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>Stock Record</strong></h2>
                                        
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
                                                <th>Stock ID</th>
                                                <th>Product Name</th>
                                                <th>Description</th>
                                                <th>On Hand</th>
                                                <th>Cost</th>
                                                <th>Selling Price</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($stocks as $stock)
                                            <tr>
                                                <td class="text-center">MT-{{str_pad($stock->id,8,"0",STR_PAD_LEFT)}}</td>
                                            <td class="text-center">{{$stock->Product_Name}}</td>
                                            <td class="text-center">{{$stock->Description}}</td>
                                            <td class="text-center">{{$stock->stock}}</td>
                                            <td class="text-center">{{number_format($stock->price,4)}}</td>
                                            <td class="text-center">{{number_format($stock->srp,4)}}</td>
                                            </tr>
                                                
                                            @endforeach
                               
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- #END# Exportable Table -->


        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>List of Product Stock</strong></h2>
                                        
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
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Total Available</th>
                                            <th>Total On Hand</th>
                                            <th>Total Value</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($stockall as $stock)
                                      <tr>
                                    <td class="text-center">{{$stock->Product_Code}}</td>
                                      <td class="text-center">{{$stock->Product_Name}}</td>
                                      <td class="text-center">{{$stock->Description}}</td>
                                      <td class="text-center">{{$stock->total_available}}</td>
                                      <td class="text-center">{{$stock->total_onhand}}</td>
                                      <td class="text-center">{{number_format($stock->total_value,4)}}</td>
                                      
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="myLargeModalLabel">Recieve Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="/store/recieve/materials" method="post" id="recieve-form">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="rdate">Date:</label>
                                            <div class="form-line">
                                            <input type="date" id="rdate" name="rdate" class="form-control" value="{{$today}}" required>
                                            </div>
                                    </div>
                                    <input type="hidden" id="s-chk" />
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
                                            <input type="hidden" id="mat-code" value="" />
                                            <div class="form-group">
                                                    <label for="unit">Unit:</label>
                                                    <input type="text" id="unit" name="unit" value=""  class="form-control" readonly>
                                            
                                                </div>
                                            <div class="form-group">
                                                    <label for="price">Price/Unit:</label>
                                                        <div class="form-line">
                                                        <input type="number" id="price" name="price" class="form-control" required >
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label for="rdate">Qty:</label>
                                                                        <div class="form-line">
                                                                        <input type="number" id="qty" name="qty" class="form-control" >
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

                                               

                                                    <div class="form-group total">
                                                            <label for="available">Total Cost</label>
                                                                <div class="form-line">
                                                                        <input type="text" id="total-cost" name="total_cost" value="0" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                          
                                                                <button class="btn-hover btn-border-radius color-1" type="button" id="add-list" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Add To List</span></button>
                                                            

                                </div>
                                
                                <div class="col-lg-6">

                                        <div class="list-orders">
                                                <div class="order-content">
                                                    <table class="table-order">
                                                        <Tr class="text-center">
                                                            <th>Code</th>
                                                            <th>Quantity</th>
                                                            <th>SRP</th>
                                                            <th>Sub Total</th>
                                                            <th></th>
                                                        </Tr>
                                                        <tbody id = "mat-list">
                                                            
                                                        </tbody>
                
                                                    </table>
                                                </div>
                                                <br/>
                                                <hr>
                                                <div class="form-group default-select">
                                                        <label for="warehouse">Warehouse:</label>
                                                        <select class="form-control select2" data-placeholder="Select" name="warehouse" id="warehouse" >
                                                                <option value="0">Select Warehouse</option>
                                                                @foreach ($warehouse as $wr)
                                                                    <option value="{{$wr->id}}">{{$wr->warehouse_name}} | {{$wr->warehouse_location}} </option>
                                                                @endforeach
                                                               
                                                            </select>
                                                    </div>

                                                <div class="form-group">
                                                    
                                                        <label for="remarks"><b>Recieved Remarks:</b></label>
                                                            <div class="form-line">
                                                            <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="5"></textarea>
                                                            </div>
                                                    </div>     
                                                            <div class="row">
                                                                 <div class="col-lg-6">
                                                                
                                                                 </div>
                                                              <div class="col-lg-6">
                                                                  <button class="btn-hover btn-border-radius color-1" type="button" id="place-order" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Recieved</span></button>
                                                             </div>
                                                         </div>
                                                    </div>
                                                </form>

                                </div>
                            </div>
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

var items = 0;
let total_order = 0;

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

        

        const fill_product = (sid)=>{

            const s_chk = sid
             $('#s-chk').val(s_chk);
            fetch('/supplier/material-list/'+sid)
                .then((res) => res.json())
                    .then((data) => {

                            $('#product').empty();
                            $('#product').append('<option value="0">Select Product</option>');
                            console.log(data);
                            data.forEach(mat => {
                                $('#product').append('<option value="'+mat.id+'">'+mat.Product_Name+' | '+mat.Description+'</option>');
                            });
                        });
        }

        $('#supplier').on('change',(id)=>{

            const sid = id.target.value;
            

            const total_cost = $('#total-cost').val();

            if (total_cost > 0 ) {
                Swal.fire({
            title: 'Are you sure?',
            text: "If You Change the Supplier The Order you made a while ago will be deleted!",
            type: 'warning',
            showCancelButton: true,
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!',
            reverseButtons: true
            }).then((result) => {
                console.log(result.value);
            if (result.value){

                $('#mat-list').empty();
                fill_product(sid);
                $('#total-cost').val(0);
                clear_product();
                
                Swal.fire(
                'Deleted!',
                'Selected Order has been Removed.',
                'success'
                )
            }else if (result.dismiss === Swal.DismissReason.cancel)
            {
                const chk = $('#s-chk').val();
                $('#supplier').select2("val",chk);

                         Swal.fire(
                                'Cancelled',
                                'Action Cancelled',
                                'info'
                                )
                }

        })
    }else{
        fill_product(sid);
        return;
        }
});
  


        $('#product').on('change',(id) => {

            const mid = id.target.value;

            fetch('/material/info/'+mid)
                .then((res) => res.json())
                    .then((data) => {

                        data.forEach( mat => {

                            $('#mat-code').val(mat.Product_Code);
                            $('#unit').val(mat.units);
                            $('#price').val(mat.supplier_price);
                        })
                    });
                
        });

        const gettotal = () => {

        var sum = 0;
        $(".sub-total").each(function() {
        sum += parseFloat(this.value);
            });

            var total = sum.toFixed(4);
            $('#total-cost').val(total);
        }

        const add_tolist = (mat_details)=> {

            $('#mat-list').append('<tr id="order-'+mat_details.counter+'">'+
       '<td class="text-center">'+mat_details.mat_code+'<input type="hidden" value="'+mat_details.mat_id+'" name="materials[]" /></td>'+
       '<td class="text-center">'+mat_details.mat_qty+'<input type="hidden" value="'+mat_details.mat_qty+'" name="mat_qty[]" /></td>'+
       '<td class="text-center">'+mat_details.mat_srp+'<input type="hidden" value="'+mat_details.mat_srp+'" name="mat_srp[]" /></td>'+
       '<td class="text-center"><b>'+mat_details.mat_total+'</b><input type="hidden" class="sub-total" value="'+mat_details.mat_total+'" name="sub_totals[]" /></td>'+
       '<input type="hidden" value="'+mat_details.mat_price+'" name="unit_price[]" />'+
       '<td class="text-center"><button type="button" onclick=remove_tolist(this) value="'+mat_details.counter+'" class="btn btn-circle waves-effect waves-circle waves-float btn-danger">'+
       '<i class="material-icons">delete</i>'+
       '</button></td></tr>');
        }

        // i-del

        const clear_product = () =>{

       
        $('#qty').val('');
        $('#price').val('');
        $('#unit').val('');
        $('#srp').val('');
        $('#product').select2("val","0");

        }


        const remove_tolist = (order)=>{

                
    const id = order.value;

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
            confirmButtonText: 'Yes, Remove it!'
        }).then((result) => {
    if (result.value) {
        $('#order-'+id).remove();
            Swal.fire(
            'Deleted!',
            'Selected Order has been Removed.',
            'success'
            )
              gettotal();
          }
        })
    }


        $('#add-list').on('click',()=>{
            const qty = $('#qty').val();
            const amount = $('#price').val();
            const initotal = $('#total-cost').val();
            const mat_id = $('#product').val();
            const mat_code = $('#mat-code').val();
            const srp = $('#srp').val();
            if (qty == null || qty == ''){

                Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Enter Valid Quantity!'
                        })
                return;
            }

            if (srp == '' || srp == 0 || srp == null) {
                
                Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Enter Valid SRP!'
                        })

                        return;
            }
            const subtotal = (Number(qty) * Number(amount)).toFixed(4);
            //const total = (Number(subtotal) + Number(initotal)).toFixed(4);

         
        
            
         items += 1;

            var mat_details = {
            "counter":items,
            "mat_id":mat_id,
            "mat_code":mat_code,
            "mat_total":subtotal,
            "mat_srp":srp,
            "mat_qty":qty,
            "mat_price":amount,
            };

            add_tolist(mat_details);
            gettotal();
            clear_product();

        });

        $('#place-order').on('click',()=>{

            var chk = Number($('#total-cost').val());
            var warehouse = $('#warehouse').val();

                if (chk < 1 || chk == 0) {

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Select Product First!'
                        })

                }else{

                    if (warehouse == '' || warehouse == 0) {
                        
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Select Warehouse First!'
                        })
                        
                    } else {
                        $('#recieve-form').submit();
                    }

                   
                }
        });

//print recieved data;

        const recieveinfo = (rv)=> {

            const id = rv.value;

        location.href= '/recieved/materials-data/'+id;


        }

</script>

@endsection
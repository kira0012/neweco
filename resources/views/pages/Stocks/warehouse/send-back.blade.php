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

.btn-dcolor{

    background-color: lightgreen !important;

}

.rt-list{

    border: 2px solid;
    border-radius: 10%;
    height: 335px;
    width: 100%;
    overflow-y: scroll;
    overflow-x: hidden;
    padding-right: 25px; /* Increase/decrease this value for cross-browser compatibility */
    box-sizing: content-box; 
    -ms-overflow-style: none;  /*/ IE 10+ */
    scrollbar-width: none;  /*/ Firefox */

}
.rt-list::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

.list-orders{
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.cbtn{
    
    margin-top: 10px;
   
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
                            <h4 class="page-title">Return Stock</h4>
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
                                    <h2><strong>List of Return Stock</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Return Stock</span></button>
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
                                        <th>RTN Number</th>
                                        <th>Return Date</th>
                                        <th>Supplier Name</th>
                                        <th>No Stock</th>
                                        @can('Inventory')
                                        <th>Recieve</th>                                       
                                       @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                       @foreach ($returns as $return)
                                       <tr>
                                       <td class="text-center">RTN-{{str_pad($return->id,6,"0",STR_PAD_LEFT)}}</td>
                                       <td class="text-center">{{$return->return_date}}</td>
                                       <td class="text-center">{{$return->supplier}}</td>
                                       <td class="text-center">{{$return->total_product}}</td>
                                       @can('Inventory')
                                       <td class="text-center">
                                        <button type="button" onclick="recieve_return(this)"
                                            value = "{{$return->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">call_missed_outgoing</i>
                                        </button>
                                       </td>
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



<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Recieved Return Stock</h4>
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
                                <div class="col-lg-5">
                                        <h2><strong>List of Recieved Return Stock</strong></h2>
                                        
                                </div>
                                <div class="col-lg-5">
                                      
                                </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr>
                                            <th>RTN Number</th>
                                            <th>Return Date</th>
                                            <th>Recieve Date</th>
                                            <th>Supplier Name</th>
                                            <th>No Stock</th>
                                            <th>Recieve</th>                                        
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($returned as $return)
                                        <tr>
                                        <td class="text-center">RTN-{{str_pad($return->id,6,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center">{{$return->return_date}}</td>
                                        <td class="text-center">{{$return->recieve_date}}</td>
                                        <td class="text-center">{{$return->supplier}}</td>
                                        <td class="text-center">{{$return->total_product}}</td>
                                        <td class="text-center">
                                         <button type="button" onclick="recieve_return(this)"
                                             value = "{{$return->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                 <i class="material-icons">call_missed_outgoing</i>
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


       
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="myLargeModalLabel">Return Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
            </div>
         <div class="modal-body">
            <form action="/supplier/sendback-product" method="post" id="form-return">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="returndate">Return Date</label>
                                <div class="form-line">
                                    <input type="date" id="returndate" name="returndate" class="form-control" required>
                                </div>
                            </div>
                        <div class="form-group default-select">
                            <label for="unit">Select Supplier</label>
                            <input type="hidden" value="" id="s-check" />
                                <select class="form-control select2"  id="supplier-id" name="supplier-id">
                                    <option value="0" selected="true" disabled="true">Select Supplier</option>
                                        @foreach ($Suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        <div class="form-group default-select">
                                <label for="unit">Select Product</label>
                                    <select class="form-control select2" data-placeholder="Select" id="product-id" name="product-id">
                                        <option value="0" selected="true" disabled="true">Select Product</option>
                                    </select>
                        </div>  
                        <div class="form-group default-select">
                            <label for="unit">Select Stock</label>
                                <select class="form-control select2" data-placeholder="Select" id="stock-id" name="stock-id">
                                    <option value="0" selected="true" disabled="true">Select Stock</option>
                                </select>
                    </div>   
                    <div class="form-group default-select">
                            <label for="unit">Return Remarks</label>
                                <textarea name="remarks" id="" cols="30" rows="10"></textarea>
                    </div>                                       
                        
                        <div class="row">
                            <div class="col-lg-6">  
                                
                               
                            </div>
                            <div class="col-lg-6">
                               
                                        <button class="btn-hover btn-border-radius color-8" type="button" id="to-rtnlist" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Add Return </span></button>
                                    </div>
                                </div>
                            </div>

                        <div class="col-lg-6">
                            <div class="list-orders">
                                <div class="row rt-list">
                                    <div class="col-lg-6 stcode">
                                        <br />
                                        <label>Stock Code</label>
                                    </div>
                                    <div class="col-lg-4 rtnqty">
                                            <br />
                                            <label>Quantity/unit</label>
                                    </div>

                                    <div class="col-lg-2 rtncancel">
                                            <br />
                                            <label>Remove</label>
                                    </div>
                                </div>


                                    
                                            <div class="row">
                                                 <div class="col-lg-6">
                                                
                                                 </div>
                                              <div class="col-lg-6">
                                                  <button class="btn-hover btn-border-radius color-1" type="submit" id="btnreturn" style="float:right"><i data-feather="shopping-cart" style="height:15px"></i> <span>Send Product </span></button>
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
                $('.nav-inventory').click();
                $('.nav-warehouse-inventory').addClass('active');
                $('.nav-send-back').addClass('active');
            
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
    var counter = 0;
     function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

    $('#supplier-id').on('change', (id)=> {    
        const sid = id.target.value;
        if (counter == 0) {
            $('#product-id').empty();
                fetch('/my-product/'+sid)
                    .then((res) => res.json())
                        .then((products) => {
                            $('#product-id').append('<option value="0" selected="true" disabled="true">Select Product</option>')
                            products.forEach(product => {
                                $('#product-id').append('<option value="'+product.id+'">'+product.product_name+'</option>');
                            });
                        })
        } else {
            
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
            confirmButtonText: 'Yes, Remove it!'
            }).then((result) => {
            if (result.value) {
                counter = 0;
                $('.stcode').empty();
                $('.rtnqty').empty();
                $('.rtncancel').empty();

                $('.stcode').append('<br/> <label>Stock Code</label>');
                $('.rtnqty').empty('<br/> <label>Quantity/unit</label>');
                $('.rtncancel').empty('<br/> <label>Remove</label>');

                

            }
        });
     }
});


    $('#product-id').on('change', (id)=>{

        const pid = id.target.value;
            $('#stock-id').empty();
            fetch('/product/available/'+pid)
                .then((res) => res.json())
                    .then((stocks) => {
                        $('#stock-id').append(' <option value="0" selected="true" disabled="true">Select Stock</option>')
                        stocks.forEach(stock => {
                            $('#stock-id').append('<option value="'+stock.id+'">ST-'+padDigits(stock.id,8)+'</option>');
                        });
                    })
    });

    function rmvrtn(id){

        var rmv = id.value;
      
       $('.stc-'+rmv).empty();
       $('.rtq-'+rmv).empty();
       $('.rmbtn-'+rmv).empty();

    }
    

    $('#to-rtnlist').on('click', ()=>{

        const stcode = $('#stock-id').val();
        counter += 1;

        const stid = $('#stock-id').val();
        const padsid = 'ST-'+padDigits(stid,8);
      
        $('.stcode').append('<div class="stc-'+counter+'"><div class="form-line">'+
                            '<input type="hidden" name="stockcodes[]" value="'+stid+'" class="form-control" required readonly>'+
                            '<input type="text" name="padstockcodes[]" value="'+padsid+'" class="form-control" required readonly>'+
                            '</div></div>');

        $('.rtnqty').append('<div class="rtq-'+counter+'"><div class="form-line">'+
                            '<input type="text" name="rtnqties[]"  class="form-control rqty" required>'+
                            '</div></div>');
        $('.rtncancel').append('<div class="rmbtn-'+counter+'"><button type="button" onclick="rmvrtn(this)" value="'+counter+'" class="btn btn-danger btn-circle waves-effect waves-circle waves-float cbtn">'+
                                '<i class="material-icons">delete</i></button></div>');

    });


    $('#btnreturn').on('click',()=>{

        if (counter == 0) {

            event.preventDefault();
            Swal.fire({
            title: 'Transaction Failed',
            text: "Please Select Product's to Return!",
            type: 'error',
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
        });
        return;                
    }
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "Return Selected Product To Supplier!",
    //         type: 'warning',
    //         showCancelButton: true,
    //         animation: false,
    //         customClass: {
    //             popup: 'animated tada'
    //         },
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, Return it!'
    //         }).then((result) => {
    //         if (result.value) {

    //             if (counter == 0) {
    //                 Swal.fire({
    //         title: 'Transaction Failed',
    //         text: "Please Select Product's to Return!",
    //         type: 'error',
    //         animation: false,
    //         customClass: {
    //             popup: 'animated tada'
    //         },
    //     });
    //     return;                
    // }else{

    //     console.log($('input[name ="rtnqties[]"]').val());
    // }
               
                

           
    //      }
    // });
});

const recieve_return = (id)=>{

    const rtnid = id.value;
    location.href = '/supplier/recieved-return/'+rtnid;

}


</script>

@endsection
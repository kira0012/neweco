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
                            <h4 class="page-title">Return Order</h4>
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
                                    <h2><strong>Return Details</strong></h2>
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
                                        <th>DR No</th>
                                        <th>Customer</th>
                                        <th>Total Return</th>
                                        <th>Remarks</th>
                                        <th>Resolve</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($RtnInfo as $rts)
                                   <tr>
                                   <td class="text-center">DR-{{str_pad($rts->drno,8,"0",STR_PAD_LEFT)}}</td>
                                   <td class="text-center">{{$rts->customer}}</td>
                                   <td class="text-center">{{$rts->total_return}}</td>
                                   <td class="text-center">{{$rts->remarks}}</td>
                                   <td class="text-center"><button type="button" onclick="resolve_return(this)"
                                    value = "{{$rts->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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


        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-6">
                                        <h2><strong>Resolved Returns</strong></h2>
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
                                            <th>DR No</th>
                                            <th>Customer</th>
                                            <th>Total Return</th>
                                            <th>Remarks</th>
                                            <th>Resolve Date</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($Resolved as $rts)
                                       <tr>
                                       <td class="text-center">DR-{{str_pad($rts->drno,8,"0",STR_PAD_LEFT)}}</td>
                                       <td class="text-center">{{$rts->customer}}</td>
                                       <td class="text-center">{{$rts->total_return}}</td>
                                       <td class="text-center">{{$rts->remarks}}</td>
                                       <td class="text-center">{{date('Y-m-d',strtotime($rts->updated_at))}}</td>
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
        <div class="modal fade bd-example-modal-lg" id="modal-return" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="myLargeModalLabel">Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form-approve">
                            @csrf
                              <input type="hidden" value="" name="cid" id="cid" />
                              <table>
                                  <tr class="text-center">
                                  <th>Stock ID</th>
                                  <th>Product Code</th>
                                  <th>Product Description</th>
                                  <th>Action</th>
                                  <th>Qty</th>
                                  
                                </tr>
                                <tbody id="rtn-orders">
                                    
                                </tbody>
                              </table>
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="resolve-btn" value="" class="btn btn-info waves-effect">Resolve</button>
                    </form>
                        {{-- <button type="button" id ="del" class="btn btn-danger waves-effect">Delete</button> --}}
                    </div>
                </div>
            </div>
        </div>


        <script>
                window.onload = function () {
                   // $('.nav-transaction').click();
                    $('.nav-ship-orders').addClass('active');
                    $('.nav-shipped-return').addClass('active');
                   
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



<script>

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}


const resolveOrder = async (rsv_id) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(rsv_id),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch('/resolve/customer-return', settings);

  try {
    const data = await response.json();
    console.log(data);
    //location.reload();
  } catch (err) {
    throw err;
  }
};


$('#resolve-btn').on('click', ()=>{

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
            confirmButtonText: 'Yes, Resolve Order!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm! Half Way There!',
                'Click OK to Procced!',
                'success'
                ).then((result) =>{
                    if(result.value){
                        const rsv_id = $('#resolve-btn').val();

                        const resolve = {"rsv_id":rsv_id};
                        // fetch('/resolve/return/customer-order')

                        resolveOrder(resolve);
                        
                        setTimeout(function(){ location.reload(); }, 1500);
                        
                    }
                  
                   // location.href = '/customer-order/return-order';
                    
                })
                
            }
        })
})






const resolve_return = (id)=>{
    const rts_id = id.value;
    $('#resolve-btn').val(rts_id);
    fetch('/returns/fetch-items/'+rts_id)
        .then((res) => res.json())
            .then((data) => {
                $('#modal-return').modal('show');
                     console.log(data);
                    $('#rtn-orders').empty();
                data.forEach(item => {
                    $('#rtn-orders').append('<tr>'+
                        '<td class ="text-center">ST-'+padDigits(item.stock_id, 8)+'</td>'+
                        '<td class ="text-center">'+item.product_code+'</td>'+
                        '<td class ="text-center">'+item.description+'</td>'+
                        '<td class ="text-center">'+item.action+'</td>'+
                        '<td class ="text-center">'+item.qty+'</td>'+
                        '</tr>');
                    

                }); 
            });


   
}
</script>

@endsection
@extends('layouts.template')
{{-- @section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> 
@endsection --}}
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
#txtheader{
    text-align: center;
}
#view-content{
    margin-top: 50px;
}

#print-logo{
    height:200; 
    width:100%;
    display: block;
    margin: 0 auto;
}
#report-print{
    box-shadow: 3px 3px 3px 3px;
}

#logo-name{

    margin-top: 35px;
    margin-left: -55px;
}
@media print {
   
  body * {
    visibility: hidden;
    padding-left: 1.3mm;
    padding-right: 1.3mm; 
    padding-top: 1.1mm;
  }
  .report-print * {
    visibility: visible;
    font-size: 20px;
  }
  .report-print {
    width:100%;
    border:0px;
    position: fixed;
    left: 0;
    top: -40;
  }
  #hlogo{

      margin-right: -50px;
  }
  .dr-title{
      font-size: 25px;
      margin-top: -20px;
  }
  .bot{
    position: fixed;
    bottom: 10px;
    width: 100%;
  }

  .bot-content{

      position: absolute;
      bottom: 10px;
      width: 100%;
  }
  .td-bot{
      width: 50%;
  }
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
                                <h4 class="page-title">Purchased Order</h4>
                            </li>
                        </ul>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button type="button" onclick="go_back(this)"
                        value = "{{$Order_Details->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">arrow_back</i>
                                        </button>
                        <button class="btn-hover btn-border-radius color-8" id="print-report" style="float:right"><i data-feather="print" style="height:15px"></i> <span>Print </span></button>
                       @can('Inventory')
                        @if ($Order_Details->order_status == '0')
                        <button class="btn-hover btn-border-radius color-8" id="edit-po" style="float:right"><i data-feather="box" style="height:15px"></i> <span>EDIT Order</span></button>
                        @endif
                        @endcan
                    </div>                 
                </div>
            </div>
            <div class="report-print" id="report-print">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-12" id="pheader">
                                        <img src="{{asset('assets/images/logowithheader.png')}}" id="print-logo" />
                                </div>
                            </div>

                            <input type="hidden" id="po_id" value="{{$Order_Details->id}}" />

                        <h5 style="float:right;color:red">D.O. No: {{str_pad($Order_Details->id,8,"0",STR_PAD_LEFT)}}</h5>
                    
                        </div>
                            <center>
                            <h2 class="dr-title">Delivery Order</h2>
                            </center>
                        <div class="body">
                            <div class="table-responsive">

                                    <table class="table table-bordered">
                                            <thead>
                                                   <tr>
                                                       
                                                   <td colspan="4">Supplier: {{$Supplier->supplier}}</td>  
                                                   <td colspan="3">Date: {{$Order_Details->order_date}}</td>
                                                   </tr>
                                                   <tr>
                                                   <td colspan="4">Address: {{$Supplier->address}}</td>
                                                   <td colspan="3">No. of Orders: {{$Order_Details->no_order}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td colspan="6"><h6></h6></td>
                                                   </tr>
                                                   <tr>
                                                   <td class="text-center">Product Code</td>
                                                   <td class="text-center">Product Name</td> 
                                                   <td class="text-center">Product Description</td>
                                                   <td class="text-center">Qty</td>
                                                   <td class="text-center">Unit</td>
                                                   <td class="text-center">Unit/Price</td>
                                                   <td class="text-center">Cost</td>
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Order_Products as $Product)
                                                <tr>
                                            
                                            <td class="text-center">{{$Product->product_code}}</td>
                                            <td class="text-center">{{$Product->product_name}}</td>
                                            <td class="text-center">{{$Product->description}}</td>
                                            <td class="text-center">{{$Product->product_qty}}</td>
                                            <td class="text-center">{{$Product->units}}</td>
                                            <td class="text-center">{{number_format($Product->unit_price,4)}}</td>
                                            <td class="text-center decimal">{{number_format($Product->cost,4)}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                <td class="text-center" colspan="6">Total Cost</td>
                                                <td class="text-center">{{number_format($Order_Details->total_cost,4)}}</td>
                                                </tr>
                                            </tbody>
                                           
                                        </table>
                            </div>
                        </div>
                        <div class="bot">
                                <div class="bot-content">
                                  <div class="table-responsive">
                                  
                                <table class="tb-bot" style="width:100%;">
                                    <thead>
                                    <tr>
                                    <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">PREPARED BY: {{$preparedby->name}}</span></h6></td>
                                        <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">APPROVED BY:</span></h6></td>
                                    </tr>                          
                                </thead>
                                </table>
    
                            
                            </div>
                        </div>    
                            </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>


<script>


function go_back(id){
    const pid = id.value;

        window.location.href='/delivery-order';

}
function sum(input){
             
             if (toString.call(input) !== "[object Array]")
                return false;
                  
                        var total =  0;
                        for(var i=0;i<input.length;i++)
                          {                  
                            if(isNaN(input[i])){
                            continue;
                             }
                              total += Number(input[i]);
                           }
                         return total;
                        }


$('#print-report').on('click', function(){

    window.print();


    
})


$('#edit-po').on('click', ()=>{

var id = $('#po_id').val();

window.location.href ='/delivery-order/edit/'+id;
});

</script>

@endsection
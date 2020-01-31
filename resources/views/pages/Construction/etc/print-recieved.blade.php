@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
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

.drno{
    float:right;
    margin-right: 50px;
}


.dr{

    color: red;
}

#logo-name{

    margin-top: 35px;
    margin-left: -55px;
}
.dr-code{

width: 100px !important;
}

@media print {
    /* .card {  position: relative !important; display: block; 
          box-sizing: content-box !important;
    } */
    @page {
    size: auto;  
    margin: 0;  
  }
  /* .pbr{
    page-break-after: always;
  } */
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
  .dr-title{
      font-size: 25px;
      margin-top: -20px;
  }
  .body {
      margin-top: -35px;
  }

  .dr{
      margin-top: -50px;
  }
  .pbr{
    page-break-after:always;
  }

  .dr-desc{

      width: 60% !important;
  }
  .dr-code{

      width: 150px !important;
  }

  .tb-content, .tb-content td,.tb-content th{

    border: 2px solid black !important;
    
  }

  

  
}

</style>
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                {{-- <h4 class="page-title">Banking Report</h4> --}}
                            </li>
                         
                        </ul>
                        <button class="btn-hover btn-border-radius color-8" id="print-report" style="float:right"><i data-feather="print" style="height:15px"></i> <span>Print </span></button>
                                        
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
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="drno">
                                            {{-- <h5 class="dr">DR NO:{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</h5>
                                    </div> --}}
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                      
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                    <table class="table tb-content">
                                            <thead>
                                                   <tr>
                                                   <input type="hidden" value="" id="s-id" />
    
                                                   <td class="tb-content" colspan="4"><b>Supplier:</b> {{$supplier->Supplier}}</td>  
                                                   <td class="tb-content" colspan="4"><b>DATE:</b> {{$recieve_data->recieved_date}} </td>
                                                   </tr>
                                                   <tr>
                                                   <td class="tb-content" colspan="4"><b>ADDRESS:</b>  {{$supplier->Address}}</td>
                                                   <td class="tb-content" colspan="4"><b>Destination</b> {{$warehouse->warehouse_name}}</td>
                                                  
                                                   </tr>
                                                   
                                                   
                                                   <tr>
                                                       <td colspan="8"><h6></h6></td>
                                                   </tr>
                                                   <tr>
                                                   <th class="text-center dr-code">Code</th>
                                                   <th class="text-center">Product Name</th> 
                                                   <th class="text-center dr-desc" colspan ="2">Product Description</th>
                                                   <th class="text-center">Qty</th>
                                                   <th class="text-center">Unit</th>
                                                   <th class="text-center">Unit/Price</th>
                                                   <th class="text-center">Cost</th>
                                                  
                                                  
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($stocks as $Product)
                                                <tr>
                                            
                                            <td class="text-center  dr-code">{{$Product->Product_Code}}</td>
                                            <td class="text-center  dr-code">{{$Product->Product_Name}}</td>
                                            <td class="text-center dr-desc" colspan="2">{{$Product->Description}}</td>
                                            <td class="text-center">{{$Product->no_recieved}}</td>
                                            <td class="text-center">{{$Product->units}}</td>
                                            <td class="text-center">{{number_format($Product->price,4)}}</td>
                                            <td class="text-center">{{number_format($Product->sub_total,4)}}</td>
                                        
                                                </tr>
                                                @endforeach 
                                                {{--
                                                <tr>
                                                <td class="text-center" colspan="4">Total Cost</td>
                                                <td class="text-center" colspan="3">{{number_format($totalcost,4)}}</td>
                                                </tr>
                                               
                                            </tbody> --}}
                                           
                                        </table>
                            </div>
                        <div class="bot">
                            <div class="bot-content">
                              <div class="table-responsive">
                              
                            <table class="tb-bot" style="width:100%;">
                                <thead>
                                <tr>
                                <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">Recieved BY:</span> {{$reciever->name}}</h6></td>
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

    </section>
{{-- Modals --}}     
      
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>


<script>

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

</script>

@endsection
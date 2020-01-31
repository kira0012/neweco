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
 
    size: 8.269in 5.847in; 
    /* size: 139mm 215mm !important; */
    margin: 0;  

  }
 

  .first{

    height: 9in !important;
 
  }

  /* .pbr{
    page-break-after: always;
  } */
  /* body {
    width: 139mm;
  height: 215mm;
  margin: 0;
  } */
  body * {
    visibility: hidden;
    padding-left: 1.3mm;
    padding-right: 1.3mm; 
    padding-top: 1.1mm;
    
    /* height: 5.847in;
    width: 8.269in; */
   
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
    /* position: fixed; */
    bottom: 10px;
    width: 100%;
    border: 0px;
  }

  .bot-content{

      /* position: absolute; */
      bottom: 10px;
      width: 100%;
  }
  .td-bot, {
      width: 50%;
      border: none !important;

  }
  .tb-bot{
    border-collapse: collapse !important;
  
  }
  .dr-title{
      font-size: 25px;
      /* margin-top: -20px; */
  }
  .body {
      margin-top: -35px;
  }

  .dr{
      /* margin-top: -50px; */
  }
  .pbr{
    page-break-after:always;
  }

  .dr-desc{

      width: 70% !important;
  }
  .dr-code{

      width: 20%;
  }

  .tb-content, .tb-content td,.tb-content th{

    border: 2px solid black !important;
    
  }
  .first{
      height: 50%;
      position: relative;
  }

  .btr{

      margin-top: -50px !important;
      margin-right: 150px !important;
  }
  .btc{
      margin-top: 100px;
  }

  .top-head{

      margin-top: 60px !important;
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
            <div class="first">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row top-head" style="margin:20px;">
                                <div class="col-lg-12" id="pheader">
                                        {{-- <img src="{{asset('assets/images/logowithheader.png')}}" id="print-logo" /> --}}
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    
                                    <h5 class="dr" style="float:right">ON-{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</h5>
                                    <br/>
                                    <h3 style="float:right">INTRANSIT COPY</h3>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        {{-- <h3 class ="dr-title" style="color:black;">DELIVERY RECEIPT</h3> --}}
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
    
                                                   <td class="tb-content" colspan="2"><b>CUSTOMER:</b> {{$DrCustomer->business_name == null ? $DrCustomer->name : $DrCustomer->business_name}}</td>  
                                                   <td class="tb-content" colspan="3"><b>DATE:</b> {{$tripsched->departure}}</td>
                                                   </tr>
                                                   <tr>
                        
                                                    <td class="tb-content" colspan="2"><b>DR NO:{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}} / Trip Ticket:T-{{str_pad($DrDetails->id,5,"0",STR_PAD_LEFT)}}</b></td>
                                                   <td class="tb-content" colspan="3"><b>P.O Date</b> {{$DrDetails->order_date}}</td>
                                                    {{-- <td class="tb-content" colspan="3"><b>Released BY:</b> {{$releaseby}}</td> --}}
                                                    </tr>
                                                   
                                                 
                                                   <tr>
                                                   <th class="text-center dr-code">Code</th>            
                                                   <th class="text-center dr-desc" colspan ="2">Product Description</th>
                                                   <th class="text-center">Qty</th>
                                                   <th class="text-center">Unit</th>
                                                   
                                                  
                                                  
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($DrOrders as $Product)
                                                <tr>
                                            
                                            <td class="text-center">{{$Product->product_code}}</td>
                                            {{-- <td class="text-center">{{$Product->product_name}}</td> --}}
                                            <td class="text-center dr-desc" colspan="2" style="width:90%" >{{$Product->description}}</td>
                                            <td class="text-center">{{$Product->qty}}</td>
                                            <td class="text-center">{{$Product->units}}</td>
                                                </tr>
                                                @endforeach 
                                               
                                               
                                            </tbody>
                                           
                                        </table>
                            </div>
                        <div class="bot">
                            <div class="bot-content">
                                <div class="row btc">
                                    <div class="col-lg-6">
                                            <h6 style="color:black;"><span style=" font-size:15px;">RELEASED BY:</span> {{$releaseby}}</h6>
                                    </div>
                                    <div class="col-lg-6 btr">
                                            <h6 style="color:black;float:right;"><span style=" font-size:15px;">CHECKED BY:</span></h6>
                                    </div>
                                    <div class="col-lg-12">
                                            <h6 style="color:black;"><span style=" font-size:13px;">REMARKS:</span> {{$intransits_record->Remarks}}</h6>
                                        
                                    </div>
                                </div>
                            {{-- <table class="table tb-bot">
                                <tr>
                                    <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">RELEASED BY:</span> {{$releaseby}}</h6></td>
                                    <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">CHECKED BY:</span></h6></td>
                                </tr>
                            </table> --}}
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </div>
            <hr style="border-top: 1px solid black; width:100%">

            
            {{-- </div> --}}

            <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    {{-- <div class="col-lg-12" id="pheader">
                                            <img src="{{asset('assets/images/logowithheader.png')}}" id="print-logo" />
                                    </div> --}}
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <h5 class="dr" style="float:right">ON-{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</h5>
                                        <br/>
                                        <h3 style="float:right">DRIVER'S COPY</h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <center>
                                            {{-- <h3 class ="dr-title" style="color:black;">DELIVERY RECEIPT</h3> --}}
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
        
                                                       <td class="tb-content" colspan="2"><b>CUSTOMER:</b> {{$DrCustomer->business_name}}</td>  
                                                       <td class="tb-content" colspan="3"><b>DATE:</b> {{$tripsched->departure}}</td>
                                                       </tr>
                                                       <tr>
                            
                                                        <td class="tb-content" colspan="2"><b>DR NO:{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}} / Trip Ticket:T-{{str_pad($DrDetails->id,5,"0",STR_PAD_LEFT)}}</b></td>
                                                       <td class="tb-content" colspan="3"><b>P.O Date</b> {{$DrDetails->order_date}}</td>
                                                        {{-- <td class="tb-content" colspan="3"><b>Released BY:</b> {{$releaseby}}</td> --}}
                                                        </tr>
                                                       
                                                     
                                                       <tr>
                                                       <th class="text-center dr-code">Code</th>            
                                                       <th class="text-center dr-desc" colspan ="2">Product Description</th>
                                                       <th class="text-center">Qty</th>
                                                       <th class="text-center">Unit</th>
                                                       
                                                      
                                                      
                                                       </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($DrOrders as $Product)
                                                    <tr>
                                                
                                                <td class="text-center">{{$Product->product_code}}</td>
                                                {{-- <td class="text-center">{{$Product->product_name}}</td> --}}
                                                <td class="text-center dr-desc" colspan="2" style="width:90%" >{{$Product->description}}</td>
                                                <td class="text-center">{{$Product->qty}}</td>
                                                <td class="text-center">{{$Product->units}}</td>
                                                    </tr>
                                                    @endforeach 
                                                   
                                                   
                                                </tbody>
                                               
                                            </table>
                                </div>
                            <div class="bot">
                                <div class="bot-content">
                                    <div class="row btc">
                                        <div class="col-lg-6">
                                                <h6 style="color:black;"><span style=" font-size:15px;">RELEASED BY:</span> {{$releaseby}}</h6>
                                        </div>
                                        <div class="col-lg-6 btr">
                                                <h6 style="color:black;float:right;"><span style=" font-size:15px;">CHECKED BY:</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                            <h6 style="color:black;"><span style=" font-size:13px;">REMARKS:</span> {{$intransits_record->Remarks}}</h6>
                                        
                                    </div>
                                {{-- <table class="table tb-bot">
                                    <tr>
                                        <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">RELEASED BY:</span> {{$releaseby}}</h6></td>
                                        <td class="td-bot"><h6 style="color:black;"><span style=" font-size:15px;">CHECKED BY:</span></h6></td>
                                    </tr>
                                </table> --}}
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        
    </div>

    <script>
            window.onload = function () {
                $('.nav-transaction').click();
                $('.nav-shippment').click();
                $('.nav-ship-orders').addClass('active');
                $('.nav-intransit-orders').addClass('active');
            
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
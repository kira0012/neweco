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

      width: 70% !important;
  }
  .dr-code{

      width: 20% !important;
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
                                   
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <h3 class ="dr-title" style="color:black;">Order Payment Details</h3>
                                    </center>
                                    <Br/>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                    <table class="table tb-content">
                                            <thead>
                                                   <tr>
                                                   <th class="text-center" style="width:150px">Customer :</th>
                                                   <th class="text-center">{{$customer->business_name == null ? $customer->name : $customer->business_name}}</th>
                    
                                                   </tr>
                                                   <tr>
                                                        <th class="text-center" style="width:150px">Address :</th>
                                                        <th class="text-center">{{$customer->address}}</th>
                                                   </tr>
                                            </thead>
                                           
                                           
                                        </table>
                            </div>
                            <div class="table-responsive">
                                    <table class="table tb-content">
                                            <thead>
                                                   <tr>
                                                   <th class="text-center" colspan="4">Details</th>
                                                  
                                                   </tr>
                                                   <tr>
                                                        <th class="text-center" colspan="2">Information</th>
                                                        <th class="text-center" colspan="2">Bills</th>
                                                   </tr>
                                                  
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Payment Date:</td>
                                                    <td class="text-center"><b>{{$transaction->payment_date}}</b></td>
                                                    <td class="text-center">1000</td>
                                                    <td class="text-center">{{isset($denomination->ca1000) != null ? $denomination->ca1000 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center">DrNo:</td>
                                                        <td class="text-center"><b>DR-{{str_pad($transaction->drno,8,"0",STR_PAD_LEFT)}}</b></td>
                                                        <td class="text-center">500</td>
                                                        <td class="text-center">{{ isset($denomination->ca500) != null ? $denomination->ca500 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center" >Payment Type:</td>
                                                        <td class="text-center" ><b>{{$transaction->payment_desc}}</b></td>
                                                        <td class="text-center">200</td>
                                                        <td class="text-center">{{ isset($denomination->ca200) != null ? $denomination->ca200 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center">Cheque No</td>
                                                        <td class="text-center">{{$transaction->checkno}}</td>
                                                        <td class="text-center">100</td>
                                                        <td class="text-center">{{ isset($denomination->ca100) != null ? $denomination->ca100 : '0'}}</td>
                                                </tr>
                                                <tr>    
                                                        <td class="text-center">Bank Account</td>
                                                        <td class="text-center"><b>{{ $transaction->bank_id != null ? $transaction->depositTobank->bank .'/'. $transaction->depositTobank->bank_account : ' '}}</b></td>
                                                        <td class="text-center">50</td>
                                                        <td class="text-center">{{ isset($denomination->ca50) != null ? $denomination->ca50 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center" colspan="2">Remarks</td>
                                                        <td class="text-center">20</td>
                                                        <td class="text-center">{{ isset($denomination->ca20) != null ? $denomination->ca20 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        <td class="text-center" colspan="2" rowspan="6" style="width:100px">{{$transaction->Remarks}}</td>
                                                        
                                                        <td class="text-center">10</td>
                                                        <td class="text-center">{{ isset($denomination->ca10) != null ? $denomination->ca10 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        
                                                        <td class="text-center">5</td>
                                                        <td class="text-center">{{ isset($denomination->ca5) != null ?$denomination->ca5 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        
                                                        <td class="text-center">1</td>
                                                        <td class="text-center">{{ isset($denomination->ca1) != null ? $denomination->ca1 : '0'}}</td>
                                                </tr>
                                                <tr>
                                                       
                                                        
                                                        <td class="text-center">25c</td>
                                                        <td class="text-center">{{ isset($denomination->ca025c) != null ? $denomination->ca025c : '0'}}</td>
                                                </tr>
                                                <tr>
                                                       
                                                        <td class="text-center">10c</td>
                                                        <td class="text-center">{{ isset($denomination->ca010c) != null ? $denomination->ca010c : '0'}}</td>
                                                </tr>
                                                <tr>
                                                        
                                                        <td class="text-center">05c</td>
                                                        <td class="text-center">{{ isset($denomination->ca05c) != null ? $denomination->ca05c : '0'}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="3"><b>Total Amount:</b></td>
                                                <td class="text-center"><b>{{number_format($transaction->amount)}}</b></td>
                                                </tr>
                                            </tbody>
                                           
                                           
                                        </table>
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
    // $('.nav-transaction').click();
    $('.nav-payment').addClass('active');
    $('.nav-order-payment').addClass('active');

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
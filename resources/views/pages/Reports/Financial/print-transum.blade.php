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
                                            <h5 style="color:black">DATE: {{$transdate}}</h5>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <h3 class ="dr-title" style="color:black;">Bank Transactions</h3>
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
                                                   <th class="text-center">Bank Name</th>
                                                   <th class="text-center">Account Number</th>
                                                   <th class="text-center">Transaction</th>
                                                   <th class="text-center">Amount</th>
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reports as $bank)
                                                <tr>
                                                <td class="text-center">{{$bank->bank}}</td>
                                                <td class="text-center">{{$bank->bank_account}}</td>
                                                <td class="text-center">{{$bank->trans_type == 1 ? 'DEPOSIT' : 'WITHDRAW'}}</td>
                                                <td class="text-center">{{number_format($bank->amount,4)}}</td>
                                                </tr>
                                                    
                                                @endforeach
                                                
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
    $('.nav-transaction').click();
    $('.nav-banking').addClass('active');
    $('.nav-banktransactions').addClass('active');

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
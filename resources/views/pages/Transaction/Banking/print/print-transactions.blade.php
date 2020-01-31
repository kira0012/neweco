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
@media print {
   
  body * {
    visibility: hidden;
    padding-left: 1.3mm;
    padding-right: 1.3mm; 
    padding-top: 1.1mm;
    /* width: 90%; max-width: 1048px;  */
  }
  .report-print * {
    visibility: visible;
    font-size: 13px;
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
                                <br>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    {{-- <div class="drno">
                                            <h5 class="dr">DR NO:{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</h5>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                            <br/>
                            <h5 id="range"></h5>
                        <div class="body">
                           
                            <div class="table-responsive">

                                    <table class="table table-bordered">
                                            <thead>
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
                                                @foreach ($DrOrders as $Product)
                                                <tr>
                                            
                                            <td class="text-center">{{$Product->product_code}}</td>
                                            <td class="text-center">{{$Product->product_name}}</td>
                                            <td class="text-center">{{$Product->description}}</td>
                                            <td class="text-center">{{$Product->qty}}</td>
                                            <td class="text-center">{{$Product->units}}</td>
                                            <td class="text-center">{{number_format($Product->price,2)}}</td>
                                            <td class="text-center">{{number_format($Product->total)}}</td>
                                        
                                                </tr>
                                                @endforeach
                                                <tr>
                                                <td class="text-center" colspan="4">Total Cost</td>
                                                <td class="text-center" colspan="3">{{number_format($totalcost)}}</td>
                                                </tr>
                                               
                                            </tbody>
                                           
                                        </table>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>
{{-- Modals --}}     
      
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
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
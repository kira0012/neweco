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
                                <h4 class="page-title">Inventory Report</h4>
                            </li>
                        </ul>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {{-- <button type="button" onclick="go_back(this)"
                        value = "{{$Order_Details->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">arrow_back</i>
                                        </button> --}}
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
                            </div>
                       
                        </div>
                            <center>
                            <h2 class="dr-title">Stock Report</h2>
                            </center>
                        <div class="body">
                            <div class="table-responsive">

                                    <table class="table table-bordered">
                                            <thead>
                                                   <tr class="text-center">
                                                       
                                                        <th>Product Code</th>
                                                        <th>Product Name</th>
                                                        <th>Description</th>
                                                        <th>Total Available</th>
                                                        <th>Total On Hand</th>
                                                        <th>Total Value</th>

                                                   </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($totalstock as $stock)
                                                    <tr>
                                                  <td class="text-center">{{$stock->product_code}}</td>
                                                    <td class="text-center">{{$stock->product_name}}</td>
                                                    <td class="text-center">{{$stock->description}}</td>
                                                    <td class="text-center">{{$stock->total_available}}</td>
                                                    <td class="text-center">{{$stock->total_stock}}</td>
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
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>

    <script>
            window.onload = function () {
                $('.nav-reports').click();
                $('.nav-inventory-reports').click();
                // $('.nav-ship-orders').addClass('active');
                $('.nav-inventory-stockonhand').addClass('active');
            
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



</script>

@endsection
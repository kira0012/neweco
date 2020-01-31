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

#print-logo{
    height:200; 
    width: 100%;
    display: block;
    margin: 0 auto;
}
#report-print{
    box-shadow: 3px 3px 3px 3px;
}
#mylink{
    text-decoration: none;
    color: #212529;
}

table, th, td{

    border: 2px solid black !important;
}

@media print {
   
   body * {
     visibility: hidden;
   }
   .report-print * {
     visibility: visible;
     font-size: 15px;
     
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
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Trip Cargo</h4>
                        </li>
                    </ul>
                    <button class="btn-hover btn-border-radius color-8" id="print-report" style="float:right"><i data-feather="print" style="height:15px"></i> <span>Print </span></button>
                            
                </div>
            </div>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                        <div class="report-print" id="report-print">
                    <div class="header">
                        <div class="col-lg-12" id="pheader">
                                <img src="{{asset('assets/images/logowithheader.png')}}" id="print-logo" />
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">

                                <table class="table tb-bordered">
                                    <thead>
                                        <tr>
                                        <td colspan="3">Driver: {{$tripsched['0']['driver']}}</td>
                                        <td colspan="3">Delivery Date: {{$tripsched['0']['departure']}}</td>
                                        </tr>
                                        <tr class="text-center">
                                        <td colspan="3">Vehicle Class: {{$tripsched['0']['class']}}</td>
                                        <td colspan="2">Vehicle Model {{$tripsched['0']['model']}}</td>
                                       
                                        </tr>
                                        <tr>

                                        <td colspan="2">Plate No: {{$tripsched['0']['plateNo']}}</td>
                                        <td></td>
                                        <td colspan="1">Trip Schedule:</td>
                                        <td colspan="1" class="text-danger text-center">TS-{{str_pad($tripsched['0']['id'],8,"0",STR_PAD_LEFT)}}</td>
                                      
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                        </tr>
                         
                                        <tr>
                                            <td class="text-center">Customer</td>
                                            <td class="text-center">Location</td>
                                            <td class="text-center">No of Orders</td>
                                            <td class="text-center">Payment Term</td>  
                                            <td class="text-center">total Amount</td>   
                                            
                                        </tr>
                                        <tbody>
                                            @foreach ($cargos as $cargo)
                                            <tr>
                                            <td class="text-center"><a href="/customer/print/dr-form/{{$cargo->id}}" id="mylink">{{$cargo->business_name}}</a></td>
                                            <td class="text-center">{{$cargo->address}}</td>
                                            <td class="text-center">{{$cargo->no_orders}}</td>
                                            <td class="text-center">{{$cargo->type}}</td>
                                            <td class="text-center">{{$cargo->total_amount}}</td>
                                            </tr>
                                                
                                            @endforeach
                                           
                                           
                                            
                                        </tbody>
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
</section>


@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script>

$('#print-report').on('click', ()=>{

    window.print();

});

</script>

@endsection
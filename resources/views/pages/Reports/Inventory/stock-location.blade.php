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

#txtheader{
    text-align: center;
}
#view-content{
    margin-top: 50px;
}

.nb{

    border-bottom: none;
}
.page-title{

    color:black !important;
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
.top-line{

border-top: solid;
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
font-size: 13px;
}
.report-print {
width:100%;
/* border:0px; */
position: fixed;
left: 0;
top: -40;
}
#hlogo{

  margin-right: -50px;
}

.tb-content{
    border: 2px solid !important;
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
                            <h4 class="page-title">Warehouse Stocks</h4>
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
                            <div class="col-lg-6">
                                    <h2><strong>Select Warehouse</strong></h2>
                                <br/>
                                    <div class="form-group default-select">
                                                 <select class="form-control select2" data-placeholder="Select" id="s-warehouse">
                                                    <option value="" selected="true" disabled="true">Select Transaction</option>
                                                    @foreach ($warehouse as $wr)
                                                 <option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  id="view-content" style="float:left"><i data-feather="box" style="height:15px"></i><span>View Stocks</span></button>
                                    
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
           
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<div class="hide-this">
    <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="breadcrumb breadcrumb-style">
                                <li>
                                    <h4 class="page-title">Warehouse Report</h4>
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
                                </div>
                                <br>
                                <br>
                             <h5 class="page-title">Warehouse Reports</h5>
                            <h5 class="text-right" style="color:black;">Date: {{$today}}</h6>
                            </div>
                                <br/>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table tb-content">
                                      
                                           <tr>
                                               <td class="tb-content text-center" style="width:150px">Warehouse Name:</td>
                                               <td class="tb-content text-center" colspan="3" id="wh-name">Warehouse A</td>
                                           </tr>
                                           <tr>
                                               <td class="tb-content text-center">Address:</td>
                                               <td class="tb-content text-center" colspan="3" id="wh-address">Address d2</td>
                                           </tr>
                                           <tr>
                                               <td colspan="4"></td>
                                           </tr>
                                           <tr class="text-center">
                                               <td class="tb-content text-center">Stock ID</td>
                                               <td class="tb-content text-center">Product Name</td>
                                               <td class="tb-content text-center">Description</td>
                                               <td class="tb-content text-center" >On-Hand</td>
                                           </tr>
                                  
                                           <tbody id="rw-stocks">
                                              
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
    </div>
{{-- Modals --}}     


<script>
    window.onload = function () {
        $('.nav-reports').click();
        $('.nav-inventory-reports').click();
        // $('.nav-ship-orders').addClass('active');
        $('.nav-inventory-warehousestock').addClass('active');
    
        $.each($(".menu .list li.active"), function(i, val) {
          var $activeAnchors = $(val).find("a:eq(0)");
          console.log('1');
          console.log($activeAnchors);
          $activeAnchors.addClass("toggled");
          $activeAnchors.next().show();
        });
        
    
    }

    document.onreadystatechange = function(e)
            {
                $('.nav-inventory-reports').addClass('active');
                $('.nav-inventory-warehousestock').addClass('active');
            };

//     addEventListener("DOMContentLoaded", function() {
//     //Your code goes here
//     $('.nav-reports').click();
//         $('.nav-inventory-reports').active();
//         // $('.nav-ship-orders').addClass('active');
//         $('.nav-inventory-warehousestock').addClass('active');
    
//         $.each($(".menu .list li.active"), function(i, val) {
//           var $activeAnchors = $(val).find("a:eq(0)");
//           console.log('1');
//           console.log($activeAnchors);
//           $activeAnchors.addClass("toggled");
//           $activeAnchors.next().show();
//         });
// });
    
    </script>

      
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>

<script>

$('.hide-this').hide();

$('#view-content').on('click', function(){

    $('.hide-this').show();

});

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}

$('#print-report').on('click', function(){

window.print();
    
})

$('#s-warehouse').on('change', (id)=>{

    const wid = id.target.value;


    $('.hide-this').hide();
        fetch('/warehouse/info/'+wid)
            .then((res) => res.json())
                .then((warehouse)=>{
                    console.log(warehouse);
                    $('#wh-name').text(warehouse.warehouse_name);
                    $('#wh-address').text(warehouse.warehouse_location);
                }).catch((error)=>{
            console.log(error);
        })
        
        $('#rw-stocks').empty();

        fetch('/warehouse/all-stock/'+wid)
            .then((res) => res.json())
                .then((mystocks)=>{
                    console.log(mystocks);
                    mystocks.forEach(objstock => {
                        $('#rw-stocks').append('<tr>'+
                            '<td class="text-center">ST-'+padDigits(objstock.id,8)+'</td>'+
                            '<td class="text-center">'+objstock.product_name+'</td>'+
                            '<td class="text-center">'+objstock.description+'</td>'+
                            '<td class="text-center">'+objstock.stock+'</td>'+
                            '</tr>');
                    });
                   
                }).catch((error)=>{
            console.log(error);
        })


});



</script>

@endsection
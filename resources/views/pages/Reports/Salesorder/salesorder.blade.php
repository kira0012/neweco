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

.page-title{
    color:black !important;
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

#range{
    margin-left: 70px;

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
    font-size: 15px;
  }
  .report-print {
    width:100%;
    border:0px;
    position: absolute;
    left: 0;
    top: -40;
    page-break-inside:auto
  }
  #hlogo{

      margin-right: -50px;
  }
}

</style>
@section('content')
<div id="not-print">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Sales Order Report</h4>
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
                                    <h2><strong>Select Dates</strong></h2>
                                <br/>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="auditdate">FROM</label>
                                                    <div class="form-line">
                                                        <input type="date" id="from" name="auditdate" class="form-control" value={{$first}}>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                    <label for="auditdate">TO</label>
                                                        <div class="form-line">
                                                        <input type="date" id="to" name="auditdate" class="form-control" value="{{$last}}">
                                                        </div>
                                                    </div>
                                        </div>
                                      


                                    </div>
                                  
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  id="view-content" style="float:left"><i data-feather="box" style="height:15px"></i><span>Get Report</span></button>
                                    
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
</div>

<div class="hide-this">
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Sales Order Report</h4>
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
                         <h5 style="color:black;">Sales Order Reports</h5>
                        </div>
                            <br/>
                            <h5 id="range"></h5>
                            
                            <div class="body">
                            <div class="table-responsive">
                                <table>
                                        <tr class="nb">
                                            <th>Dr No:</th>
                                            <th>Trip Ticket</th>
                                            <th>Customer</th>
                                            <th>Payment Type</th>
                                            <th>Amount</th>
                                        </tr>
                                        <tbody id="orders">
                                        </tbody>
                                        <tr class="top-line nb">
                                                <td colspan="4" class="text-center"><b>Gross Sale Order</b></td>
                                                <td id="tamount">
                                        </tr>
                                         <tr class="nb" id="ttsale">
                                            <td colspan="4" class="text-center"><b>Total Order</b></td>
                                            <td id="tcount"></td>
                                            </td>
                                            
                                        </tr>

                                        
                                       
                                            {{-- <tr class="top-line nb">
                                                    <td colspan="2" class="text-center"><b>Net Income</b></td>
                                                    <td id="income"></td>
                                                </tr> --}}
    
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
            $('.nav-so-reports').click();
            $('.nav-so-report').addClass('active');
        
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
<script src="{{asset('assets/js/form.min.js')}}"></script>
<!-- Custom Js -->
{{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script> --}}


<script>
function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
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

var moneyFormat;

moneyFormat = function(value, sep) {
  if (sep == null) {
    sep = ',';
  }
  // check if it needs formatting
  if (value.toString() === value.toLocaleString()) {
    // split decimals
    var parts = value.toString().split('.')
    // format whole numbers
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, sep);
    // put them back together
    value = parts[1] ? parts.join('.') : parts[0];
  } else {
    value = value.toLocaleString();
  }
  return value;
//   return parseFloat(value).toFixed();

// console.log(parseFloat(test).toFixed(4));
};


$('.hide-this').hide();

$('#view-content').on('click', function(){



    const from = $('#from').val();
    const to = $('#to').val();

        if (from == '' || to == '') {
            Swal.fire(
                'Error!',
                'Please Select Date Range',
                'error'
                );
        } else {


    $('#range').empty();
    $('#range').append('Sales Order Summary  '+from+' - ' +to);
    $('.hide-this').show();

    salesorder(from,to);
   
        }
});



   const salesorder = (from,to) => {
       fetch('/salesorder/'+from+'/'+to)
        .then((res) => res.json())
            .then((data) =>{

                console.log(data);

                var totalremits = 0;
                data.forEach(objso => {

                        if (objso.trip_id == null) {
                            $('#orders').append('<tr class="nb">'+
                            '<td>DR-'+padDigits(objso.id,8)+'</td>'+
                            '<td></td>'+
                            '<td>'+((objso.business_name == null) ? objso.name : objso.business_name)+'</td>'+
                            '<td>'+objso.type+'</td>'+
                            '<td><b>'+moneyFormat(objso.total_amount)+'</b></td>'+
                            '</tr>');
                             totalremits += Number(objso.total_amount);
                        } else {
                            $('#orders').append('<tr class="nb">'+
                            '<td>DR-'+padDigits(objso.id,8)+'</td>'+
                            '<td>T-'+padDigits(objso.trip_id,8)+'</td>'+
                            '<td>'+((objso.business_name == null) ? objso.name : objso.business_name)+'</td>'+
                            '<td>'+objso.type+'</td>'+
                            '<td><b>'+moneyFormat(objso.total_amount)+'</b></td>'+
                            '</tr>');
                             totalremits += Number(objso.total_amount);
                        }
                   
                    })
                    $('#tcount').empty();
                    $('#tcount').append('<b>'+data.length+'</b>');
                    $('#tamount').empty();
                    $('#tamount').append('<b>'+moneyFormat(totalremits)+'</b>');   

                });
   }    



const report_init = ()=>{
    
    const from = $('#from').val();
    const to = $('#to').val();
    
    $('#range').empty();
    $('#range').append('Sales Order Summary  '+from+' - ' +to);
    $('.hide-this').show();
    
   
    salesorder(from,to);
}

report_init();

$('#print-report').on('click', function(){

    window.print();
 
});

</script>

@endsection
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
<div id="not-print">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Sales Collection Report</h4>
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
                                                    <input type="date" id="from" name="auditdate" class="form-control" value="{{$first}}" />
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
                                <h4 class="page-title">Collection Report</h4>
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
                       
                         <h5 style="color:black;">Collection Reports</h5>
                         <h5 id="range" style="color:black;"></h5>
                        </div>
                        <br/>

                           
                        <div class="body">
                            <div class="table-responsive">
                                <table>
                                        <tr class="top-line nb">
                                                <td><B>Sales Order Collection</B></td>
                                                <td colspan="2" class="text-center"></td>
                                        </tr>
                                        <tr class="nb">
                                            <th class="text-center">Qty</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                        </tr>
                                        <tbody id="scollect">
                                        </tbody>
                                         <tr class="nb" id="ttsale">
                                                <td colspan="2" class="text-center"><b>Total Order Sale Collection</b></td>
                                                <td id="salescollection">
                                                </td>
                                            </tr>
                                        <tr class="top-line nb">
                                            <td><B>Job Order Payment</B></td>
                                            <td colspan="2" class="text-center"></td>
                                        </tr>
                                        <tbody id="jcollection">
                                        </tbody>
                                        <tr class="nb" id="ttsale">
                                                <td colspan="2" class="text-center"><b>Total Job Order Collection</b></td>
                                                <td id="jobcollection"></td>
                                            </tr>

                                            <tr class="top-line nb">
                                                <td><B>Branch Remittance Collection</B></td>
                                                <td colspan="2" class="text-center"></td>
                                            </tr>
                                            <tbody id="brcollection">
                                            </tbody>
                                            <tr class="nb" id="ttsale">
                                                    <td colspan="2" class="text-center"><b>Total Branch Remittance Collection</b></td>
                                                    <td id="tbrcollection"></td>
                                                </tr>


                                            <tr class="top-line nb">
                                                    <td colspan="2" class="text-center"><b>Total Amount</b></td>
                                                    <td id="gross-income"></td>
                                                </tr>
    
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
            $('.nav-financial-reports').click();
            $('.nav-collection-report').addClass('active');
        
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

// function moneyFormat(price, sign = 'Php: ') {
//     const pieces = parseFloat(price).toFixed(4).split('')
//         let ii = pieces.length - 3
//                 while ((ii-=3) > 0) {
//                     pieces.splice(ii, 0, ',')
//                 }
//     return sign + pieces.join('')
// }

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
    $('#range').append('Collection Summary From '+from+' To '+to);
    $('#sumdate').append('Date: '+from+' - ' +to);
    $('.hide-this').show();

    total_collection(from,to);
    // my_sales(from,to);
    // my_expenses(from,to);
    // net_income(from,to); 
    init_report();
    
    

        }
});


const init_report = ()=>{

    const from = $('#from').val();
    const to = $('#to').val();


    $('#range').empty();
    $('#range').append('From '+from+' To '+to);
    $('#sumdate').append('Date: '+from+' - ' +to);
    $('.hide-this').show();

    total_collection(from,to);
    jo_collection(from,to);
    remittance(from,to);
    get_total();
    
   
   
}


    const total_collection = (from,to)=>{

        fetch('/total-collection/'+from+'/'+to)
            .then((res) => res.json())
                .then((data) => {
                  
                    var tcollection = 0;

                    $('#scollect').empty();

                        data.forEach(sc => {
                            $('#scollect').append('<tr class = "nb">'+
                                '<td class="text-center">'+sc.qty+'</td>'+
                                '<td>'+sc.payment_desc+'</td>'+
                                '<td><b>'+sc.amount+'</b></td>'+
                                '</tr>');
                                    tcollection += Number(sc.amount);
                                });
                   
                    $('#salescollection').empty();
                    $('#salescollection').append('<b>'+moneyFormat(tcollection.toFixed(2))+'</b>');
                   
                   localStorage.tsalescollection = tcollection;
                })

               
    }

    const jo_collection = (from,to)=>{

            fetch('/jo-collection/'+from+'/'+to)
                .then((res) => res.json())
                    .then((data) => {

                        var jcollection = 0;

                        $('#jcollect').empty();
                        
                        data.forEach(jc => {

                            $('#jcollection').append('<tr class = "nb">'+
                                '<td class="text-center">'+jc.qty+'</td>'+
                                '<td>'+jc.type+'</td>'+
                                '<td><b>'+jc.amount+'</b></td>'+
                                '</tr>');
                                jcollection += Number(jc.amount);
                            
                        });

                        $('#jobcollection').empty();
                        $('#jobcollection').append('<b>'+moneyFormat(jcollection.toFixed(2))+'</b>');

                        if (jcollection == null || jcollection == NaN) {
                            localStorage.tjbcollection = 0;
                        }else{
                            localStorage.tjbcollection = jcollection;
                        }
                        
                    })
                    
    }

    const remittance = (from,to) => {
       fetch('/report/remittance-sum/'+from+'/'+to)
        .then((res) => res.json())
            .then((remits) =>{

                console.log(remits);

                var totalremits = 0;
                remits.forEach(objremit => {
                    $('#brcollection').append('<tr class="nb">'+
                            '<td class="text-center">'+objremit.qty+'</td>'+
                            '<td>'+objremit.store_name+'</td>'+
                            '<td><b>'+moneyFormat(objremit.total_amount)+'</b></td>'+
                            '</tr>');
                             totalremits += Number(objremit.total_amount);
                    })
                    $('#tamount').empty();
                    $('#tamount').append(moneyFormat(totalremits.toFixed(2)));   

                    if (totalremits == null || totalremits == NaN) {
                            localStorage.branchcollection = 0;
                        }else{
                            localStorage.branchcollection = totalremits;
                        }

                });
   }   

    const get_total = ()=> {
        $('#gross-income').empty();
        setTimeout(function(){ 
            var gross = Number(localStorage.tjbcollection) + Number(localStorage.tsalescollection) + Number(localStorage.branchcollection);
            $('#gross-income').append('<b>'+moneyFormat(gross.toFixed(2))+'</b>');


            
             }, 1000);
 
    }


init_report();

$('#print-report').on('click', function(){

    window.print();
 
});

</script>

@endsection
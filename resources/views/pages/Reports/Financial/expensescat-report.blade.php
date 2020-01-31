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
                            <h4 class="page-title">Expenses Report</h4>
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
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="auditdate">FROM</label>
                                                    <div class="form-line">
                                                    <input type="date" id="from" name="auditdate" class="form-control" value="{{$first}}" />
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                    <label for="auditdate">TO</label>
                                                        <div class="form-line">
                                                            <input type="date" id="to" name="auditdate" class="form-control" value="{{$last}}">
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group" style="margin-top:10px;">
                                                    <label for="auditdate">Category</label>
                                                        <div class="form-line default-select">
                                                            <select class="form-control select2" name="cat" id="cat">
                                                                    <option value="jo">Job Order</option>
                                                                @foreach ($category as $cat)
                                                                    <option value="{{$cat->id}}">{{$cat->expenses}}</option>
                                                                @endforeach
                                                            </select>
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
                                <h4 class="page-title">Expenses Report</h4>
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
                         <h5 style="color:black;">Expenses Reports</h5>
                        </div>
                            <br/>
                            <h5 id="range"></h5>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table">
                                        <tr class="nb">
                                            <th>Expense Date</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Remarks</th>
                                        </tr>
                                        <tbody id="listexpenses">
                                        </tbody>         
                                            <tr class="top-line nb">
                                                    <td colspan="2" class="text-center"><b>Total Expenses</b></td>
                                                    <td colspan="2"  id="texp"></td>
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
            $('.nav-expenses-catreport').addClass('active');
        
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
   
    init_report();

        }
});


const init_report = ()=>{

    const from = $('#from').val();
    const to = $('#to').val();
    let category = $('#cat').val();
    let cat = $('#cat');

    $('#range').empty();
    $('#range').append('Expenses Summary From '+from+' To '+to);
    $('#sumdate').append('Date: '+from+' - ' +to);
    $('.hide-this').show();
  
    if (category === 'jo') {
        jo_expenses(from,to);
    } else {
        list_expenses(from,to,category);
    }
  
 
   

}

   

   const list_expenses = (from,to,category)=>{

        fetch('/report/expenses-cat/'+from+'/'+to+'/'+category)
            .then((res) => res.json())
                .then((list) => {

                    console.log(list)
                    $('#listexpenses').empty();

                    var totalexpenses = 0;

                    list.forEach(exlist => {

                        $('#listexpenses').append('<tr class="nb">'+
                        '<td>'+exlist.expense_date+'</td>'+
                        '<td>'+exlist.category+'</td>'+
                        '<td class="emp"><b>'+moneyFormat(exlist.amount)+'</b></td>'+
                        '<td style="width:300px; class="text-center">'+((exlist.remarks == null) ? " " : exlist.remarks )+'</td>'+
                        '</tr>');

                        totalexpenses += Number(exlist.amount);
                       
                    });

                    $('#texp').empty();
                    $('#texp').append('<b>'+moneyFormat(totalexpenses)+'</b>');
                })


   }

   const jo_expenses = (from,to)=>{

fetch('/report/expenses-joborder/'+from+'/'+to)
    .then((res) => res.json())
        .then((list) => {

            console.log(list)
            $('#listexpenses').empty();

            var totalexpenses = 0;
            
            list.forEach(exlist => {

                $('#listexpenses').append('<tr class="nb">'+
                '<td></td>'+
                '<td>'+exlist.category+'</td>'+
                '<td class="emp"><b>'+moneyFormat(exlist.expense)+'</b></td>'+
                '<td style="width:300px; class="text-center"></td>'+
                '</tr>');

                totalexpenses += Number(exlist.expense);
               
            });

            $('#texp').empty();
            $('#texp').append('<b>'+moneyFormat(totalexpenses)+'</b>');
        })


}




init_report();

$('#print-report').on('click', function(){

    window.print();
 
});

</script>

@endsection
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

#print-logo{
    height:170; 
    width:700;
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
<div id="not-print">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Banking Transaction Report</h4>
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
                                                        <input type="date" id="from" name="auditdate" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                    <label for="auditdate">TO</label>
                                                        <div class="form-line">
                                                            <input type="date" id="to" name="auditdate" class="form-control" >
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
                                <h4 class="page-title">Banking Report</h4>
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
                         <h5>Bank Transactions</h5>
                        </div>
                            <br/>
                            <h5 id="range"></h5>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered center">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Bank Name</th>
                                            <th>Transaction</th>
                                            <th>Amount</th>
                                            <th>Balance</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="bank-trans">
                                        
                               
                                    </tbody>
                                    
                                </table>
                            </div>
                                <div class="summarry table-responsive">
                                    <h6>Transaction Summarry</h6>
                                    <h6 id="sumdate"></h6>
                                    
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <table id="tsum">
                                                <tr>
                                                <th>Bank</th>
                                                <th>Account Number</th>
                                                <th>Total Deposit</th>
                                                <th>Total Withdraw</th>
                                                <th>Total Transactions</th>
                                                </tr>
                                               <tbody id="trans-sum">

                                               </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
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
            // $('.nav-ship-orders').addClass('active');
            $('.nav-banking-report').addClass('active');
        
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


$('.hide-this').hide();

$('#view-content').on('click', function(){

   // $('.hide-this').show();

    var from = $('#from').val();
    var to = $('#to').val();
    
    var chkfrom = new Date(from);
    var chkto = new Date(to);
 
    if (chkfrom > chkto) {
        
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Valid Range',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            }).then((result) =>{
                $('.hide-this').hide();
            })
           
    }

        if (from == '' || to == ''){
            Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Please Select Dates',
            animation: false,
            customClass: {
                popup: 'animated rubberBand'
            },
            })
        } else {
            $('#range').empty();
            $('#sumdate').empty();
            $('#range').append('Transactions From: '+from+' To:  '+to);
            $('#sumdate').append('Date: '+from+' - ' +to);
            $('#bank-trans').empty();

            fetch('/banking/transactions/'+from+'/'+to)
            .then((res) => res.json())
                .then((trans)=>{
                    console.log(trans);

                    trans.forEach(objdata => {
                        // console.log(objdata.transaction_date);
                        $('#bank-trans').append('<tr>'+
                        '<td class="text-center">'+objdata.transaction_date+'</td>'+
                        '<td class="text-center">'+objdata.bank+'</td>'+
                        '<td class="text-center">'+((objdata.trans_type == 1) ? 'Deposit' : 'Withdraw')+'</td>'+
                        '<td class="text-center">'+objdata.amount+'</td>'+
                        '<td class="text-center">'+objdata.balance+'</td>'+
                        '</tr>');
                    });
                   

                   
                }).catch((error)=>{
            console.log(error);
        })

        $('#trans-sum').empty();

            fetch('/banking/transactions-summary/'+from+'/'+to)
            .then((res) => res.json())
                .then((transum) => {
                    console.log(transum);

                    transum.forEach(objtrans => {

                    $('#trans-sum').append('<tr>'+
                            '<td class="text-center">'+objtrans.bank+'</td>'+
                            '<td class="text-center">'+objtrans.bank_account+'</td>'+
                            '<td class="text-center">'+objtrans.deposit+'</td>'+
                            '<td class="text-center">'+objtrans.withdraw+'</td>'+
                            '<td class="text-center">'+objtrans.total_transactions+'</td>'+
                            '</tr>');

                    });

                }).catch((error) => {

                    console.log(error);
                })


       


            $('.hide-this').show();
        }


   

    var amount = ['1233','3434','1233','3442','3432'];

    const totals = sum(amount);

    // $('#tsum').append('<tr><td>sdfdfdfsfsdfsdfsdf</td></tr>')
  

});

$('#print-report').on('click', function(){

    window.print();


    
})

</script>

@endsection
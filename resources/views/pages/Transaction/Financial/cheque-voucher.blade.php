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
.v-head{
      background-color: lightgrey !important;

  }
@media print {
  
  body * {
    visibility: hidden;
    padding-left: 1.3mm;
    padding-right: 1.3mm; 
    padding-top: 1.1mm;
    /* width: 90%; max-width: 1048px;  */
    -webkit-print-color-adjust: exact !important;
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
  .v-head{
      background-color: lightgrey !important;

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
                        <button class="btn-hover btn-border-radius color-8" id="print-report" style="float:right"><span>Print </span></button>
                        @can('Reports')
                        
                        @if ($voucher->status == 0)
                        <button class="btn-hover btn-border-radius color-8" id="voucher-approved" style="float:right"><span>Approved </span></button>
                        <button class="btn-hover btn-border-radius color-3" id="voucher-disapproved" style="float:right"><span>Decline </span></button>
                        <input type="hidden" id="voucher-id" value="{{$voucher->id}}" />
                        
                        @endif
                            
                            @endcan                    
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
                                                
                                                   <tr class="v-head">
                                                   <th class="text-center">Payee</th>
                                                   <th class="text-center">Date</th> 
                                                   <th class="text-center" style="width:300px;">Voucher Number</th>                                                          
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td class="text-center">{{$voucher->payee}}</td>
                                                <td class="text-center">{{$voucher->request_date}}</td>
                                                <td class="text-center dr">RFC-{{str_pad($voucher->id,5,"0",STR_PAD_LEFT)}}</td>
                                                </tr>
                                                <tr class="v-head" style="background-color:lightgrey">
                                                    <th class="text-center" colspan="2"> Particulars/Remarks</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                                <tr style="height:400px">
                                                    <td class="text-center" colspan="2">
                                                            {{$voucher->remarks}}
                                                            
                                                    </td>
                                                    <td class="text-center">
                                                        <b> {{number_format($voucher->amount,4)}}</b>
                                                    </td>
                                                </tr>
                                                <tr class="v-head">
                                                
                                                    <td class="text-center">Request by: {{$requestby->name }} </td>
                                                    @if ($voucher->status != 1)
                                                    <td class="text-center dr">Decline by: {{$voucher->approved_by == null ? "Not Yet Approved" : $approvedby->name}}</td>
                                                    <td class="text-center dr">Decline Date: {{$voucher->approved_date == null ? "Not Yet Approved" : $voucher->approved_date }}</td>
                                                    @else
                                                    <td class="text-center">Approved by: {{$voucher->approved_by == null ? "Not Yet Approved" : $approvedby->name}}</td>
                                                    <td class="text-center">Approved Date: {{$voucher->approved_date == null ? "Not Yet Approved" : $voucher->approved_date }}</td>
                                                    @endif
  
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

$('#voucher-approved').on('click',(id)=>{
    
        const vcid = $('#voucher-id').val();

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approved Voucher!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){

    const vid = {
                "vid":vcid,
                "action":'1'
                };
    action(vid);  
    setTimeout(function(){ location.href = '/cheque/voucher/'+vcid; }, 1500);

                }
            })
        }
    })

});

$('#voucher-disapproved').on('click' ,()=>{


    const vcid = $('#voucher-id').val();

Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
type: 'warning',
showCancelButton: true,
animation: false,
customClass: {
    popup: 'animated tada'
},
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Decline Voucher!'
}).then((result) => {
if (result.value) {
    Swal.fire(
    'Confirm! Half Way There!',
    'Click OK to Procced!',
    'success'
    ).then((result) =>{
        if(result.value){

const vid = {
        "vid":vcid,
        "action":'9'
        };
action(vid);  
setTimeout(function(){ location.href = '/cheque/voucher/'+vcid; }, 1500);

        }
    })
}
})

});





const action = async (vid) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(vid),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch('/approved/cheque/request', settings);

  try {
    const data = await response.json();
    console.log(data);
    //location.reload();
  } catch (err) {
    throw err;
  }
};

</script>

@endsection
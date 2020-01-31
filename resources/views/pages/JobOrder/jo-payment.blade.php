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

.fblack{
    
    color:black !important;
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
                            <h4 class="page-title">J.O Payments</h4>
                        </li>
                    </ul>
                    @include('inc.message')
                </div>
            </div>
        </div>
        <!-- Exportable Table -->
        <div class="row">
            <div class="col-md-12 col-xl-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="m-t-5 m-b-20">Total Job Orders</h4>
                            <h3 class="f-w-700 col-blue n-counter">{{$jo_count}}</h3>
                                {{-- <p class="m-b-0">40% High Then Last Month</p> --}}
                            </div>
                            <div class="col-auto">
                                {{-- <div class="chart chart-bar"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12 col-xl-6">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="m-t-5 m-b-20">Job Order Recievables</h4>
                            <h3 class="f-w-700 col-green n-counter">{{$jo_recievables}}</h3>
                                {{-- <p class="m-b-0">40% High Then Last Month</p> --}}
                            </div>
                            <div class="col-auto">
                                {{-- <div class="chart chart-bar"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6">
                                <h2><strong>List of Payments</strong></h2>
                        </div>
                        <div class="col-lg-6">
                            @can('Payments')
                                <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>New Payment</span></button>
                            @endcan    

                        </div>
                    </div>
                </div>
            <div class="body">
{{-- button d2 --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                        <thead>
                            <tr>
                                <th>JO number</th>
                                <th>Customer</th>
                                <th>Category</th>
                                <th>Descripton</th>
                                <th>Amount</th>
                                <th>Jo Date</th>
                                <th style="width:70px">print</th>
                                <th style="width:70px">Details</th>
                                <th style="width:70px">Summary</th>

                              
                               
                                
                            </tr>
                        </thead>
                            <tbody>
                             @foreach ($payments as $payment)
                             <tr>
                             <td class="text-center">JO-{{str_pad($payment->jo_id,5,"0",STR_PAD_LEFT)}}</td>
                             <td class="text-center">{{$payment->customer}}</td>
                             <td class="text-center">{{$payment->category}}</td>
                             <td class="text-center">{{$payment->description}}</td>
                             <td class="text-center">{{number_format($payment->amount,4)}}</td>
                             <td class="text-center">{{$payment->jo_date}}</td>
                             <td class="text-center">
                             <button type="button" onclick="print_jo(this)"
                                        value = "{{$payment->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons" style="margin-left: 3px;">printer</i>
                                        </button> 
                             </td>
                             <td class="text-center">
                                <button type="button" onclick="jopayment_details(this)"
                                        value = "{{$payment->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons" style="margin-left: 3px;">list</i>
                                </button> 
                            </td>
                            <td class="text-center">
                                <button type="button" onclick="jopayment_summary(this)"
                                        value = "{{$payment->jo_id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons" style="margin-left: 3px;">list</i>
                                </button> 
                            </td>
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
</section>



<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">New Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form action="/job-order/new/payment" method="post" id="form-jopayment">
                        @csrf    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bankname">Payment Date</label>
                                        <div class="form-line">
                                        <input type="date" name="jo_date" class="form-control" value="{{$today}}" required>
                                    </div>
                                </div>

                                <div class="form-group default-select">
                                    <label for="jo-cat">Category</label>
                                        <select class="form-control select2" data-placeholder="Select" id="cat-id" name="jo_cat" required>
                                            <option value="" selected="true" disabled="true">Select Category</option>
                                                @foreach ($jocats as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                                                @endforeach     
                                        </select>
                                </div>

                                <div class="form-group default-select">
                                        <label for="jo-cat">Customer / Job Order</label>
                                            <select class="form-control select2" data-placeholder="Select" id="jo-id" name="jo_id" required>
                                                <option value="" selected="true" disabled="true">Select Job Order</option>     
                                        </select>
                                    </div>
                                
                                <div class="form-group">
                                        <label for="description">Job Details</label>
                                            <div class="form-line">
                                                <textarea class="form-control"  id="jo-desc" name="description" cols="10" rows="5" value="" required readonly></textarea> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="amount">Total Balance</label>
                                                <div class="form-line">
                                                    <input type="number" step="0.0001" id="jo-amt" name="jo_amount" class="form-control" placeholder="0" required readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                    <label for="amount">Amount Paid</label>
                                                        <div class="form-line">
                                                            <input type="number" step="0.0001" id="jo-paid" name="jo_paid" class="form-control" placeholder="0" required >
                                                        </div>
                                                    </div>

                            </div>

                            <div class="col-lg-6">
                                    <div class="form-group default-select">
                                            <label for="jo-cat">Payment Type</label>
                                                <select class="form-control select2" data-placeholder="Select" id="payment-type" name="payment_type" required>
                                                    <option value="" selected="true" disabled="true">Select Payment Type</option>  
                                                    @foreach ($p_type as $p)
                                                <option value="{{$p->id}}">{{$p->type}}</option>
                                                    @endforeach   
                                            </select>
                                        </div>
    
                                    <div class="cheque-info">
                                        <div class="form-group">
                                                <label for="unit">Cheque Number</label>
                                                <input class="form-control ci" type="number" id="cheque_no" name="cheque_no" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="unit">Payee Name</label>
                                                <input class="form-control ci" type="text" id="payee_name" name="payee_name" value="">
                                            </div>
                                    </div>

                                    <div class="direct-deposit">
                                            <div class="form-group default-select">
                                                <label for="bank">Select Bank</label>
                                                     <select class="form-control select2" data-placeholder="Select" id="bankname" name="bankname">
                                                        <option value="" selected="true" disabled="true">Select Bank</option>
                                                            @foreach ($banks as $bank)
                                                                <option value="{{$bank->id}}">{{$bank->bank}}-{{$bank->bank_account}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="unit">Transaction Number:</label>
                                                        <input class = "form-control" type="text" value="" id="Transaction-no" name="Transaction-no" />  
                                                    </select>
                                                </div>
                                        </div>


                                    <div class="cash">
                                            <hr>
                                            <h6>Denomination Amount</h6>
                                            <br/>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem1000">1000 - bill</label>
                                                            <input class="form-control dem" data-amount = "1000" type="text" id="dem1000" name="dem1000" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem500">500 - bill</label>
                                                            <input class="form-control dem" data-amount ="500" type="text" id="dem500" name="dem500" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem200">200 - bill</label>
                                                            <input class="form-control dem" data-amount ="200" type="text" id="dem200" name="dem200" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem100">100 - bill</label>
                                                            <input class="form-control dem" data-amount ="100" type="text" id="dem100" name="dem100" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem50">50 - bill</label>
                                                            <input class="form-control dem" data-amount ="50" type="text" id="dem50" name="dem50" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem20">20 - bill</label>
                                                            <input class="form-control dem" data-amount ="20" type="text" id="dem20" name="dem20" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem10">10 - Coin</label>
                                                            <input class="form-control dem" data-amount ="10" type="text" id="dem10" name="dem10" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem5">5 - Coin</label>
                                                            <input class="form-control dem" data-amount ="5" type="text" id="dem5" name="dem5" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem1">1 - Coin</label>
                                                            <input class="form-control dem" data-amount ="1" type="text" id="dem1" name="dem1" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem025">.25 - Coin</label>
                                                            <input class="form-control dem" data-amount =".25" type="text" id="dem025" name="dem025" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem010">.10 - Coin</label>
                                                            <input class="form-control dem" data-amount =".10" type="text" id="dem010" name="dem010" value="">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="dem005">.05 - Coin</label>
                                                            <input class="form-control dem" data-amount =".05" type="text" id="dem005" name="dem005" value="">
                                                    </div>
                                                </div>
                                            </div>
                                                
        
                                    </div>
                                    <div class="form-group">
                                            <label for="amount">Remarks</label>
                                                <div class="form-line">
                                                    <input type="text" name="jo_premarks" class="form-control" placeholder="Remarks" >
                                                </div>
                                            </div>
                            </div>
                          

                        </div>
                          
                       

                            
                               
                           

                           
                                
                    </div>

                <div class="modal-footer">
                    <button type="button" id="make-payment" class="btn btn-info waves-effect">Add Payment</button>
                </form>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>  

<script>
        window.onload = function () {
            // $('.nav-transaction').click();
            $('.nav-payment').addClass('active');
             $('.nav-jos-payment').addClass('active');
        
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
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>

<script>

$('.n-counter').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
}, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
                $(this).text(Math.ceil(now));
        }
    });
});

$('.cheque-info').hide();
$('.cash').hide();
$('.direct-deposit').hide();

function padDigits(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}


const get_jo = (cid) => {

    $('#jo-id').empty();
    $('#jo-id').append(' <option value="" selected="true" disabled="true">Select Category</option>')
        fetch('/job-order/bycat/'+cid)
            .then((res)=>res.json())
                .then((jo)=>{
                    console.log(jo);
                 jo.forEach(val => {
                     console.log(val.id);
                     $('#jo-id').append('<option value="'+val.id+'">'+val.customer+' / JO-'+padDigits(val.id,5)+'</option>');
                 });
                    // $('#jo-id').append('<option value=')
                }).catch((error)=>{
            console.log(error);
        })
    }

    const jo_details = (cid) => {
        fetch('/job-order/byid/'+cid)
            .then((res)=>res.json())
                .then((jo)=>{
                    console.log(jo.description);
                        $('#jo-desc').val(jo.description);
                        // $('#jo-amt').val(jo.amount);
                }).catch((error)=>{
            console.log(error);
        })

        fetch('/job-order/balance/'+cid)
            .then((res)=>res.json())
                .then((bal) => {
                    $('#jo-amt').val(bal);
                })
    }

$('#cat-id').on('change' ,(id)=>{

    const cid = id.target.value;
        get_jo(cid);
})

$('#jo-id').on('change', (id)=>{

    const jo_id = id.target.value;  
    jo_details(jo_id);
});

$('#payment-type').on('change',(id)=>{

    const type = id.target.value;

        $('.dem').val('');
        $('.ci').val('');
        $('.cheque-info').hide();
        $('.cash').hide();
        $('.direct-deposit').hide();
    
    if (type == '1') {
        $('.cash').show();
        $('#jo-paid').val('');
        $('#jo-paid').attr('readonly',true);
        $('#jo-paid').addClass('fblack');
        return;
    } 
    if (type == '2') {
        $('.cheque-info').show();
        $('#jo-paid').val('');
        $('#jo-paid').removeAttr('readonly');
        $('#jo-paid').removeClass('fblack');
        return;
    }
    if (type == 3) {
        $('.direct-deposit').show();
        $('#jo-paid').val('');
        $('#jo-paid').removeAttr('readonly');
        $('#jo-paid').removeClass('fblack');
    }
})

$('#make-payment').on('click', ()=>{
    
    const p_type = $('#payment-type').val();
    const desc = $('#jo-desc').val();
    const topaid = $('#jo-paid').val();

    if (topaid == '' || topaid == 0) {
        Swal.fire(
                'Error!',
                'Enter Amount To Paid',
                'error'
                );
                $('#jo-paid').focus();

                return;
    }

    if(desc == '' || desc == null){
        Swal.fire(
                'Error!',
                'The Select Job Order',
                'error'
                );
                return;
        }

        if(p_type == null || p_type == '' || p_type == '0'){
            Swal.fire(
                'Error!',
                'Please Select Payment Type',
                'error'
                );

                return;
           }

        if (p_type == '1') {
                
            if (topaid == 0) {
                Swal.fire(
                'Error!',
                'Enter Amount To Paid',
                'error'
                );
            } else {
                $('#form-jopayment').submit();
            }
            
        }

    if (p_type == '2') {
            const cheque = $('#cheque_no').val();
            const payee = $('#payee_name').val();

        if (cheque == '' || payee == '') {
            Swal.fire(
                'Error!',
                'The Field Fill Up Cheque Information',
                'error'
                );

                return;
        } else {

            
           if(p_type == null || p_type == '' || p_type == '0'){
            Swal.fire(
                'Error!',
                'Please Select Payment Type',
                'error'
                );
                return;
           }else{
            $('#form-jopayment').submit();
           }
        }
    }

    if (p_type == '3') {
            const bank = $('#bankname').val();
            
            if (bank == 0) {
                Swal.fire(
                'Error!',
                'Please Select Bank Account',
                'error'
                );
                return;
                
            } else {
                $('#form-jopayment').submit();
            }
    }

     

  
    
   
   

});

    $('.dem').on('keyup',()=>{

          get_total();
    })

        const get_total = () =>{

            var sum = 0;

                $(".dem").each(function(){
                   
                    if($(this).val() != "")
                    sum += (parseFloat($(this).val()) * parseFloat($(this).data("amount")));  
                });

            

                $('#jo-paid').val(sum.toFixed(2));
        }

const print_jo = (id)=>{

    const jid = id.value;

    location.href= '/job-orders/print/jo/'+jid;
}

const jopayment_details = (id)=>{

    const jsum = id.value;

    location.href = '/jo/details/'+jsum;

}

const jopayment_summary = (id)=>{

    const jo_id = id.value;

    location.href = '/jo/jopayment/summary/'+jo_id;

}

</script>


@endsection
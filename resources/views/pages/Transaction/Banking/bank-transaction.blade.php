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
</style>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Bank Records</h4>
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
                                    <h2><strong>List of Bank Transactions</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Payments')
                                    <button class="btn-hover btn-border-radius color-8" onclick="transmodal(this)" value="0" style="float:right;width:150px"><i data-feather="credit-card" style="height:15px"></i> <span>New Transaction</span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    @foreach ($bank_accounts as $bank)
                        

                    <div class="body">
                        <div class="table-responsive">
                        <h3><strong>{{$bank->bank}} | Account No: {{$bank->bank_account}}</strong></h3>
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr> 
                                        <th>Trans ID</th>
                                        <th>Transaction Date</th>
                                        <th>Transaction</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                        <th>Remarks</th>
                                      
                                        <th>Details</th>  
                                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($bank->banktransaction as $trans)
                                  <tr>
                                  <td class="text-center">{{$trans->id}}</td>
                                  <td class="text-center">{{$trans->transaction_date}}</td>
                                  <td class="text-center">{{$trans->trans_type == '1' ? 'Deposit' : 'Withdraw'}}</td>
                                  <td class="text-center">{{number_format($trans->amount,4)}}</td>
                                  <td class="text-center">{{number_format($trans->balance,4)}}</td>
                                  <td class="text-center">{{$trans->remarks}}</td>
                                
                                  <td class="text-center">
                                    <button type="button" onclick="transmodal(this)"
                                    value = "{{$trans->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons">credit_card</i>
                                    </button>
                                  </td>
                                
                                  </tr>                        
                                  @endforeach
                                </tbody>         
                            </table>
                        </div>
                    </div>
                    <hr>
                    @endforeach


                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
{{-- Modals --}}     
        <div class="modal fade" id="trans-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="trans-text">Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="form-trans">
                            @csrf
                           
                            <div class="form-group default-select">
                                <label for="bank">Select Bank</label>
                                     <select class="form-control select2" data-placeholder="Select" id="bankname" name="bankname">
                                        <option value="" selected="true" disabled="true">Select Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{$bank->bank}}">{{$bank->bank}}</option>
                                            @endforeach
                                    </select>
                                </div>

                              
                               
                                <div class="form-group default-select">
                                    <label for="transaction">Select Bank Account</label>
                                        <select class="form-control select2" data-placeholder="Select" id="bank-accounts" name="bank_accounts" required>
                                           <option value="" selected="true" disabled="true">Select Bank Account</option>
                                       </select>
                                </div>
                          

                                <div class="form-group default-select">
                                    <label for="transaction">Select Transaction</label>
                                        <select class="form-control select2" data-placeholder="Select" name="trans_type" id="trans_type" required>
                                            <option value="0" selected="true" disabled="true">Select Transaction</option>
                                            <option value="1">Deposit</option>
                                            <option value="2">Withdraw</option>

                                    </select>
                                </div>

                                <div class="hideable">
                                        <div class="form-group default-select">
                                                <label for="transaction">Transaction Terms</label>
                                                    <select class="form-control select2" data-placeholder="Select" id="trans_term" name="trans_term" required>
                                                        <option value="0" selected="true" disabled="true">Select Term</option>
                                                        <option value="1">Cash</option>
                                                        <option value="2">Cheque</option>
                                                </select>
                                            </div>
                                </div>


                                <div class="chequeinfo"> 
                                        <div class="form-group">
                                            <label for="chequeno">Cheque Number</label>
                                                <div class="form-line">
                                                    <input type="text" id="chequeno" name="chequeno" class="form-control" placeholder="Cheque Number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="chequeno">Payee Name</label>
                                                    <div class="form-line">
                                                        <input type="text" id="payee" name="payee" class="form-control" placeholder="Payee Name" value="">
                                                </div>
                                            </div>
                                </div>

                                        
                                <div class="form-group">
                                    <label for="transactiondate">Transaction Date</label>
                                    <div class="form-line">
                                        <input type="date" id="transactiondate" name="transactiondate" class="form-control" required>
                                    </div>
                                </div>

                                <label for="balance">Balance</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="balance" name="balance" class="form-control" placeholder="Balance" value="0" readonly>
                                    </div>
                                </div>

                                <label for="amount">Amount</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="amount" step="0.0001" name="amount" class="form-control" placeholder="Enter Amount" required>
                                    </div>
                                </div>
                                <label for="remarks">Remarks</label>
                                <div class="form-group">
                                    <div class="form-line">
                                         <textarea name="remarks" id="remarks" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="proceed-trans" class="btn btn-info waves-effect">Proceed</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-white" id="trans-text">Transaction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        <div class="modal-body">
                            <form action="#" method="post" id="trans-update">
                                @csrf
    
                                <input type="hidden" id="trans-id" name="trans_id" />

                                <div class="form-group">
                                        <label for="transactiondate">Transaction Date</label>
                                        <div class="form-line">
                                            <input type="date" id="u-transactiondate" name="transactiondate" class="form-control" required>
                                        </div>
                                    </div>

                                <div class="form-group default-select">
                                    <label for="bank">Select Bank</label>
                                         <select class="form-control select2" data-placeholder="Select" id="u-bankname" name="bankname">
                                            <option value="" selected="true" disabled="true">Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->bank}}">{{$bank->bank}}</option>
                                                @endforeach
                                        </select>
                                    </div>                  
                              
                                    
                                    <div class="hiddable">
                                            <div class="form-group">
                                                    <label for="acno">Account Number</label>
                                                        <div class="form-line">
                                                            <input type="text" id="acno" name="accno" class="form-control" placeholder="Account Number" value="" readonly>
                                                    </div>
                                                </div>
    
                                    </div>
    
                                    {{-- <div class="form-group">
                                        <label for="transaction">Select Transaction</label>
                                            <input  class="form-control" type="text" name="trans_type" id="u-trans_type" readonly>
                                    </div> --}}

                                    <div class="form-group default-select">
                                        <label for="transaction">Select Transaction</label>
                                            <select class="form-control select2" data-placeholder="Select" name="trans_type" id="u-trans_type" required>
                                                <option value="0" selected="true" disabled="true">Select Transaction</option>
                                                <option value="1">Deposit</option>
                                                <option value="2">Withdraw</option>
    
                                        </select>
                                    </div>
    
                                    <div class="hideable">
                                            <div class="form-group default-select">
                                                    <label for="transaction">Transaction Terms</label>
                                                        <select class="form-control select2" data-placeholder="Select" id="u-trans_term" name="trans_term" required readonly>
                                                            <option value="0" selected="true" disabled="true">Select Term</option>
                                                            <option value="1">Cash</option>
                                                            <option value="2">Cheque</option>
                                                    </select>
                                                </div>
                                    </div>
    
    
                                    <div class="chequeinfo"> 
                                            <div class="form-group">
                                                <label for="uchequeno">Cheque Number</label>
                                                    <div class="form-line">
                                                        <input type="text" id="uchequeno" name="chequeno" class="form-control" readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <label for="upayee">Payee Name</label>
                                                        <div class="form-line">
                                                            <input type="text" id="upayee" name="payee" class="form-control" readonly />
                                                    </div>
                                                </div>
                                    </div>
    
                                   
    
                                    <label for="amount">Amount</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="up-amount" step="0.0001" name="amount" class="form-control" placeholder="Enter Amount" required>
                                        </div>
                                    </div>
                                    <label for="remarks">Remarks</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                             <textarea name="remarks" id="up-remarks" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="u-proceed-trans" class="btn btn-info waves-effect">Proceed</button>
                        </form>
                        @role('admin')
                            <button type="button" id="trans-delete" class="btn btn-danger waves-effect">Delte</button>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>

<script>
window.onload = function () {
    $('.nav-transaction').click();
    $('.nav-banking').addClass('active');
    $('.nav-banktransactions').addClass('active');

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

    const clear_fields = ()=>{


    }


    

    // $('.hideable').hide();
    $('.chequeinfo').hide();
    $('.hiddable').hide();
    $('.bas').show();
    
    const bank_account = (bank)=>{  
        console.log(bank);    
        fetch('/banking/my-bankaccount/'+bank)
            .then((res) => res.json())
                .then((data)=>{
                    $('#bank-accounts').empty();
                    $('#bank-accounts').append('<option value="" selected="true">Select Bank Account</option>');
                data.forEach(element => {
                    $('#bank-accounts').append('<option value="'+element.id+'">'+element.bank_account+'</option>')
                    // console.log(element.bank_account);
                });
            }).catch((error)=>{
                console.log(error);
            })
    }

    const account_balance = (bid)=>{

        fetch('/banking/bankaccount/info/'+bid)
            .then((res) => res.json())
                .then((data)=>{
                   console.log(data.balance);
                   $('#balance').val(data.balance);
            }).catch((error)=>{
                console.log(error);
            })


    }


    $('#bankname').on('change', (id)=>{

        const bank = id.target.value;

        bank_account(bank);
            
    });

    $('#bank-accounts').on('change',(id)=>{

        const bid = id.target.value;

        account_balance(bid);
    })

    $('#trans_type').on('change', (id)=>{

        const trans = id.target.value;
        const balance = $('#balance').val();

        if (trans == '2' && balance == '0') {

            Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Insufficient Balance Please Deposit Amount',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })

                $('#trans_type').val('1');
                $('#amount').focus();
                 $('.hideable').show();
                 $('#trans_term').attr("required","true");
        }else{
            // $('.hideable').hide();
            $('#trans_term').attr("required","true");
            if (trans == '1') {

                $('.hideable').show();
                $('#trans_term').attr("required","true");
                
            }
        }

    });

    $('#trans_term').on('change',(id)=>{

        const term =  id.target.value;

        if (term == '2'){

            $('.chequeinfo').show();
            $('#chequeno').attr("required","true");
            $('#payee').attr("required","true");
            
        }else{

            $('.chequeinfo').hide();
            $('#chequeno').removeAttr("required","true");
            $('#payee').removeAttr("required","true");
        }
    })

    $('#proceed-trans').on('click', ()=>{
            
        const bank = $('#bankname').val();
        const bank_account = $('#bank-accounts').val();
        const trans_type = $('#trans_type').val();
        const transactiondate = $('#transactiondate').val();
        const bal = $('#balance').val();
        const amt = $('#amount').val();
        const remarks = $('#remarks').val();
        const trans_term = $('#trans_term').val();

        if (trans_term == '0' || trans_term == '') {

            Swal.fire({
                    type: 'error',
                    title: 'Select Transaction Term',
                    text: 'Please Select Cash / Cheque',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })

                    return;
        }   




        if (bank == null || bank == '') {
            
            Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Select Bank',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })

                    return;
        }

        console.log(bank_account);

        if (bank_account == null || bank_account == '') {
            
            Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Select Bank Account',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                    return;
        }

        if (trans_type == null || trans_type == '') {
            
            Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Select Transaction Type',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                    return;
        }



        if (transactiondate == null || transactiondate == '') {
            
            Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Select Transaction Date',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                    return;
        }

        if(trans_type > 0 || trans_type != null || trans_type != ''){
                
            if (trans_type == '2'){
                
                if (Number(amt) > Number(bal)) {
                    
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Insuficient Balance',
                    animation: false,
                    customClass: {
                        popup: 'animated rubberBand'
                    },
                    })
                    return;
                }else{
                    $('#form-trans').submit();

                }
            }else{
                $('#form-trans').submit();
            }
        }
    
       
        });


        const transmodal = (id)=>{

const trans = id.value;

$('#u-trans_term').on('change', (id)=>{

    const val = id.target.value;

    if (val == '2') {
        $('.chequeinfo').show();
    }else{
        $('.chequeinfo').hide();
    }

});

if (trans == '0') {

    $('#form-trans').attr('action','/banking/new-transaction');
    $('#trans-text').text('New Bank Transaction');
    $('#trans-modal').modal('show');
} else {
    
    $('#trans-id').val(trans);
    $('#trans-update').attr('action','/banking/update-transaction');
    $('#trans-text').text('Update Bank Transaction');
    $('.hiddable').show();
    $('.bas').hide();
    //fetch transaction..
        fetch('/bank/transaction-info/'+trans)
            .then((res) => res.json())
                .then((data) => {
                    console.log(data);
                    data.forEach(trans => {
                      
                        console.log(trans.bank_id);
                        $('#uchequeno').val(trans.cheque_no);
                        $('#upayee').val(trans.payee);
                        if (trans.term == '2') {
                                $('.chequeinfo').show();
                        }else{
                            $('.chequeinfo').hide();
                        }
                        $('#u-transactiondate').val(trans.transaction_date);
                        $('#u-bankname').val(trans.bank);
                        $('#u-bankname').trigger('change');

                        $('#acno').val(trans.bank_account);
                      
                        $('#u-trans_term').val(trans.term);
                        $('#u-trans_term').trigger('change');

                        $('#u-trans_type').select2("val",trans.trans_type);
                        $('#u-trans_type').change();

                        // if (trans.trans_type == '1') {
                        //       $('#u-trans_type').val('Deposit');
                        // } else {
                        //     $('#u-trans_type').val('Withdraw');
                        // } 
                      
                      

                        $('#up-amount').val(trans.amount);
                        $('#up-remarks').val(trans.remarks);

                      
                    });
                  
                   
                })
    $('#modal-update').modal('show');
}
}

$('#u-proceed-trans').on('click', ()=> {

    const amount = $('#up-amount').val();

    if (amount == null || amount == '0' || amount == NaN){

        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Please Enter Valid Amount',
        animation: false,
        customClass: {
            popup: 'animated rubberBand'
        },
        })
        return;
    }

    $('#trans-update').submit();


});

const makerequest = async (tid,url) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(tid),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch(url, settings);

  try {
    const data = await response.json();
    console.log(data);
   
  } catch (err) {
    throw err;
  }
};

$('#trans-delete').on('click',()=>{

    const id = $('#trans-id').val();

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
        confirmButtonText: 'Yes, Delete Transaction!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){
    
    const trans = {"trans_id":id};
    let url = '/transaction/remove/select';
    makerequest(trans,url);  
   setTimeout(function(){ location.href = '/bank-transactions'; }, 1500);
                }
            })
        }
    })
    
});
    
</script>

@endsection
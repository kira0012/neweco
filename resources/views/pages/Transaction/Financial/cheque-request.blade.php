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
                            <h4 class="page-title">Cheque Voucher</h4>
                        </li>
                    </ul>
                    @include('inc.message')
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
                                    <h2><strong>List of Request</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Payments')
                                    <button class="btn-hover btn-border-radius color-8"  onclick="newcheck()" style="float:right;width:160px"><i data-feather="aperture" style="height:15px"></i> <span>Cheque Request</span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date of Request</th>
                                        <th>Account Payee</th>
                                        <th>Amount</th>
                                        <th>Request By</th>
                                        <th>View</th>
                                        @can('Payments')
                                        <th>Action</th>
                                        @endcan
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rfcs as $rfc)
                                    <tr>
                                    <td class="text-center">{{$rfc->request_date}}</td>
                                    <td class="text-center">{{$rfc->payee}}</td>
                                    <td class="text-center">{{$rfc->amount}}</td>
                                    <td class="text-center">{{$rfc->name}}</td>
                                    
                                    <td class="text-center">
                                        <button type="button" onclick="voucher(this)"
                                            value = "{{$rfc->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">call_missed_outgoing</i>
                                        </button>

                                    </td>
                                    @can('Payments')
                                     <td class="text-center">
                                        <button type="button" onclick="voucher_update(this)"
                                            value = "{{$rfc->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">list</i>
                                        </button>
                                        |
                                        <button type="button" onclick="remove(this)"
                                        value = "{{$rfc->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                    </button>

                                    </td>
                                    @endcan
                                    </tr>
                                        
                                    @endforeach
                                       
                                       
                                </tbody>
                                
                            </table>
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
                                        <h2><strong>Processed Request</strong></h2>
                                </div>
                                <div class="col-lg-6">
                                   
                                </div>
                            </div>
                         
                        </div>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Date of Request</th>
                                            <th>Account Payee</th>
                                            <th>Amount</th>
                                            <th>Request By</th>
                                            <th>View</th>
            
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arfc as $rfc)
                                        @if ($rfc->status == 9)
                                        <tr class="text-danger">
                                                <td class="text-center">{{$rfc->request_date}}</td>
                                                <td class="text-center">{{$rfc->payee}}</td>
                                                <td class="text-center">{{$rfc->amount}}</td>
                                                <td class="text-center">{{$rfc->name}}</td>
                                                <td class="text-center">
                                                    <button type="button" onclick="voucher(this)"
                                                        value = "{{$rfc->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">call_missed_outgoing</i>
                                                    </button>
            
                                                </td>
                                                </tr>
                                        @else
                                        <tr>
                                                <td class="text-center">{{$rfc->request_date}}</td>
                                                <td class="text-center">{{$rfc->payee}}</td>
                                                <td class="text-center">{{$rfc->amount}}</td>
                                                <td class="text-center">{{$rfc->name}}</td>
                                                <td class="text-center">
                                                    <button type="button" onclick="voucher(this)"
                                                        value = "{{$rfc->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">call_missed_outgoing</i>
                                                    </button>
            
                                                </td>
                                                </tr>
                                        @endif
                                       
                                            
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
{{-- Modals --}}     
        <div class="modal fade" id="chequemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Cheque Voucher</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="form-cheque">
                            @csrf

                            <input type="hidden" name="vid" id="vid" />
                                <label for="rdate">Date</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="date" id="rdate" name="rdate" value = "{{$today}}" class="form-control" readonly>
                                    </div>
                                </div>

                            <label for="payee">Payee</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="payee" name="payee" placeholder="Payee" required>
                                    </div>
                                </div>

                                <label for="holder">Remarks/Patriculars</label>
                                <div class="form-group">
                                    <div class="form-line">
                                            <textarea name="remarks" id="remarks" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>

                                <label for="currency">Amount</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="number" id="amount" name="amount" placeholder="Amount" required>
                                    </div>
                                </div>

                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



<script>
        window.onload = function () {
            $('.nav-transaction').click();
            $('.nav-cheque').addClass('active');
            $('.nav-cheque-request').addClass('active');
        
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
    
    function view_transaction(id){

        const bank = id.value;

        location.href = 'banking/bank-transaction/'+bank;

    }

    const newcheck = () => {

        const url = '/new/chequest/request';
        $('#form-cheque').attr('action',url);
        $('#chequemodal').modal('show');

    }

    const voucher_update = (id) => {

        const vid = id.value;

        const url = '/new/chequest/update';
        $('#vid').val(vid);
        $('#form-cheque').attr('action',url);

        fetch('/cheque/details/'+vid)
            .then((res) => res.json())
                .then((data) => {

                    console.log(data);

                    $('#vid').val(data.id);
                    $('#payee').val(data.payee);
                    $('#rdate').val(data.request_date);
                    $('#remarks').val(data.remarks);
                    $('#amount').val(data.amount);
                });
        $('#chequemodal').modal('show');
        
    }


    const voucher = (id)=>{

        const rfc_id = id.value;

        location.href = '/cheque/voucher/'+rfc_id;

    }


    const remove = (id)=>{

        const vid = id.value;
        

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
        confirmButtonText: 'Yes, Delete Cheque Request!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){
    
                const req = {"vid":vid};
                removerequest(req);  
                setTimeout(function(){ location.href = '/checque-request'; }, 1500);
                 }
            })
        }
    })  
    }

    const removerequest = async (req) => {
        const url = '/check/remove';
        const settings = {
            method: 'POST',
            body: JSON.stringify(req),
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
</script>

@endsection
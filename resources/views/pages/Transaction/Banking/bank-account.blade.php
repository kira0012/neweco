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
                                    <h2><strong>List of Bank Accounts</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Payments')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right;width:160px"><i data-feather="aperture" style="height:15px"></i> <span>Add Bank Account </span></button>
                                @endcan
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable center">
                                <thead>
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Bank Account No</th>
                                        <th>Account Holder's Name</th>
                                        <th>Currency</th>
                                        <th>Balance</th>
                                        {{-- <th>Transaction</th> --}}
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($banks as $bank)
                                            <tr>
                                            <td class="text-center">{{$bank->bank}}</td>
                                            <td class="text-center">{{$bank->bank_account}}</td>
                                            <td class="text-center">{{$bank->bank_holder}}</td>
                                            <td class="text-center">{{$bank->currency}}</td>
                                            <td class="text-center">{{number_format($bank->balance,4)}}</td>
                                            {{-- <td class="text-center">
                                                    <button type="button" onclick="view_transaction(this)"
                                                    value = "{{$bank->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">credit_card</i>
                                                    </button>
                                            </td> --}}
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
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Bank Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/banking/add/bank-account" method="post">
                            @csrf
                                <label for="bankname">Bank Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="bankname" name="bankname" class="form-control" placeholder="Enter Bank Name" required>
                                    </div>
                                </div>

                            <label for="bankaccount">Bank Account No</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="bankaccount" name="bankaccount" placeholder="Bank Account" required>
                                    </div>
                                </div>

                                <label for="holder">Account Holder Nname</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="holder" name="holder" placeholder="Account Holder Name" required>
                                    </div>
                                </div>

                                <label for="currency">Currency</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control"  type="text" id="currency" name="currency" placeholder="Bank Account" required>
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
            $('.nav-banking').addClass('active');
            $('.nav-bankaccounts').addClass('active');
        
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
</script>

@endsection
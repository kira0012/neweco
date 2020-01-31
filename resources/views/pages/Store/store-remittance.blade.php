@extends('layouts.template')
@section('htmlhead')
  
@endsection
<style>
.modal-header{
    background-color: #007bff;
}
.mcontent{

    margin-left: -20px;
    margin-right: -20px;
}
#imgp{

    width: 350px;
    height: 350px;
}

#p-imgp{
    width: 350px;
    height: 350px;

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
                            <h4 class="page-title">Eco Group Branch Remittances</h4>
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
                                    <h2><strong>List of Store Remittances</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  onclick="modalloader(this)" value="0" style="float:right; width:150px;"><i data-feather="box" style="height:15px"></i> <span>New Remittance</span></button>
                            </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Remit ID</th>
                                        <th>Store Name</th>
                                        <th>Date of Remittance</th>
                                        <th>Recieved By</th>
                                        <th>Amount</th>
                                        @role('admin')
                                        <th>Details</th>
                                        @endrole
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                        <td class="text-center">RT-{{str_pad($record->id,6,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center">{{$record->store_name}}</td>
                                        <td class="text-center">{{$record->remittance_date}}</td>
                                        <td class="text-center">{{$record->name}}</td>
                                        <td class="text-center">{{number_format($record->amount,2)}}</td>
                                            @role('admin')
                                        <td class="text-center">

                                                <button type="button" onclick="modalloader(this)"
                                                value = "{{$record->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">list</i>
                                                </button> 
                                        </td>
                                        @endrole

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
 
{{-- MOdals --}}
         
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="store-modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="Modallabel">New Store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="#" method="post" id="store-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="remit-id" name="remit_id" value="" />

                                        <div class="form-group">
                                            <label for="store-location">Remittance Date</label>
                                                <div class="form-line">
                                                <input class="form-control" type="date" id="remit-date" name="remit_date" value="{{$today}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group default-select">
                                                <label>Select Store</label>
                                                    <select class="form-control select2" data-placeholder="Select Store" id = "store" name="store_id" required>
                                                        
                                                        <option value="0" disabled="true"></option>
                                                        @foreach ($stores as $store)
                                                    <option value="{{$store->id}}">{{$store->store_name}} | {{$store->store_location}}</option>
                                                        @endforeach
                                                            
                                                    </select>     
                                            </div>
                                            

                                              <div class="form-group">
                                                    <label for="store-location">Amount</label>
                                                      <div class="form-line">
                                                          <input class="form-control"  type="number" id="remit-amt" step="0.1"  name="remit_amt" placeholder="Amount" required>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                        <label for="remit-remarks">Remarks</label>
                                                          <div class="form-line">
                                                              <input class="form-control"  type="text" id="remit-remarks" name="remarks" placeholder="remarks" >
                                                          </div>
                                                      </div>




                            

                                        <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="store" style="height:15px"></i> <span>Save</span></button>
                                 

                                </form>
                             </div>
                        </div>
                    </div>
                </div>



{{-- end Modal --}}

                                <script>
                                        window.onload = function () {
                                            $('.nav-transaction').click();
                                            $('.nav-remittance').addClass('active');
                                          
                                            $('.nav-remittance-list').addClass('active');
                                            $('.dashboard').removeClass('active');
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
      function imgpreview(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {           
                    $('#imgp').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        const clear_fields = () => {
            $('#remit-id').val('')
            $('#remit-date').val('');
            $('#store').select2("val",'0');
            $('#remit-amt').val('');
            $('#remit-remarks').val('');

        }


        const modalloader = (id)=>{

            const action = id.value;
            clear_fields();
                if (action == '0') {

                    $('#Modallabel').text('New Remittance');
                    $('#store-modal').modal('show');
                    $('#store-form').attr('action','/Branch/New/Remittance');

                }else {

                        fetch('/Branch/Remittance-info/'+action)
                            .then((res) => res.json())
                                .then((data) => {

                                    console.log(data.amount);
                                    

                                    $('#store-modal').modal('show');
                                    $('#store-form').attr('action','/Branch/update/remittance');

                                    $('#Modallabel').text('Update Remittance');

                                    $('#remit-id').val(action);

                                    $('#remit-date').val(data.remittance_date);
                                    $('#store').select2("val",data.store_id);
                                    $('#remit-amt').val(data.amount);
                                    $('#remit-remarks').val(data.remarks);

                            
                                })

                }
        }    
</script>

@endsection
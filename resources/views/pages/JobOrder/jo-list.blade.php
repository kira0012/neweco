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
                            <h4 class="page-title">Job Orders</h4>
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
                                <h2><strong>List of Job Order</strong></h2>
                        </div>
                        <div class="col-lg-6">
                                @can('Customers')
                                <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Add J.O</span></button>
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
                                <th>Category</th>
                                <th>Descripton</th>
                                <th>Amount</th>
                                <th>Cost</th>
                                <th>Paided</th>
                                <th>Jo Date</th>
                                <th>Status</th>
                                @can('Customers')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($jos as $jo)
                                @if ($jo->job_transaction->sum('amount') == $jo->amount)
                                    <tr class="text-success">
                                @else
                                    <tr>
                         @endif
                                    <td class="text-center">JO-{{str_pad($jo->id,5,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center" style="width:200px;">{{$jo->category}}</td>
                                    <td class="text-center" style="width:200px;">{{$jo->description}}</td>
                                    <td class="text-center"><b>{{number_format($jo->amount,2)}}</b></td>
                                    <td class="text-center"><b>{{number_format($jo->cost,2)}}</b></td>
                                    <td class="text-center"><b>{{number_format($jo->job_transaction->sum('amount'),2)}}</b></td>
                                    <td class="text-center">{{$jo->jo_date}}</td>
                                    @switch($jo->status)
                                        @case(1)
                                        <td class="text-center">Ongoing</td>
                                            @break
                                        @case(2)
                                        <td class="text-center">Packaging</td>
                                            @break
                                        @default
                                        <td class="text-center">Pending</td>
                                    @endswitch
                                  
                                    @can('Customers')
                                    <td class="text-center">
                                        <button type="button" onclick="update_jo(this)"
                                        value = "{{$jo->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
                                        </button> | 
                                        <button type="button" onclick="delete_jo(this)"
                                        value = "{{$jo->id}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
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
    <!-- #END# Exportable Table -->
</div>
</section>





<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Job Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form action="/job-order/new/jo" method="post">
                        @csrf
                            <div class="form-group">
                             <label for="bankname">JO Date</label>
                                <div class="form-line">
                                <input type="date" name="jo_date" class="form-control" value="{{$today}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jo-customer">Customer Name</label>
                                   <div class="form-line">
                                       <input type="text" name="jo_customer" class="form-control" placeholder="Customer Name" required>
                                   </div>
                               </div>

                            <div class="form-group default-select">
                                    <label for="jo-cat">Category</label>
                                        <select class="form-control select2" data-placeholder="Select"  name="jo_cat" required>
                                            <option value="" selected="true" disabled="true">Select Category</option>
                                            @foreach ($jocats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category}}</option>
                                            @endforeach
                                           
                                    </select>
                                </div>

        
                            <div class="form-group">
                                <label for="description">Job Details</label>
                                    <div class="form-line">
                                        <textarea class="form-control"  name="description" cols="10" rows="10" value="" required></textarea> 
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="amount">Amount</label>
                                       <div class="form-line">
                                           <input type="number" step="0.0001" name="jo_amount" class="form-control" placeholder="0" required>
                                       </div>
                                   </div>

                                   <div class="form-group">
                                    <label for="amount">Cost</label>
                                       <div class="form-line">
                                           <input type="number" step="0.0001"  name="jo_cost" min="0" class="form-control" placeholder="0" required>
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


{{-- Update Modal --}}




<div class="modal fade" id="m-joupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update Job Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form action="/job-order/update/jo" method="post">
                        @csrf
                           <input type="hidden" id="jo-id" name="jo_id" value="" />
                            <div class="form-group">
                             <label for="bankname">JO Date</label>
                                <div class="form-line">
                                <input type="date" name="jo_date" class="form-control" id="jo-date" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jo-customer">Customer Name</label>
                                   <div class="form-line">
                                       <input type="text" id="jo-customer"  name="jo_customer" class="form-control" placeholder="Customer Name" required>
                                   </div>
                               </div>

                            <div class="form-group default-select">
                                    <label for="jo-cat">Category</label>
                                        <select class="form-control select2" data-placeholder="Select" id="jo-cat" name="jo_cat" required>
                                            <option value="" selected="true" disabled="true">Select Category</option>
                                            @foreach ($jocats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->category}}</option>
                                            @endforeach
                                           
                                    </select>
                                </div>

        
                            <div class="form-group">
                                <label for="description">Job Details</label>
                                    <div class="form-line">
                                        <textarea class="form-control" id="jo-description" name="description" cols="10" rows="10" value="" required></textarea> 
                                </div>
                            </div>

                            <div class="form-group default-select">
                                    <label for="jo-cat">Status</label>
                                        <select class="form-control select2" data-placeholder="Select" id="jo-status" name="jo_status" required>
                                            <option value="" selected="true" disabled="true">JO Status</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Ongoing</option>
                                            <option value="2">Packaging</option>
                                            <option value="3">DONE</option>
                                           
                                           
                                    </select>
                                </div>

                            <div class="form-group">
                                    <label for="amount">Amount</label>
                                       <div class="form-line">
                                           <input type="number" id="jo-amount"  name="jo_amount" min="0" class="form-control" placeholder="0" required>
                                       </div>
                                   </div>

                                   <div class="form-group">
                                    <label for="amount">Cost</label>
                                       <div class="form-line">
                                           <input type="number" id="jo-cost"  name="jo_cost" min="0" class="form-control" placeholder="0" required>
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
                    $('.nav-job').click();
                    $('.nav-jo-list').addClass('active');
                   // $('.nav-order-payment').addClass('active');
                
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
{{-- <script src="{{asset('assets/js/myjs/Transactions/order-payment.js')}}"></script> --}}
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


const update_jo = (id) => {

    const jid = id.value;

        fetch('/job-order/byid/'+jid)
            .then((res)=>res.json())
                .then((jo)=>{
                    console.log(jo);
                    $('#m-joupdate').modal('show');     
                        $('#jo-id').val(jo.id);
                        $('#jo-customer').val(jo.customer);              
                        $('#jo-date').val(jo.jo_date);
                        $('#jo-cat').select2("val",jo.cat_id);
                        $('#jo-description').val(jo.description);
                        $('#jo-amount').val(jo.amount);
                        $('#jo-cost').val(jo.cost);
                        $('#jo-status').select2("val",jo.status);
                        $('#jo-status').change();
                }).catch((error)=>{
            console.log(error);
        })

        }


const delete_jo = (id) =>{

            const jid = id.value;

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
        confirmButtonText: 'Yes, Remove it!'
        }).then((result) => {
        if (result.value) {
            
            console.log(jid);

                $.get('/job-order/delete/'+jid,(data)=>{

                    if (data == '1') {
                         Swal.fire(
                                'Deleted!',
                                'Selected Job Order has been Removed.',
                                'success'
                                ).then( ()=>{
                                    location.reload();
                                })
                    } else {
                        Swal.fire(
                                'Error!',
                                'This Record cannot be delete please contact your system administrator',
                                'error'
                                ).then( ()=>{
                                    console.log(data);
                                })
                        
                    }
                    
                })
            }
        })
}

</script>


@endsection
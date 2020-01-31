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
/* #imgp{

    width: 350px;
    height: 280px;
} */
</style>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Transfer Stock</h4>
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
                                    <h2><strong>List of Stock</strong></h2>
                                    
                            </div>
                            <div class="col-lg-6">
                                @can('Inventory')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right;width:150px;"><i data-feather="truck" style="height:15px"></i> <span>Transfer Stock</span></button>
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
                                        <th>Stock ID</th>
                                        <th>Stock Code</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Warehouse</th>
                                        <th>On Hand</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mystocks as $mystock)
                                    <tr>
                                    <td class="text-center">ST-{{str_pad($mystock->id,8,"0",STR_PAD_LEFT)}}</td>
                                    <td class="text-center">{{$mystock->product_code}}</td>
                                    <td class="text-center">{{$mystock->product_name}}</td>
                                    <td class="text-center">{{$mystock->description}}</td>
                                    <td class="text-center">{{$mystock->warehouse_name}}</td>
                                    <td class="text-center">{{$mystock->stock}}</td>
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


<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style">
                            <li>
                                <h4 class="page-title">Transfer Ticket</h4>
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
                                        <h2><strong>List of Tickets</strong></h2>
                                        
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
                                        <tr>
                                            <th>Transfer Ticket</th>
                                            <th>Transfer Date</th>
                                            <th>Product Code</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Recieved</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transfer_tickets as $ticket)
                                        <tr>
                                        <td class="text-center">T-{{str_pad($ticket->id,8,"0",STR_PAD_LEFT)}}</td>
                                        <td class="text-center">{{$ticket->transfer_date}}</td>
                                        <td class="text-center">{{$ticket->product_code}}</td>
                                        <td class="text-center">{{$ticket->description}}</td>
                                        <td class="text-center">{{$ticket->no_transfer}}</td>
                                        <td class="text-center"><button type="button" onclick="recieve_stock(this)"
                                            value = "{{$ticket->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">call_missed_outgoing</i>
                                            </button></td>

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
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Transfer Stock</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/transfer/mystock" method="post" id="form-transfer">

                            @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="available">Date Transfer</label>
                                            <div class="form-line">
                                            <input type="date" name="transfer_date" value="{{$today}}" class="form-control" required>
                                             </div>
                                        </div>
                                </div>
                                <div class="form-group default-select">
                                    <label for="unit">Select Warehouse</label>
                                        <select class="form-control select2" data-placeholder="Select" id="from-warehouse" name="from-warehouse">
                                           <option value="0" selected="true" disabled="true">Select Warehouse</option>
                                           @foreach ($Warehouse as $wr)
                                             <option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>   
                                           @endforeach
                                          
                                       </select>
                                   </div>
                                   <div class="form-group default-select">
                                        <label for="product">Select Product</label>
                                            <select class="form-control select2" data-placeholder="Select" id="w-products" name="product_id">
                                               <option value="0" selected="true" disabled="true"></option>
                                               
                                           </select>
                                       </div>
                                       <div class="form-group default-select">
                                            <label for="unit">Select Stock</label>
                                                <select class="form-control select2" data-placeholder="Select" id="p-stock" name="stock_id">
                                                   <option value="" selected="true" disabled="true"></option>
                                                   
                                               </select>
                                           </div>
                                           <div class="row">
                                               <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="available">Available Stock</label>
                                                            <div class="form-line">
                                                                    <input type="text" id="available-stock" name="available" value="" class="form-control" >
                                                                </div>
                                                            </div>
                                                        </div>
                                               <div class="col-lg-6">
                                                    <div class="form-group">
                                                            <label for="available"> Stock</label>
                                                                <div class="form-line">
                                                                        <input type="text" id="stock-transfer" name="no_transfer" value="" class="form-control" required>
                                                                    </div>
                                                                </div>

                                               </div>
                                           </div>

                                           <div class="form-group default-select">
                                                <label for="unit">Transfer To</label>
                                                    <select class="form-control select2" data-placeholder="Select" id="transfer-to" name="transfer-to" required>
                                                        <option value=""></option>
                                                            @foreach ($Warehouse as $wr)
                                                            <option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>   
                                                          @endforeach
                                                   </select>
                                               </div>

                            

                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="to-send" class="btn btn-info waves-effect">Transfer Stock</button>
                    </form>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalrecieve" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Recieve Transfer Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        <div class="modal-body">
                            <form action="#" method="post">
                                @csrf    
                                <input type="hidden" value="" id="ticket-id" name="ticket_id" />
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="available">Recieve Date</label>
                                            <div class="form-line">
                                            <input type="date" name="transfer_date" value="{{$today}}" class="form-control" required>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="available">Product Code</label>
                                            <div class="form-line">
                                        <input type="text" id="product-code" name="product_code" class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="available">Product Description</label>
                                            <div class="form-line">
                                        <input type="text" id="pr-description" name="description"  class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="available">Product Quantity</label>
                                                <div class="form-line">
                                            <input type="text" id="pr-qty" name="quantity"  class="form-control" required readonly>
                                        </div>
                                    </div>
                            
    
                           
                        
                        <div class="modal-footer">
                            <button type="button" id="to-send" class="btn btn-info waves-effect">Recieve Stock</button>
                        </form>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                    window.onload = function () {
                        $('.nav-inventory').click();
                        $('.nav-warehouse-inventory').addClass('active');
                        $('.nav-transfer-stock').addClass('active');
                    
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
<script src="{{asset('assets/js/myjs/warehouse/transfer-stock.js')}}"></script>
<script>
    

</script>

@endsection
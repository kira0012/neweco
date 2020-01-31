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
                            <h4 class="page-title">Expenses</h4>
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
                                    <h2><strong>Expenses Categories</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @can('Payments')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target="#exampleModalCenter" style="float:right"><i data-feather="aperture" style="height:15px"></i> <span>Add Category </span></button>
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
                                        <th>Expenses</th>
                                        <th>Description</th>
                                        <th>EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                    <td id="exp-{{$category->id}}" class="text-center">{{$category->expenses}}</td>
                                    <td id="des-{{$category->id}}" class="text-center">{{$category->description}}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="update_cat(this)"
                                        value = "{{$category->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">list</i>
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
{{-- Modals --}}     
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Expense Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <div class="modal-body">
                        <form action="/expenses/add/expense-category" method="post">
                            @csrf
                                <label for="bankname">Expense Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  name="expenses" class="form-control" placeholder="Expense Title" required>
                                    </div>
                                </div>

            
                                <div class="form-group">
                                    <label for="description">Description</label>
                                        <div class="form-line">
                                            <textarea class="form-control" name="description" cols="10" rows="10" value="" required>    </textarea> 
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

        <div class="modal fade" id="update-cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update Expense Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        <div class="modal-body">
                            <form action="/expenses/update/expense-category" method="post">
                                @csrf
                                    <input type="hidden" id="cat-id" name="cat_id" value="" >
                                    <label for="bankname">Expense Title</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="expenses" name="expenses" class="form-control" placeholder="Expense Title" required>
                                        </div>
                                    </div>
    
                
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                            <div class="form-line">
                                                <textarea class="form-control" name="description" id="description" cols="10" rows="10" value="" required></textarea> 
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
            $('.nav-expenses').addClass('active');
            $('.nav-expensecat').addClass('active');
        
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

    function update_cat(id){

        const cid = id.value;

        const cat = $('#exp-'+cid).text();
        const description = $('#des-'+cid).text();

        $('#cat-id').val(cid);
        $('#expenses').val(cat);
        $('#description').val(description);
        $('#update-cat').modal('show');
    }
   
</script>

@endsection
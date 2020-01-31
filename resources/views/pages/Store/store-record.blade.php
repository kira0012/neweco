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
                            <h4 class="page-title">Eco Group Branches</h4>
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
                                    <h2><strong>List of Stores</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                    <button class="btn-hover btn-border-radius color-8"  onclick="modalloader(this)" value="0" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Add Store</span></button>
                            </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Store Name</th>
                                        <th>Location</th>
                                        <th>Store Head</th>
                                        <th>Details</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($stores as $store)
                                        <tr>
                                        <td class="text-center">{{$store->store_name}}</td>
                                        <td class="text-center">{{$store->store_location}}</td>
                                        <td class="text-center">{{$store->store_head}}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="modalloader(this)"
                                            value = "{{$store->id}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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
                                <input type="hidden" id="store-id" name="store_id" value="" />
                                <div class="form-group">
                                    <label for="store-name">Store Name</label>
                                        <div class="form-line">
                                            <input class="form-control"  type="text" id="store-name" name="eco_store" placeholder="Store Name" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="store-location">Store Location</label>
                                            <div class="form-line">
                                                <input class="form-control"  type="text" id="store-location" name="location" placeholder="Store Name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="store-head">Store Head</label>
                                            <div class="form-line">
                                                <input class="form-control"  type="text" id="store-head" name="store_head" placeholder="Store Head" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="details">Details</label>
                                                <textarea class="form-control" id="details" name="details" cols="30" rows="10"></textarea>
                                        </div>
                                        {{-- For More Data if requested! place here! --}}

                                        <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="store" style="height:15px"></i> <span>Save Store </span></button>
                                 

                                </form>
                             </div>
                        </div>
                    </div>
                </div>



{{-- end Modal --}}

                                <script>
                                        window.onload = function () {
                                            $('.nav-records').click();
                                            $('.nav-records-financial').click();
                                            $('.nav-branch-store').addClass('active');

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
            $('#store-id').val('')
            $('#store-name').val('');
            $('#store-location').val('');
            $('#store-head').val('');
            $('#details').val('');

        }


        const modalloader = (id)=>{

            const action = id.value;
            clear_fields();
                if (action == '0') {

                    $('#Modallabel').text('New Store');
                    $('#store-modal').modal('show');
                    $('#store-form').attr('action','/Branch/new/store');

                }else {

                        fetch('/Branch/store-info/'+action)
                            .then((res) => res.json())
                                .then((data) => {

                                    // console.log(data.store_name);
                                    

                                    $('#store-modal').modal('show');
                                    $('#store-form').attr('action','/Branch/update/store');

                                    $('#Modallabel').text('Update Store');
                                    $('#store-id').val(action);
                                    $('#store-name').val(data.store_name);
                                    $('#store-location').val(data.store_location);
                                    $('#store-head').val(data.store_head);
                                    $('#details').val(data.Details);
                                })

                }
        }    
</script>

@endsection
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
</style>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Users Records</h4>
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
                                    <h2><strong>List of Users</strong></h2>
                            </div>
                            <div class="col-lg-6">
                                @role('admin')
                                    <button class="btn-hover btn-border-radius color-8"  data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right"><i data-feather="user-plus" style="height:20px"></i> <span>Add Users </span></button>
                                @endrole
                                </div>
                        </div>
                     
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Profile</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                
                                      @foreach ($users as $user)
                                      <tr>
                                        <td class="text-center">{{$user->name}}</td>
                                        <td class="text-center">{{$user->username}}</td>
                                        <td class="text-center">{{$user->email}}</td>
                                        <td class="text-center">{{$user->con_number}}</td>
                                        <td class="text-center">
                                            {{-- <a type="button" href="users/profile/{{$user->id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">call_missed_outgoing</i>
                                        </a> --}}
                                        @role('admin')
                                    <button type="button" onclick="userprofile(this)" value="{{$user->id}}"
                                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">call_missed_outgoing</i>
                                        </button>
                                        @endrole
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
         
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                        <div class="modal-header text-white">
                            <h5 class="modal-title" id="myLargeModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-content">
                            <div class="modal-body">
                                    <form action="/user/new/users" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                    <label for="name">Name</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                                        </div>
                                                    </div>
                                                <label for="email">Email</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="email" id="email" name="email" placeholder="Email Address" required>
                                                    </div>
                                                </div>
                                                <label for="con">Contact Number</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" id="con" name="con_num" class="form-control" placeholder="Contact Number" required>
                                                    </div>
                                                </div>
                                            <label for="username">Username</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="username" name="username" class="form-control" placeholder="username"required>
                                                    </div>
                                                </div>
                                                <label for="password">Password</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control"  type="password" minlength="6" id="password" name="password" placeholder="Password"required>
                                                    </div>
                                                </div>
                                              
                                                <div class="form-group default-select">
                                                    @role('admin')
                                                        <label>Role</label>
                                                        <select class="form-control select2" data-placeholder="Select" name="role">
                                                                <option></option>
                                                                <option value="1">Admin</option>
                                                            </select>
                                                    @endrole
                                                    
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="col-lg 6">
                                            <img id="imgp" src = "{{asset('assets/images/avatar.png')}}" alt="image"/>
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>Select Image</span>
                                                        <input type="file" id = "productimage" name="productimage" onchange="imgpreview(this);">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>

                                               
                                                   
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-10" data-dismiss="modal" aria-label="Close" style="float:right"><i data-feather="delete" style="height:15px"></i> <span>Cancel </span></button>
                                                            </div>
                                                        <div class="col-lg-6">
                                                                <button class="btn-hover btn-border-radius color-8" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Save </span></button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </form>
                                  
                             </div>
                   
                    </div>
                </div>
            </div>
        </div>

        <script>
                window.onload = function () {
                    $('.nav-records').click();
                    // $('.nav-shippment').click();
                    // $('.nav-ship-orders').addClass('active');
                    $('.nav-r-users').addClass('active');
                
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

// function post(path, parameters) {
//     var form = $('<form></form>');

//     form.attr("method", "post");
//     form.attr("action", path);
//     form.append('@csrf');
//     $.each(parameters, function(key, value) {
//         var field = $('<input></input>');

//         field.attr("type", "hidden");
//         field.attr("name", key);
//         field.attr("value", value);

//         form.append(field);
//     });

//     // The form needs to be a part of the document in
//     // order for us to be able to submit it.
//     $(document.body).append(form);
//     form.submit();
// }


//         const userprofile = (id)=>{

//             const uid = id.value;

//             const url = '/users/profile/myinfo';
//             const parameters = {'uid':uid};
//             post(url, parameters);

//             // fetch('/users/profile/myinfo',{  
//             //     method: 'POST',  
//             //     headers: {
//             //         'Content-Type': 'application/json',
//             //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             //         },
//             //         body: JSON.stringify({
//             //         uid: uid,
//             //      })
//             // }).then((data)=>{
//             //     //window.location('/users/profile/myinfo');
//             //     console.log(data);
//             // })

            
//         }
</script>

@endsection
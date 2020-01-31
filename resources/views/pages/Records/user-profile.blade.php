@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
{{-- <link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> --}}
    
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

    width: 100%px;
    height: 250px;
}

.p-header{

    background-color: #343d45;
    height: 150px;
    width: 100%;
}

#profile-img{
    margin-top: -75px;
    height: 150px;
    width: 100%;
    border-radius: 50%;
    padding-right: 10px;
    padding-left: 10px;

}
.u-dt{

    margin-top: 20px;
    text-align: center;
}

.invent{ background-color: #ff9600 !important; }
.invent i{ color: white !important; }

.custmr{ background-color: #28a745 !important; }
.custmr i{ color: white !important; }

.pyment{ background-color: #007bff !important; }
.pyment i{ color: white !important; }

.reprts{ background-color: #dc3545 !important; }
.reprts i{ color: white !important; }


</style>
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li>
                            <h4 class="page-title">Users Profile</h4>
                        </li>
                    </ul>
                    @include('inc.message')    
                </div>
            </div>
        </div>
        <!-- Exportable Table -->
       <div class="row">
           <div class="col-lg-3">
               <div class="row">
                   <div class="col-lg-12 p-header">

                   </div>
                   <div class="col-lg-12">
                        <img src="{{asset($user->profile)}}" alt="" id="profile-img">
                    </div>
                    <div class="col-lg-12 u-dt">
                    <hr>
                    
                    <h5>Name: {{$user->name}}</h5>
                    <h5>Email: {{$user->email}}</h5>
                    <h5>Contact: {{$user->con_number}}</h5>
                    </div>
                    
               </div>
           </div>
           <div class="col-lg-9">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                                <a href="#home_animation_1" data-toggle="tab" class="active show"> User Details</a>
                            </li>
                            <li role="presentation">
                                <a href="#profile_animation_1" data-toggle="tab"> Update Password </a>
                            </li>
                            @role('admin')
                          <li role="presentation">
                                <a href="#userroles" data-toggle="tab"> User Role/Permision </a>
                            </li>
                            @endrole
                              {{-- 
                            <li role="presentation">
                                <a href="#settings_animation_1" data-toggle="tab"> SETTINGS </a>
                            </li> --}}
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane animated flipInX active show" id="home_animation_1">
                                    <div class="row">
                                           
                                        <div class="col-lg-6">
                                        <form action="/user/update/details" method="post" enctype="multipart/form-data" id="update-user">
                                            @csrf
                                              <input type="hidden" value = "{{$user->id}}" name="uid">
                                                <label for="name">Name</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control" placeholder="Name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <div class="form-line">
                                                        <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control" placeholder="Username" required>
                                                        </div>
                                                    </div>

                                                <label for="email">Email</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                    <input class="form-control"  type="email" id="email" name="email" value="{{$user->email}}" placeholder="Email Address" required>
                                                    </div>
                                                </div>
                                                <label for="con">Contact Number</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                    <input type="number" id="con" name="con_num"  value="{{$user->con_number}}" class="form-control" placeholder="Contact Number">
                                                    </div>
                                                </div>
                                                <button class="btn-hover btn-border-radius color-8" type="button" style="float:right" id="save-user"><i data-feather="box" style="height:15px"></i><span>Update</span></button>
                                                      
                                            </form>
                                            </div>
                                           
                                     </div>
                        </div>
                            <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">

                                <div class="row">
                                    <div class="col-lg-6">
                                            <form action="/user/update/password" method="post" enctype="multipart/form-data" id="update-pass">
                                                @csrf
                                                <input type="hidden" value = "{{$user->id}}" name="uid">
                                                
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <div class="form-line">
                                                            <input type="password" minlength="6" id="cpassword" name="cpassword" value="" class="form-control" placeholder="Password" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="password">Confirm Password</label>
                                                            <div class="form-line">
                                                                <input type="password" minlength="6" id="rpassword" value="" class="form-control" placeholder="Password" required>
                                                            </div>
                                                        </div>

                                                        <button class="btn-hover btn-border-radius color-8" type="button" style="float:right" id="save-pass"><i data-feather="box" style="height:15px"></i><span>Save</span></button>
                                                      
                                            </form>
                                    </div>
                                </div>
                            </div>
                            @role('admin')
                            <div role="tabpanel" class="tab-pane animated flipInX" id="userroles">
                                <div class="row">
                                            <div class="container">
                                                <div class="row">
                                                    <input type="hidden" value = "{{$user->id}}" id="uid">
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="pricingTable">
                                                            <div class="pricingTable-header" id="h-inventory">
                                                                <i class="material-icons">assessment</i>   
                                                            </div>
                                                            <h3 class="heading">Inventory</h3>
                                                            <div class="pricingTable-signup">
                                                                    <button type="button" class="btn btn-warning btn-border-radius waves-effect" onclick="assignedpermission(this)" value="1">Assigned</button>
                                                                    <br/>
                                                                    <br/>
                                                                    <button type="button"  class="btn btn-default btn-border-radius waves-effect" onclick="revokepermission(this)" value="1">Revoke</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="pricingTable greenColor">
                                                            <div class="pricingTable-header" id="h-customer">
                                                                <i class="material-icons">local_mall</i>
                                                                
                                                            </div>
                                                            <h3 class="heading">Customer</h3>
                                                            <div class="pricingTable-signup">
                                                                    <button type="button" class="btn btn-success btn-border-radius waves-effect" onclick="assignedpermission(this)" value="2">Assigned</button>
                                                                    <br/>
                                                                    <br/>
                                                                    <button type="button"  class="btn btn-default btn-border-radius waves-effect" onclick="revokepermission(this)" value="2">Revoke</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="pricingTable blueColor">
                                                            <div class="pricingTable-header" id="h-payment">
                                                                <i class="material-icons">account_balance_wallet</i>
                                                            </div>
                                                            <h3 class="heading">Payments</h3>  
                                                            <div class="pricingTable-signup">
                                                                    <button type="button" class="btn btn-info btn-border-radius waves-effect" onclick="assignedpermission(this)" value="3">Assigned</button>
                                                                    <br/>
                                                                    <br/>
                                                                    <button type="button"  class="btn btn-default btn-border-radius waves-effect" onclick="revokepermission(this)" value="3">Revoke</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="pricingTable redColor">
                                                            <div class="pricingTable-header" id="h-reports">
                                                                <i class="material-icons">assignment</i>
                                                            </div>
                                                            <h3 class="heading">Reports</h3>
                                                            <div class="pricing-content">
                                                            </div>
                                                            <div class="pricingTable-signup">
                                                                    <button type="button" class="btn btn-danger btn-border-radius waves-effect" onclick="assignedpermission(this)" value="4">Assigned</button>
                                                                    <br/>
                                                                    <br/>
                                                                    <button type="button"  class="btn btn-default btn-border-radius waves-effect" onclick="revokepermission(this)" value="4">Revoke</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6">
                                                            <div class="pricingTable">
                                                                <div class="pricingTable-header" id="h-construction">
                                                                    <i class="material-icons">domain</i>
                                                                </div>
                                                                <h3 class="heading">Construction</h3>
                                                                <div class="pricing-content">
                                                                </div>
                                                                <div class="pricingTable-signup">
                                                                        <button type="button" class="btn btn-warning btn-border-radius waves-effect" onclick="assignedpermission(this)" value="5">Assigned</button>
                                                                        <br/>
                                                                        <br/>
                                                                        <button type="button"  class="btn btn-default btn-border-radius waves-effect" onclick="revokepermission(this)" value="5">Revoke</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                            </div>
                            @endrole




                        </div>
                    </div>
                </div>
            </div>
    
    
           </div>
       </div>
        <!-- #END# Exportable Table -->
    </div>
    
</section>

<div class="modal fade" id="modal-pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-white" id="exampleModalCenterTitle">Units</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="modal-body">
                    <form action="/users/profile/image" method="post" enctype="multipart/form-data" id="form-image">
                        @csrf
                        <input type="hidden" value = "{{$user->id}}" name="uid">

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
<script src="{{asset('assets/js/form.min.js')}}"></script>
<script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>

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
</script>

<script>

const clshelper = (prm)=>{

   

if (prm == '1') {
    $('#h-inventory').addClass('invent');
    return;
}

if (prm == '2') {
    $('#h-customer').addClass('custmr');
    return;
}

if (prm == '3') {
       
    $('#h-payment').addClass('pyment');
    return;
}

if (prm == '4') {
       
    $('#h-reports').addClass('reprts');
       return;
   }


if (prm == '5') {
       
       $('#h-construction').addClass('invent');
          return;
      }
   }

    const lighton = ()=>{

        const uid = $('#uid').val();

        fetch('/fetch/user/permission/'+uid)
            .then((res) => res.json())
                .then((data) => {
                    $('#h-inventory').removeClass('invent');
                    $('#h-customer').removeClass('custmr');
                    $('#h-payment').removeClass('pyment');
                    $('#h-reports').removeClass('reprts');
                    $('#h-construction').removeClass('invent');
                    console.log(data);
                        data.forEach(prm => {
                            clshelper(prm.permission_id);
                        });
                });
       
    }

    lighton();

    const assignedpermission = (prm) =>{

        permission = prm.value;
        const uid = $('#uid').val();

        const data = { "userid":uid, "permission_id":permission }

        Swal.fire({
            title: 'Are you sure?',
            text: "give this user the selected permission?",
            type: 'info',
            showCancelButton: true,
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Assigned it!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Assigned',
                'success'
                ).then((result) =>{
                    if(result.value){
                         assigneduser(data);
                    }
                })
            }
        })
         
    }

  



const assigneduser = async (data) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch('/user/assigned/permission', settings);

  try {
    const data = await response.json();
    console.log(data);
    console.log(data.status);

    if (data.status == 'done') {
        lighton();
        Swal.fire(
            'Success!',
            'User Successfully assigned ',
            'success'
                    )

    } else {

        Swal.fire(
            'Error!',
            'User Already Assigned to This Permission',
            'error'
                )   
    }
       
  } catch (err) {
    throw err;
  }
};



const prmrevoke = async (data) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch('/user/revoke/permission', settings);

  try {
    const data = await response.json();
    console.log(data);
    console.log(data.status);

    if (data.status == 'done') {
        lighton();
        Swal.fire(
            'Success!',
            'User Permission Revoked ',
            'success'
                    )

    } else {

        Swal.fire(
            'Error!',
            'User didnt have This Permission',
            'error'
                )   
    }
       
  } catch (err) {
    throw err;
  }
};

revokepermission = (prm) => {

    permission = prm.value;
        const uid = $('#uid').val();

        const data = { "userid":uid, "permission_id":permission }

        Swal.fire({
            title: 'Are you sure?',
            text: "To Revoke This user on selected permission?",
            type: 'info',
            showCancelButton: true,
            animation: false,
            customClass: {
                popup: 'animated tada'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Revoke it!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Revoke',
                'success'
                ).then((result) =>{
                    if(result.value){
                        prmrevoke(data);
                    }
                })
            }
        })


}


$('#save-user').on('click', ()=>{

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
            confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Update Record',
                'success'
                ).then((result) =>{
                    if(result.value){

                        const name = $('#name').val();

                        if (name == '' && name.length < 2) {
                            Swal.fire(
                            'Error!',
                            'Minimum name Length is 2 and Name is Required',
                            'error'
                                    )
                                    return;
                            
                        }

                        $('#update-user').submit();
                    }
                })
                
            }
            })

});

$('#save-pass').on('click', ()=>{


    const p1 = $('#cpassword').val();
    const p2 = $('#rpassword').val();


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
            confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Confirm!',
                'Click OK to Update Record',
                'success'
                ).then((result) =>{
                    if(result.value){

                        if (p1.length < 6 && p2.length < 6) {

                            Swal.fire(
                            'Error!',
                            'Minimum Password Length is 6',
                            'error'
                                )
                            return;
                        }
                        if(p1 == p2 && p1 != '' && p2 != ''){ 
                             $('#update-pass').submit();
                                }else{
                                    if (p1 != p2) {
                                        Swal.fire(
                                            'Error!',
                                            'Password didn t Match please Insert Same Password',
                                            'error'
                                                 )
                                    }

                                    if (p1 == '' || p2 == '') {
                                        Swal.fire(
                                            'Error!',
                                            'Password Fields Cannot be null please Fill it up',
                                            'error'
                                                 )
                                    }
                        }
                    }
                })  
            }
            })

});

$('#profile-img').on('click' , ()=> {
    $('#modal-pic').modal('show');
})


</script>

@endsection
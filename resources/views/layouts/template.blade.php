<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.radixtouch.in/templates/admin/blize/source/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jul 2019 09:16:23 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Eco Corporation</title>
    <!-- Favicon-->
    <link href="{{asset('assets/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}"  rel="stylesheet" />
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('assets/css/styles/all-themes.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 
  @yield('htmlhead')

  <style>
  .bg{
    /* background-image: url('assets/images/image-gallery/w-bg.jpg'); */

/* Full height */
height: 100%;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;
  }

  .n-bar{
    overflow-y:scroll !important;
    /* padding-right: 17px; */
    scrollbar-width: none; 
    -ms-overflow-style: none;  

  }
  .n-bar::-webkit-scrollbar { 
    width: 0;
    height: 0;
}

/* .bg-sidebar */
.slimScrollDiv{

    background-image: url('/assets/images/ecobg8.jpg') !important;
    background-size: cover;
    /* background-repeat: no-repeat; */
    height: 1080px !important;
}
.slimScrollDiv::-webkit-scrollbar { 
    width: 0;
    height: 0;
}
.menu::-webkit-scrollbar { 
    width: 0;
    height: 0;
}

.list::-webkit-scrollbar { 
    width: 0;
    height: 0;
}

.list{
    height: 1080px !important;
}

.navbar{
/* 
background-image: url('/assets/images/ecobg3.jpg') !important; */
background-image: url('/assets/images/ecobg8.jpg') !important;

}

.select2{

    width: 100% !important;

}

/* .menu{
    height: 1080px !important;
} */

  
  </style>
</head>


<body class="light bg">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30">
                <img class="loading-img-spin" src="{{asset('assets/images/logo2.png')}}" alt="admin">
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="#" onClick="return false;" class="bars"></a>
                <a class="navbar-brand" href="/dashboard">
                    <img src="{{asset('assets/images/ecoll.png')}}" height="45" style="max-width:100%; margin-top:-10px;" class="img-responsive"/>
                    <span class="logo-name">Corporation</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" onClick="return false;" class="sidemenu-collapse">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Full Screen Button -->
                    <li class="fullscreen">
                        <a href="javascript:;" class="fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- #END# Full Screen Button -->
                    <!-- #START# Notifications-->
                    
                    <li class="dropdown user_profile">
                        <div class="chip dropdown-toggle" data-toggle="dropdown">
                            <div class="hidden">
                                    <button type="hidden" id="a-profile" onclick="userprofile(this)" value="{{auth()->user()->id}}">hide</button>
                           
                            </div>

                            @if (auth()->user()->profile == null)
                            <img src="{{ asset('assets/images/user.png')}}" alt="Contact Person">
                            @else
                            <img src="{{ asset(auth()->user()->profile)}}" alt="Contact Person">
                            @endif
                         
                           
                         {{auth()->user()->name}}
                        </div>
                        <ul class="dropdown-menu pullDown">
                            <li class="body">
                                <ul class="user_dw_menu">
                                    
                             <li><a href="/logout"><i class="material-icons">power_settings_new</i>Logout</a></li>
                                <li><a onclick="toclick(this)"><i class="material-icons">
                                        person_pin</i>My Info</a></li>
                                
                            </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                  
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
   <div>
       @include('inc.navbar') 
              <!-- Right Sidebar -->
        {{-- @include('inc.themeskin') --}}
    </div>

   @yield('content')
    <!-- Plugins Js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>
    <script src="{{asset('assets/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>



        $('.hidden').hide();

function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", path);
    form.append('@csrf');
    $.each(parameters, function(key, value) {
        var field = $('<input></input>');

        field.attr("type", "hidden");
        field.attr("name", key);
        field.attr("value", value);

        form.append(field);
    });

    console.log(form);

    // The form needs to be a part of the document in
    // order for us to be able to submit it.
    $(document.body).append(form);
    form.submit();
}

const toclick = () => {

    $('#a-profile').click();
   
}


        const userprofile = (id)=>{

            const uid = id.value;

            const url = '/users/profile/myinfo';
            const parameters = {'uid':uid};
            console.log(parameters);
            post(url, parameters);

            // fetch('/users/profile/myinfo',{  
            //     method: 'POST',  
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         body: JSON.stringify({
            //         uid: uid,
            //      })
            // }).then((data)=>{
            //     //window.location('/users/profile/myinfo');
            //     console.log(data);
            // })

            
        }
        function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  //span.textContent = h + ":" + m + ":" + s;
	var time = h + ":" + m + ":" + s;
	var begin = "18:1:1";
  
    //  console.log(time);
//   if (time >= begin && time <= end) {

// 	  location.href = '/logout';
	  
//   }

    if (time == begin) {

        location.href = '/logout';
    }
}

setInterval(time, 1000);

        $("body").addClass("menu_dark logo-black");
            var menu_option = "menu_dark";
            localStorage.setItem("choose_logoheader", "logo-white");
            localStorage.setItem("menu_option", menu_option);


    </script>

   @yield('js')
</body>
</html>
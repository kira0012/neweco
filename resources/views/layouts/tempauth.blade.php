<!DOCTYPE html>
<html lang="en">
<head>
	<title>Eco Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('loginstaff/css/main.css')}}">
<!--===============================================================================================-->

{{-- font --}}
    <link href="https://fonts.googleapis.com/css?family=Finger+Paint&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100&display=swap" rel="stylesheet">
	{{-- <link href="https://fonts.googleapis.com/css?family=Finger+Paint&display=swap" rel="stylesheet"> --}}

	<link href="https://fonts.googleapis.com/css?family=Vollkorn&display=swap" rel="stylesheet">
{{-- animate --}}

<link rel="stylesheet" href="css/animate.css">

<style>
 .animation-title {
            font-family: sans-serif;
            text-align: center;
            }
            /* .eye-animation {
            width: 1000px;
            display: block;
            
            // place in the middle of the screen
            margin: auto; 
            } */


#loaderContainer{
	left: 25%;
	width: 50%;
	position: absolute;
	margin: 100px auto;

    text-align: center;
    color: #fff;

padding: 60px;

}

#loader {
  /*position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;*/
   margin: 40px auto;

  /*margin: -75px 0 0 -75px;*/
  /*border: 16px solid #f3f3f3;*/
  border-radius: 50%;
  /*border-top: 16px solid #3498db;*/
   border-top: 30px solid #ec0c8b;
  border-right: 30px solid #fcee24;
  border-bottom: 30px solid #2aabe2;
  border-left: 30px solid #fff;
  width: 160px;
  height: 160px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@media only screen and (max-width:767px) {
	#loader {
   margin: 20px auto;
  /*border: 16px solid #f3f3f3;*/
  border-radius: 50%;
  border-top: 20px solid #ec0c8b;
  border-right: 20px solid #fcee24;
  border-bottom: 20px solid #2aabe2;
  border-left: 20px solid #fff;
  width: 80px;
  height: 80px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
}

@media only screen and (max-width:767px) {

	#loaderContainer h5 {

		font-size: 15px;

	}

}

@media only screen and (max-width:456px) {

	#loaderContainer h5 {

		font-size: 12px;

	}

}

@media only screen and (max-width:412px) {

	#loaderContainer h5 {

		font-size: 10px;

	}

}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}



#myDiv {
  display: none;
  text-align: center;
}



#carouselExampleIndicators{
	margin: 40px 20px;
	border: 40px solid;
	border-radius: 40px;
	background-color: rgba(51, 51, 51, .7);

	animation-duration: 3s;
  animation-delay: 1s;
  /*animation-iteration-count: infinite;*/
}

/*#carouselExampleIndicators:hover{
box-shadow: 0px 0px 10px 10px rgba(235, 64, 52, .6);

}*/



.carousel-inner{

border-radius: 20px;

box-shadow: 0px 0px 10px 10px rgba(235, 64, 52, .5);
}


.carousel-inner img:hover, .carousel-inner:hover{
box-shadow: 0px 0px 10px 10px rgba(255,255,255, .5);
border-radius: 20px;

}

.login100-more{
	background-color: #333;
	/*background-image: url('assets/images/image-gallery/n-bgdark.jpg');*/
}

#tvButton{
	margin: -10px 40px 0px;
	border-top: 20px dotted rgba(255,255,255, .1);

  animation-duration: 3s;
  animation-delay: 2s;
}


</style>
</head>
{{-- <body onload="myFunction()"  class="lg-bg" style="background-color: #333333; margin:0;"> --}}

<body onload="myFunction()"  class="lg-bg" style="background-color: #333333; margin:0;">
	<div id="loaderContainer">
	<div id="loader"></div>
	<h5>Please wait for a moment..</h5>
	</div>

<div style="display:none;" id="myDiv" class="animate-bottom">
	@yield('content')
</div>

	

	
	
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('loginstaff/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('loginstaff/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginstaff/js/main.js')}}"></script>

	<script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>


	<script>
	
	// animate


	var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loaderContainer").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}

	</script>

	{{-- <script src="{{asset('assets/js/app.min.js')}}"></script> --}}
	<script>
		const $element = $('.eye-animation');
		const base_url =  window.location.origin;
		 const imagePath = base_url+'/assets/images/ecologo';
		 const totalFrames = 50;
		 const animationDuration = 4000;
		 const timePerFrame = animationDuration / totalFrames;
		 let timeWhenLastUpdate;
		 let timeFromLastUpdate;
		 let frameNumber = 1;

		 // 'step' function will be called each time browser rerender the content
		 // we achieve that by passing 'step' as a parameter to the 'requestAnimationFrame' function
		 function step(startTime) {
		 // 'startTime' is provided by requestAnimationName function, and we can consider it as current time
		 // first of all we calculate how much time has passed from the last time when frame was update
		 if (!timeWhenLastUpdate) timeWhenLastUpdate = startTime;
		 timeFromLastUpdate = startTime - timeWhenLastUpdate;
		 
		 // then we check if it is time to update the frame
		 if (timeFromLastUpdate > timePerFrame) {
			 // and update it accordingly
			 $element.attr('src', imagePath + `/eco00${frameNumber}.png`);
			 // reset the last update time
			 timeWhenLastUpdate = startTime;
			 
			 // then increase the frame number or reset it if it is the last frame
			 if (frameNumber >= totalFrames) {
			 frameNumber = 1;
			 } else {
			 frameNumber = frameNumber + 1;
			 }        
		 }
		 
		 requestAnimationFrame(step);
		 }

		 // create a set of hidden divs
		 // and set their background-image attribute to required images
		 // that will force browser to download the images
		 $(document).ready(() => {
		 for (var i = 1; i < totalFrames + 1; i++) {
			 $('body').append(`<div id="preload-image-${i}" style="background-image: url('${imagePath}/eco00${i}.png');"></div>`);
		 }
		 });

		 // wait for images to be downloaded and start the animation
		 $(window).on('load', () => {
		 requestAnimationFrame(step);
		 });
		</script>



</body>
</html>
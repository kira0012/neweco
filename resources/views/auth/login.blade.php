@extends('layouts.tempauth')
@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				{{-- <form class="login100-form validate-form"> --}}
          
          {{-- image --}}
          {{-- style="background-image: url({{asset('assets/images/image-gallery/n-bgdark.jpg')}}); --}}
                        <form class="login100-form validate-form wow bounceInRight col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                        {{-- validate-form --}}
                    {{-- <img src="{{asset('loginstaff/images/eco-fast.gif')}}" style="height:250px;margin-top:-150px;"> --}}
          
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="imageAndTitleDiv">
              <img class="eye-animation" src="{{asset('assets/images/ecologo/eco001.png')}}" />
    					<span class="login100-form-title text-white">Login to continue
    						{{-- <span id="titleLoginColor">Login</span> to continue --}}
    					</span>
					</div>

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="titleAndButtonDiv">
					
      					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz or username">
      						<input class="input100 text-white" type="text" name="username">
      						<span class="focus-input100"></span>
      						<span class="label-input100">Username</span>
      					</div>
      					
      					
      					<div class="wrap-input100 validate-input" data-validate="Password is required">
      						<input class="input100 text-white" type="password" name="password">
      						<span class="focus-input100"></span>
      						<span class="label-input100">Password</span>
      					</div>

		
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Login</button>
					</div>

        </div>
					
				</form>

				{{-- <div class="login100-more" style="background-image: url({{asset('loginstaff/images/bg-01.jpg')}});"> --}}
                    <div class="login100-more .container-login100 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                            <div id="carouselExampleIndicators" class="carousel slide wow swing" data-ride="carousel">
                              
                                    <ol class="carousel-indicators">
                                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('assets/images/ecologo/eco001.png')}}" alt="First slide">
                                      </div>
                                      <div class="carousel-item">
                                        <img class ="d-block w-100" src="{{asset('loginstaff/images/ecodd.jpg')}}" alt="Second slide" style="max-height:800px;">
                                      </div>
                                      <div class="carousel-item">
                                            <img class ="d-block w-100" src="{{asset('loginstaff/images/ee.jpg')}}" alt="Second slide" style="max-height:800px;">
                                      </div>
                                    </div>
                                    
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                  </div>

                                  <div class="wow rubberBand" id="tvButton"></div>
                </div>
			</div>
		</div>
    </div>
	</div>
	
{{-- 
<form class="login100-form validate-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
        <div>
            <input type="text" class="roundInput" name="username" />
            <label>Username</label>
        </div>
        <div>
            <input type="password" class="roundInput" name="password" />
            <label>Password</label>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                Login
            </button>
        </div>
        
    
    </form> --}}
    
@endsection
@extends('apps.appproduct')
@section('content')
	<div class="forms" id="forms">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Forms</h4>
					  		<img src="assets/images/product/form/forms.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Forms</span> - allows you provide more information to users. </p>

                            <p> •	Very informative </p>
                            <p> •	With signatures for the proof </p>
                            <p> •	Sample surveys </p>
                            <p> •	Questionnaires </p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">FORMS</span></h1> </cennter>

		<div class="forms" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4"></div>
						<div class="col-md-4" id="sampleProductBorder">
							{{-- <center><div>
							<h3>Business Form</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="assets/images/product/form/forms.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-4"></div>
	
						{{-- <div class="col-md-3">
								<center><div>
								<h3>Birth Certificate Form</h3>
								<p>PSA</p>
								</div></center>
								<img src="images/form2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>Registration Forms</h3>
								<p>Registration</p>
								</div></center>
								<img src="images/form3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>Receipt Forms</h3>
								<p>Receipt</p>
								</div></center>
								<img src="images/form4.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
@endsection
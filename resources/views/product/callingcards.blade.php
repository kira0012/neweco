@extends('apps.appproduct')
@section('content')
	<div class="callingcards" id="callingcards">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Calling Cards</h4>
					  		<img src="assets/images/product/callingcard/callingcards.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Calling Card</span> - a card displaying a number that can be used to charge telephone calls to a single account regardless of where the calls are placed.

                            Calling card may refer to: </p>

                            <p> •	Visiting card </p>
                            <p> •	Business card </p>
                            <p> •	Tart card </p>
                            <p> •	Calling card (crime) </p>
                            <p> •	Telephone card </p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">CALLING CARDS</span></h1> </cennter>

		<div class="callingcards" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4"></div>
						<div class="col-md-4" id="sampleProductBorder">
							{{-- <center><div>
							<h3>Business Form</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="assets/images/product/callingcard/callingcards.jpg" class="img-responsive" height="250px;">
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
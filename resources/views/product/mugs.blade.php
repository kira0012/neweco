@extends('apps.appproduct')
@section('content')
	<div class="mugs" id="mugs">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Mugs</h4>
					  		<img src="assets/images/product/mug/mugs.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Mugs</span> - a large cup, typically cylindrical with a handle and used without a saucer.	</p>
                            
                            <p> •	Mugs usually have handles and hold a larger amount of fluid than other types of cup. </p>
                            <p> •	Usually a mug holds approximately 8-12 US fluid ounces (350 ml) of liquid; double a tea cup. </p>
					</div>			
				</div>
			</div>
		</div>
	</div>



	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">MUGS</span></h1> </cennter>

		<div class="mugs" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4"></div>
						<div class="col-md-4" id="sampleProductBorder">
							{{-- <center><div>
							<h3>QUOTED MUGS</h3>
							<p>Quotes</p>
							</div></center> --}}
							<img src="assets/images/product/mug/mugs.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-4"></div>
						{{-- <div class="col-md-3">
								<center><div>
								<h3>COUPLE MUGS</h3>
								<p>Couple</p>
								</div></center>
								<img src="images/mug2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>FAMILY</h3>
								<p>Family Mugs</p>
								</div></center>
								<img src="images/mugs3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>CUSTOMIZE</h3>
								<p>Your own design</p>
								</div></center>
								<img src="images/mugs4.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
@endsection
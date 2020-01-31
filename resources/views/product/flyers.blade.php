@extends('apps.appproduct')
@section('content')
	<div class="flyers" id="flyers">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Flyers</h4>
					  		<img src="assets/images/product/flyer/flyers.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Flyer</span> - small printed notice which is used to advertise a particular company, service, or event	</p>
                            
                            <p> •	Simple design and language. </p>
                            <p> •	Good use of white space. </p>
                            <p> •	Appropriate printing. </p>
                            <p> •	Inclusion of relevant details. </p>
                            <p> •	Correct spelling and grammar.	</p>	
					</div>			
				</div>
			</div>
		</div>
	</div>



	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">FLYERS</span></h1> </cennter>

		<div class="flyers" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1"></div>
						<div class="col-md-3" id="sampleProductBorder">
							<{{-- center><div>
							<h3>Flyers</h3>
							<p>Common Stickers</p>
							</div></center> --}}
							<img src="assets/images/product/flyer/flyers.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>STATIC VINYL</h3>
								<p>Water Proof</p>
								</div></center> --}}
								<img src="assets/images/product/flyer/flyers1.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>OPAQUE VINYL</h3>
								<p>Water Proof</p>
								</div></center> --}}
								<img src="assets/images/product/flyer/flyers2.jpg" class="img-responsive"height="250px;">
						</div>
						<div class="col-md-2"></div>
	
						{{-- <div class="col-md-3">
								<center><div>
								<h3>STICKER TAPE</h3>
								<p>High Quality Sticker</p>
								</div></center>
								<img src="images/tape.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>


@endsection
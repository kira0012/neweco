@extends('apps.appproduct')
@section('content')
	<div class="stickers" id="stickers">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Stickers</h4>
					  		<img src="assets/images/product/sticker/stickers.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p><span id="paragraphproductQuatationDescription">Sticker</span> - an adhesive label or notice, generally printed or illustrated.</p>
                            
                            <p> •	Brand stickers may be attached to products to label these products as coming from a certain company. </p>
                            <p> •	It can placed on automobile bumpers, magnetic and permanent, called bumper stickers. </p>
                            <p> •	Also used for embellishing scrapbooking pages </p>
                            <p> •	Can applied to guitars are called guitar decals </p>
                            <p> •	Post-it notes are removable stickers having glue on only part of the back, and are usually sold blank </p>
                            <p> •	Stickers placed on tires, usually called tire lettering	</p>	
					</div>			
				</div>
			</div>
		</div>
	</div>






	{{-- <center> <h1 id="titleBorderProduct"> PRODUCT FOR <span id="titleColorProductQuatation">STICKERS</span> OFFERED</h1> </cennter> --}}

		<center> <h1 id="titleBorderProduct">SAMPLE <span id="titleColorProductQuatation">STICKERS</span></h1> </cennter>

		<div class="stickers" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1"></div>
						<div class="col-md-3" id="sampleProductBorder">
							<{{-- center><div>
							<h3>STICKERS</h3>
							<p>Common Stickers</p>
							</div></center> --}}
							<img src="assets/images/product/sticker/stickers.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>STATIC VINYL</h3>
								<p>Water Proof</p>
								</div></center> --}}
								<img src="assets/images/product/sticker/stickers1.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>OPAQUE VINYL</h3>
								<p>Water Proof</p>
								</div></center> --}}
								<img src="assets/images/product/sticker/stickers2.jpg" class="img-responsive"height="250px;">
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
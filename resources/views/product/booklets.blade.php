@extends('apps.appproduct')
@section('content')
	<div class="booklets" id="booklets">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Booklets</h4>
					  		<img src="assets/images/product/booklet/booklets1.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Booklet</span> - a small book consisting of a few sheets, typically with paper covers.		</p>
							
							<p>	•	Paper cover </p>
							<p>	•	Can be termed as their number of pages</p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">BOOKLETS</span></h1> </cennter>

		<div class="booklets" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-3"></div>
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>BUSINESS BOOKLET</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="assets/images/product/booklet/booklets1.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
		</div>
@endsection
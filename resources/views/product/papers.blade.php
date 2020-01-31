@extends('apps.appproduct')
@section('content')
	<div class="papers" id="papers">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Papers</h4>
					  		<img src="assets/images/product/paper/papers1.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
					<p><span id="paragraphproductQuatationDescription">Paper</span> - it is a versatile material with many uses, including writing, printing, packaging, cleaning, decorating, and a number of industrial and construction processes. Papers are essential in legal or non-legal documentation.</p>
					<p>•	Multi-purpose quality paper, perfect for every project</p>
					<p>• 	Full-color printing available on both sides</p>
					<p>• 	A variety of paper stocks and sizes</p>				
					</div>			
				</div>
			</div>
		</div>
	</div>

	{{-- <center> <h1 id="titleBorderProduct">PRODUCT FOR <span id="titleColorProductQuatation">PAPERS</span> OFFERED</h1> </center> --}}

	<center> <h1 id="titleBorderProduct">SAMPLE <span id="titleColorProductQuatation">PAPERS</span></h1> </center>

	<div class="papers" id="productMargin">
		<div class="container">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-1"></div>
					<div class="col-md-3" id="sampleProductBorder">
						{{-- <center><div>
						<h3>BOND PAPER</h3>
						<p>Short, Long, A4, A3 sizes</p>
						</div></center> --}}
						<img src="assets/images/product/paper/papers1.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>

					<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>COLORED PAPER</h3>
							<p>Card Board, Textured, Metalic Papers</p>
							</div></center> --}}
							<img src="assets/images/product/paper/papersmany1.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>

					<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>COLORED PAPER</h3>
							<p>Card Board, Textured, Metalic Papers</p>
							</div></center> --}}
							<img src="assets/images/product/paper/papers2.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>
					<div class="col-md-2"></div>

					{{-- <div class="col-md-3">
							<center><div>
							<h3>COATED PAPER</h3>
							<p>Glossy, Matte</p>
							</div></center>
							<img src="images/coatedpaper.jpg" class="img-responsive"height="250px;">
					</div>

					<div class="col-md-3">
							<center><div>
							<h3>BANANA PAPER</h3>
							<p>Designed Papers</p>
							</div></center>
							<img src="images/bananapaper.jpg" class="img-responsive">
					</div>  --}}

				</div>
			</div>
		</div>
	</div>
@endsection

@extends('apps.appproduct')
@section('content')
	<div class="posters" id="posters">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Poster</h4>
					  		<img src="assets/images/product/poster/posters.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p><span id="paragraphproductQuatationDescription">Poster</span> - a large printed picture used for decoration.	</p>
                            
                            <p> •	It communicate the information quickly and additionally efficiently. </p>
                            <p> •	It Gets Attention </p>
                            <p> •	It is Convincing </p>
                            <p> •	It Effectively Utilizes Color </p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">POSTERS</span></h1> </cennter>

		<div class="posters" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-3"></div>
						<div class="col-md-4" id="sampleProductBorder">
							{{-- <center><div>
							<h3>BOB MARLEY POSTER</h3>
							<p>One Love</p>
							</div></center> --}}
							<img src="assets/images/product/poster/posters.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-1"></div>
						{{-- <div class="col-md-3">
								<center><div>
								<h3>CONCERT POSTER</h3>
								<p>Concerts</p>
								</div></center>
								<img src="images/posters4.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>FREDDIE MERCURY</h3>
								<p>Mama</p>
								</div></center>
								<img src="images/posters2.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>MISSING POSTERS</h3>
								<p>Missing</p>
								</div></center>
								<img src="images/posters3.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
@endsection
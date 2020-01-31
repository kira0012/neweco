@extends('apps.appproduct')
@section('content')
	<div class="brochures" id="brochures">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Brochures</h4>
					  		<img src="images/brochureproduct.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Brochure</span> - a small book or magazine containing pictures and information about a product or service.	</p>

                        <p>     •	They introduce. </p>
                        <p>     •	They inform. </p>
                        <p>     •	They persuade. </p>
                        <p>     •	They are complete. </p>
                        <p>     •	They are consistent. </p>
					</div>			
				</div>
			</div>
		</div>
	</div>






	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">BROCHURE</span></h1> </cennter>

		<div class="brochures" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>COMPANY BROCHURE</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="images/bro2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>BUSINES BROCHURE</h3>
								<p>Sogo Hotel</p>
								</div></center> --}}
								<img src="images/bro.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder" >
								{{-- <center><div>
								<h3>COMPANY BROCHURE</h3>
								<p>Company</p>
								</div></center> --}}
								<img src="images/bro3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>HOTEL BROCHURE</h3>
								<p>Eurotel Hotel</p>
								</div></center> --}}
								<img src="images/bro1.jpg" class="img-responsive" height="250px;">
						</div> 
					</div>
				</div>
			</div>
		</div>
@endsection
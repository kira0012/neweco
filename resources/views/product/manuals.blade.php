@extends('apps.appproduct')
@section('content')
	<div class="manuals" id="manuals">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Manuals</h4>
					  		<img src="images/manualproduct.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Manual</span> - a book that is conveniently handled.

                            Manual may refer to</p>
                            
                            <p> •	Users guide </p>
                            <p> •	Owner's Manual </p>
                            <p> •	Instruction manual (gaming) </p>
                            <p> •	Online help </p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">MANUALS</span></h1> </cennter>

		<div class="manuals" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>Sample Manual</h3>
							<p></p>
							</div></center> --}}
							<img src="images/manual1.jpg" class="img-responsive" height="250px;" max>
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>Sample Manual</h3>
								<p></p>
								</div></center> --}}
								<img src="images/manual2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>Sample Manual</h3>
								<p></p>
								</div></center> --}}
								<img src="images/manual3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>Sample Manual</h3>
								<p></p>
								</div></center> --}}
								<img src="images/manual4.jpg" class="img-responsive" height="250px;">
						</div> 
					</div>
				</div>
			</div>
		</div>
@endsection
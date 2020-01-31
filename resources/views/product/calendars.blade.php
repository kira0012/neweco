@extends('apps.appproduct')
@section('content')
	<div class="calendars" id="calendars">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Calendars</h4>
					  		<img src="assets/images/product/calendar/calendars1.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Calendar</span> - a chart or series of pages showing the days, weeks, and months of a particular year, or giving particular seasonal information. </p>
                            
                            <p> •	Highly organized </p>
                            <p> •	Very flexible </p>
                            <p> •	Super simple </p>	
					</div>			
				</div>
			</div>
		</div>
	</div>





	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">CALENDARS</span></h1> </cennter>

		<div class="calendars" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3"></div>
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>ORDINARY</h3>
							<p>Common</p>
							</div></center> --}}
							<img src="assets/images/product/calendar/calendars1.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>CHINESE CALENDAR</h3>
								<p>Chinese Calendar</p>
								</div></center> --}}
								<img src="assets/images/product/calendar/calendars2.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-3"></div>
	
						{{-- <div class="col-md-3">
								<center><div>
								<h3>COMPANY CALENDAR</h3>
								<p>Companies</p>
								</div></center>
								<img src="images/calendar2.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>MISSING POSTERS</h3>
								<p>Missing</p>
								</div></center>
								<img src="images/calendar3.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
@endsection
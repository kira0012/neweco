@extends('apps.appproduct')
@section('content')
	<div class="invitations" id="invitations">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Invitations</h4>
					  		<img src="assets/images/product/invitation/invitations.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Invitation</span> - a written or verbal request inviting someone to go somewhere or to do something. </p>

                            <p> •	Require the inclusion of the 5W’s (what, who, why, when, where) and other details that the readers will need and appreciate. </p>
					</div>			
				</div>
			</div>
		</div>
	</div>



	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">INVITATIONS</span></h1> </cennter>

		<div class="invitations" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4"></div>
						<div class="col-md-4" id="sampleProductBorder">
							{{-- <center><div>
							<h3>Birthday Invitations</h3>
							<p>Birthdays</p>
							</div></center> --}}
							<img src="assets/images/product/invitation/invitations.jpg" class="img-responsive" height="250px;">
						</div>
						<div class="col-md-4"></div>
	
						{{-- <div class="col-md-3">
								<center><div>
								<h3>Wedding Invitations</h3>
								<p>Wedding</p>
								</div></center>
								<img src="images/invitations2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>Company invitations</h3>
								<p>Company</p>
								</div></center>
								<img src="images/invitations3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3">
								<center><div>
								<h3>Baptism invitations</h3>
								<p>Baptism</p>
								</div></center>
								<img src="images/invitations4.jpg" class="img-responsive" height="250px;">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
@endsection
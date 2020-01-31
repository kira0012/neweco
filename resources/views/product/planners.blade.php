@extends('apps.appproduct')
@section('content')
	<div class="planners" id="planners">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Planners</h4>
					  		<img src="assets/images/product/planner/planners1.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Planner</span> - a list of data or information that is used for planning.
                            </p>

                            <p> - something (such as a device, program, or notebook) that provides a schedule and is used for planning activities, travels, etc. <i>- Merriam Webster Dictionary.</i>
                            </p>
                            
							<p>	•	Paper</p>
							<p>	•	Notebook</p>
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">Planners</span></h1> </cennter>

		<div class="planners" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3"></div>
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>BUSINESS BOOKLET</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="assets/images/product/planner/planners1.jpg" class="img-responsive" height="250px;">
						</div>

						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>BUSINESS BOOKLET</h3>
							<p>Business</p>
							</div></center> --}}
							<img src="assets/images/product/planner/planners2.jpg" class="img-responsive" height="250px;">
						</div>

						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
@endsection
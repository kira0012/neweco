@extends('apps.appproduct')
@section('content')
	<div class="receipts" id="receipts">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Receipt</h4>
					  		<img src="assets/images/product/receipt/receipts.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Receipt</span> - A receipt is a document acknowledging that a person has received money or property in payment following a sale or other transfer of goods or provision of a service. </p>

                            <p> •	to give a receipt for or acknowledge the receipt of </p>
                            <p> •	to mark as paid </p>
                          
					</div>			
				</div>
			</div>
		</div>
	</div>




	<center> <h1 id="titleBorderProduct">SAMPLE <span id="titleColorProductQuatation">RECEIPT</span></h1> </cennter>

		<div class="receipts" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1"></div>
					<div class="col-md-3" id="sampleProductBorder">
						{{-- <center><div>
						<h3>BOND PAPER</h3>
						<p>Short, Long, A4, A3 sizes</p>
						</div></center> --}}
						<img src="assets/images/product/receipt/receipts.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>

					<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>COLORED PAPER</h3>
							<p>Card Board, Textured, Metalic Papers</p>
							</div></center> --}}
							<img src="assets/images/product/receipt/receipts1.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>

					<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>COLORED PAPER</h3>
							<p>Card Board, Textured, Metalic Papers</p>
							</div></center> --}}
							<img src="assets/images/product/receipt/receipts2.jpg" class="img-responsive" height="250px;" style="width: 100%;">
					</div>
					<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		</div>
@endsection
@extends('apps.appproduct')
@section('content')
	<div class="books" id="books">
		<div class="container">
			<a href="/home" id="btnBackProduct">Go Back</a>
			<div class="row">
				<div class="col-md-5">
					<div class="card" id="cardBorderProduct">
					  <div class="card-body">
					    <h4 class="card-subtitle mb-2">Books</h4>
					  		<img src="images/bookproduct.jpg" class="img-responsive">
					  </div>
					</div>		
				</div>
				<div class="col-md-7">
					<div class="alert" role="alert">					
                            <p> <span id="paragraphproductQuatationDescription">Books</span> - a written or printed work consisting of pages glued or sewn together along one side and bound in covers. </p>
                            
                            <p> •	A collection of sheets of paper, parchment or other material, bound together along one edge within covers. A book is also a literary work or a main division of such a work. </p>
                            <p> •	A book may be studied by students in the form of a book report. It may also be covered by a professional writer as a book review to introduce a new book. Some belong to a book club. </p>
					</div>			
				</div>
			</div>
		</div>
	</div>





	<center> <h1 id="titleBorderProduct"> SAMPLE <span id="titleColorProductQuatation">BOOKS</h1></span> </cennter>

		<div class="books" id="productMargin">
			<div class="container">
					<div class="col-md-12">
						<div class="row">
						<div class="col-md-3" id="sampleProductBorder">
							{{-- <center><div>
							<h3>NOVEL BOOKS</h3>
							<p>English</p>
							</div></center> --}}
							<img src="images/books1.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>COMIC BOOKS</h3>
								<p>Justice League</p>
								</div></center> --}}
								<img src="images/books2.jpg" class="img-responsive" height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>DICTIONARY</h3>
								<p>Oxford English</p>
								</div></center> --}}
								<img src="images/books3.jpg" class="img-responsive"height="250px;">
						</div>
	
						<div class="col-md-3" id="sampleProductBorder">
								{{-- <center><div>
								<h3>EDUCATIONAL</h3>
								<p>Books</p>
								</div></center> --}}
								<img src="images/books4.jpg" class="img-responsive" height="250px;">
						</div> 
					</div>
				</div>
			</div>
		</div>
@endsection
@extends('apps.app')
@section('content')
	

<div class="landingPage" id="landingPage">
	<div class="container-fluid">
		<div class="row">
				<a href="/home"><img src="images/landingpage.jpg" class="img-respopnsive"></a>
		</div>		
	</div>
</div>

<!-- ================================== About Us Page ========================================= -->

<div class="aboutus" id="aboutus">
	<div class="container">
		<div class="row" id="aboutusrow">
			<div class="col-md-6 wow bounceInLeft">
				<h3 id="title1"><span id="titleColorAboutUs">Who</span> are we?</h3>
				{{-- <p> Who we are...
					</p> --}}

					<p> <strong>ECO Paper and Printing Corporation</strong> was launched and registered in <em>Security and Exchange Commission</em> on March 2019. 
					It was done through the collaborative and persistent efforts of young entrepreneurs that gave birth to <em>Eco Paper and Printing Corporation.</em>
					</p>
					<p> <em>ECO Paper and Printing Corporation,</em> a business that explores innovative ideas, solutions to dynamic and continually changing demands in printing. 
					We made efforts in research and developed techniques to facilitate the growing needs in Printing Industry and accommodate the diverse demands in printing. 
					</p>
				<h3 id="title2"><span id="titleColorAboutUs">WHY</span> CHOOSE ECO?</h3>
					<p> <strong>ECO Paper and Printing Corporation</strong> is new and fresh in the market, therefore we have an edge in all the latest technology in printing and its services not to mention the young, innovative and vibrant minds collaborating behind the company.  So why settle for mediocrity when you can go for the BEST! 
					</p>
			</div>
					<div class="col-md-6 wow bounceInRight" id="aboutUsImage">
						<img src="../../../../assets/images/questionmark.gif" style="max-width: 30%" class="img-respopnsive float-right" >
						<img src="images/hero.png" style="max-width: 80%" class="img-respopnsive" >
					</div>
			
		</div>
	</div>
</div>

<!-- =============================== Offered Services ===================================== -->
<div class="services" id="services">
	<div class="container">
			<h3><span id="titleColorServices">SERVICES</span> OFFERED</h3>
			<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2 wow zoomIn">
					<i class="fas fa-truck-loading"></i>
					<h4>Tracking</h4>
					<p>We deliver safe and fast and we make sure that you will receive it on-time.</p>
			</div>
			<div class="col-md-2  wow zoomIn" data-wow-delay="0.3s">
					<i class="fas fa-sticky-note"></i>
					<h4>Papers</h4>
					<p>ECO offer professional-grade papers that meet the high standards of our customers.</p>
			</div>
			<div class="col-md-2  wow zoomIn" data-wow-delay="0.6s">
					<i class="fas fa-print"></i>
					<h4>Printing</h4>
					<p>We provide various printing services - business card, flyers, brochures, stickers, etc. </p>
					<p></p>
			</div>
			<div class="col-md-2  wow zoomIn" data-wow-delay="0.9s">
					<i class="fas fa-cut"></i>
					<h4>Cutting</h4>
					<p>We also offer a custom cutting as a service for when 
						you need a special size.
					</p>
			</div>
				<div class="col-md-2  wow zoomIn" data-wow-delay="1s">
					<i class="fas fa-coins"></i>
					<h4>Offset</h4>
					<p>We provide wide selection of printing solutions to produce the best output.
					</p>
			</div>


		</div>
	</div>
</div>


<!-- ====================================== Request Quote ========================================== -->
<br>
<br>
<br>
	<div class="quotations alert alert-info" id="quatation">
	<div class="container animated pulse" id="orderFormBorderContainer">
		<div class="row" id="orderFormBorderRow">
				<div class="col-md-3">
					<img src="{{asset('images/orderPaper.png')}}" style="max-width: 100%" class="img-respopnsive">
				</div>
				<div class="col-md-9" style="margin-top: 20px; margin-bottom: 20px;">
						<h2 id="request" class="animated infinite pulse delay-3s duration-3s"><span id="titleColorAboutUs">REQUEST</span> A QUOTE</h2>
						<p id="offer"> ECO paper & printing a post-production company offering best paper and high quality printing services 
						if you have any order just sign up for the information provided.</p>	
						 		<form method="POST" action="insertQuatation">
									 @csrf
									<div class="row">
					  				<div class="col-md-6 requestForm">
										  <small>Please Fill information*</small>
										<input type="text" class="form-control" name ="fullname" placeholder="Full name*" required>
										<input type="text" class="form-control" name="company" placeholder="Company" required>
										<input type="text" class="form-control" name= "address" placeholder="Address*" required>
										<input type="text" class="form-control decimal" name="contact" placeholder="Contact*" required>
										<button id="btnSubmitOrderForm" type="submit" class="btn btn-primary btn-block" style="border-radius: 0px;">Submit</button>
					  				</div>
					 				 
								<div class="col-md-6 requestForm1">	
										<small>Description</small>	         
										<textarea name="description" rows="10" cols="100%" placeholder="Please leave your description here..." required></textarea>
									</div>
								</div>
							</form>	
						</div>				
					</div>	
				</div>
		</div>

<br>



<!-- ============================== Product ====================================== -->

<br>
<div class="product wow jello" id="product">
	<div class="container" id="productContainer">
		<h2 class="animated infinite tada delay-2s"><span id="titleColorProduct">PRODUCT</span> <span id="titleColorOffered">OFFERED</span></h2>
		{{-- <p id="titleService">Great design will not sell an inferior product, but it will enable a great product to achieve its maximum potential.</p> --}}
		<br>
		<br>
		
<div class="row" id="productRowContainer" >
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
     {{--  <img class="d-block w-100" src="..." alt="First slide"> --}}
     <div class="row" alt="First slide">
				<div class="col-md-2 wow flipInY">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/paper/papers1.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/papers"><p class="card-title">Papers</h4></p></a>
				  </div>
				</div>	
			</div>
			<div class="col-md-2 wow flipInY"  data-wow-delay="0.2s">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/sticker/stickers.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/stickers"><p class="card-title">Stickers</h4></p></a>
				  </div>
				</div>	
			</div>
			<div class="col-md-2 wow flipInY" data-wow-delay="0.3s">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/flyer/flyers.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/flyers"><p class="card-title">Flyers</h4></p></a>		  
				  </div>
				</div>	
			</div>
			<div class="col-md-2 wow flipInY" data-wow-delay="0.4s">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/poster/posters.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/posters"><p class="card-title">Posters</h4></p></a>  
				  </div>
				</div>	
			</div>
			<div class="col-md-2 wow flipInY" data-wow-delay="0.4s">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/calendar/calendars1.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/calendars"><p class="card-title">Calendars</h4></p></a>		  
				  </div>
				</div>	
			</div>
			<div class="col-md-2 wow flipInY" data-wow-delay="0.5s">
				<div class="card mb-2 inner">
				  <img src="images/books.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/books"><p class="card-title">Books</h4></p></a>	  
				  </div>
				</div>	
			</div>

		</div>

    </div>
    <div class="carousel-item">
      {{-- <img class="d-block w-100" src="..." alt="Second slide"> --}}

     <div class="row" alt="Second slide">
     	{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/mug/mugs.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/mugs"><p class="card-title">Mugs</h4></p></a>
				  </div>
				</div>	
			</div>
			{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="images/manual.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/manuals"><p class="card-title">Manuals</h4></p></a>
				  </div>
				</div>	
			</div>
			{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/invitation/invitations.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/invitations"><p class="card-title">Invitations</h4></p></a>	  
				  </div>
				</div>	
			</div>
			{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/form/forms.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/forms"><p class="card-title">Forms</h4></p></a>  
				  </div>
				</div>	
			</div> 
			{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="images/brochures.jpeg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/brochures"><p class="card-title">Brochures</h4></p></a>		  
				  </div>
				</div>	
			</div>
			{{-- <div class="col-md-2 wow flipInY" data-wow-delay="1.4s"> --}}
			<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/booklet/booklets1.jpg" class="card-img-top" height="150px;">
				  <div class="card-body">
				    <a href="/booklets"><p class="card-title">Booklets</h4></p></a>  
				  </div>
				</div>	
			</div>
     </div>

    </div>

    <div class="carousel-item">
      {{-- <img class="d-block w-100" src="..." alt="Second slide"> --}}

     <div class="row" alt="Third slide">
     	<div class="col-md-4"></div>
     	
     	<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/receipt/receipts.jpg" class="card-img-top" height="150px;">
			      <div class="card-body">
				    <a href="/receipts"><p class="card-title">Receipts</h4></p></a>  
				  </div>
				</div>	
		</div>

		<div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/callingcard/callingcards.jpg" class="card-img-top" height="150px;">
			      <div class="card-body">
				    <a href="/callingcards"><p class="card-title">Calling Cards</h4></p></a>  
				  </div>
				</div>	
		</div>

		{{-- <div class="col-md-2">
				<div class="card mb-2 inner">
				  <img src="assets/images/product/planner/planners1.jpg" class="card-img-top" height="150px;">
			      <div class="card-body">
				    <a href="/planners"><p class="card-title">Planner</h4></p></a>  
				  </div>
				</div>	
		</div> --}}


     	<div class="col-md-4"></div>

	 </div>

 </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
		</div>
</div>


	</div>
</div>
</div>
<br>
<br>
<br>

<!-- =================== Meet Our Team ========================================== -->
{{-- <div class="team alert alert-primary" id="team"> --}}
	<div class="team wow slideInRight col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="team">
		
		{{-- <p><strong>We believe these characteristic</strong> should influence everything we doing business</p> --}}

			<h2><span id="titleColorMeet">MEET</span> OUR TEAM</h2>
				<div class="row" id="smallTeam">

					<div class="wow fadeInLeft col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="teamCEO">
						<img src="assets/images/employee/boss.jpg" class="img-respopnsive">
						<h4>President Name</h4>
						<p><b>CEO/President</b></p>
					</div>

					<div class="wow fadeInLeft col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="teamExecutiveAssistant">
						<img src="images/marj.jpg" class="img-respopnsive">
						<h4>Marjorie Giann Cordero</h4>
						<p><b>Executive Assistant</b></p>
					</div>

					<div class="collapse" id="readmoreOurTeam">

						<div class="row" id="ourteamThirdRow">

							<div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamMarketing">
								<img src="assets/images/employee/zybilcristasioson.jpg" class="img-respopnsive">
								<h4>Zybil Crista Sioson</h4>
								<p><b>Marketing</b></p>
						    </div>
							{{-- <div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/blank.jpg" class="img-respopnsive">
								<h4>Second Third Row Name</h4>
								<p><b>Second Third Row Name Position</b></p>
						     </div> --}}
						     <div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/veronicasalvador.jpg" class="img-respopnsive">
								<h4>Veronica Salvador</h4>
								<p><b>Sales Manager</b></p>
						    </div>
							<div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamAccountant">
								<img src="assets/images/employee/accountant.jpg" class="img-respopnsive">
								<h4>Randy Carlos</h4>
								<p><b>Accountant</b></p>
						    </div>
						</div>

						<div class="row" id="ourteamFourthRow">
							
							<div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamMarketing">
								<img src="assets/images/employee/eddiedejumo.jpg" class="img-respopnsive">
								<h4>Eddie Dejumo</h4>
								<p><b>Printing Machine Operator</b></p>
						    </div>
							<div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamMarketing">
								<img src="assets/images/employee/lykamarquez.jpg" class="img-respopnsive">
								<h4>Lyka Marquez</h4>
								<p><b>Graphic Artist</b></p>
						     </div>
							{{-- <div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/veronicasalvador.jpg" class="img-respopnsive">
								<h4>Veronica Salvador</h4>
								<p><b>Sales Manager</b></p>
						    </div> --}}

						    <div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/kimberleetoledo.jpg" class="img-respopnsive">
								<h4>Kimberlee Toledo</h4>
								<p><b>Sales Coordinator</b></p>
						    </div>

						    <div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamAccountant">
								<img src="assets/images/employee/accountingmanager.jpg" class="img-respopnsive">
								<h4>Randy Carlos</h4>
								<p><b>Accounting Manager</b></p>
						    </div>
						    <div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamAccountant">
								<img src="assets/images/employee/marymaymijares.jpg" class="img-respopnsive">
								<h4>Mary May Mijares</h4>
								<p><b>Accounting Auditor</b></p>
						    </div>
						    <div class="wow fadeInLeft col-xl-2 col-lg-2 col-md-2 col-sm-4 col-xs-4 col-4" id="teamAccountant">
								<img src="assets/images/employee/financemanager.jpg" class="img-respopnsive">
								<h4>Mary Grace Ann Amargo</h4>
								<p><b>Finance Manager</b></p>
						    </div>
						</div>


						{{-- <div class="row">
							
							<div class="wow fadeInLeft col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" id="teamSecondThirdRow">
								<img src="assets/images/employee/kimberleetoledo.jpg" class="img-respopnsive">
								<h4>Kimberlee Toledo</h4>
								<p><b>Sales Coordinator</b></p>
						    </div>

						</div> --}}

						<div class="row" id="ourteamSixthRow">
							
							<div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/ciaramayramos.jpg" class="img-respopnsive">
								<h4>Ciara May Carlos</h4>
								<p><b>Sales Executive</b></p>
						    </div>

						    {{-- <div class="wow fadeInLeft col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3" id="teamSecondThirdRow">
								<img src="assets/images/employee/maylenecardoza.jpg" class="img-respopnsive">
								<h4>Maylene Cardoza</h4>
								<p><b>Sales Executive</b></p>
						    </div> --}}

						    <div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/lenetafalla.jpg" class="img-respopnsive">
								<h4>Lene Tafalla</h4>
								<p><b>Sales Executive</b></p>
						    </div>

						    {{-- <div class="wow fadeInLeft col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3" id="teamSecondThirdRow">
								<img src="assets/images/employee/francesclarizalallave.jpg" class="img-respopnsive">
								<h4>Frances Clariza Lallave</h4>
								<p><b>Sales Executive</b></p>
						    </div> --}}

						    <div class="wow fadeInLeft col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4" id="teamSecondThirdRow">
								<img src="assets/images/employee/salesexecutive.jpg" class="img-respopnsive">
								<h4>Mariegold Pascual</h4>
								<p><b>Sales Executive</b></p>
						    </div>

						</div>

					</div>

					{{-- <button class="fas fa-angle-double-down " id="readmoreButtonOurTeam"></button> --}}

					{{-- <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#readmoreOurTeam">Simple collapsible</button> --}}

					<button type="button" class="fas fa-angle-double-down " id="readmoreButtonOurTeam" data-toggle="collapse" data-target="#readmoreOurTeam" onclick="ourTeamButton()"></button>
				</div>


<div class="tree wow bounceIn delay-1s" id="treeTeam">
    <ul>
		<li>
			<a href="#team"><span id="positionFont">CEO/President</span>
			<div id="treeDivHide">
              <img src="assets/images/employee/boss.jpg" id="treeImageHide">
              <h5>President Name</h5>
            </div></a>

			<ul>
				<li>
					<a href="#team"><span id="positionFont">Executive Assistant</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/marjoriegianncordero.jpg" id="treeImageHide">
              <h5>Marjorie Giann Cordero</h5>
            </div>
					</a>
					<ul>
						<li>
					<a href="#team"><span id="positionFont">Marketing</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/zybilcristasioson.jpg" id="treeImageHide">
              <h5>Zybil Crista Sioson</h5>
            </div> </a>
					<ul>
						<li>
							                <a href="#team">
								            <span id="positionFont">Print Machine Operator</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/eddiedejumo.jpg" id="treeImageHide">
                                            <h5>Eddie Dejumo</h5>
                                            </div>
                                            </a>
						</li>
						<li>
							                <a href="#team">
								            <span id="positionFont">Graphic Artist</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/lykamarquez.jpg" id="treeImageHide">
                                            <h5>Lyka Marquez</h5>
                                            </div>
                                            </a>
						</li>
					</ul>
				</li>
				<li>
					{{-- <a href="#team">Second Third Row</a>
					<ul>
						<li> --}}
							<a href="#team"><span id="positionFont">Sales Manager</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/veronicasalvador.jpg" id="treeImageHide">
              <h5>Veronica Salvador</h5>
            </div>
					</a>
							<ul>
								<li>
									<a href="#team"><span id="positionFont">Sales Coordinator</span>
						            <div id="treeDivHide">
                                    <img src="assets/images/employee/kimberleetoledo.jpg" id="treeImageHide">
                                    <h5>Kimberlee Toledo</h5>
                                    </div>
					                </a>
									<ul>
										<li>
									        <a href="#team"><span id="positionFont">Sales Executive</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/ciaramayramos.jpg" id="treeImageHide">
                                            <h5>Ciara May Ramos</h5>
                                            </div>
					                        </a>
								        </li>
								        
								        {{-- <li>
									        <a href="#team"><span id="positionFont">Sales Executive</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/maylenecardoza.jpg" id="treeImageHide">
                                            <h5>Maylene Cardoza</h5>
                                            </div>
                                            </a>
                                        </li> --}}
					{{-- </a> --}}
								        {{-- </li> --}}

								        <li>
									        <a href="#team"><span id="positionFont">Sales Executive</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/lenetafalla.jpg" id="treeImageHide">
                                            <h5>Lene Tafalla</h5>
                                            </div>
                                            </a>
								        </li>

								        {{-- <li>
									        <a href="#team"><span id="positionFont">Sales Executive</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/francesclarizalallave.jpg" id="treeImageHide">
                                            <h5>Frances Clariza Lallave</h5>
                                            </div>
                                            </a>
								        </li> --}}

								        <li>
									        <a href="#team"><span id="positionFont">Sales Executive</span>
						                    <div id="treeDivHide">
                                            <img src="assets/images/employee/salesexecutive.jpg" id="treeImageHide">
                                            <h5>Mariegold Pascual</h5>
                                            </div>
                                            </a>
								        </li>

								        

									</ul>
								</li>
							</ul>
						</li>
						{{-- <li><a href="#">Grand Child</a></li> --}}
					{{-- </ul>
				</li> --}}
				<li>
					<a href="#team"><span id="positionFont">Accountant</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/accountant.jpg" id="treeImageHide">
              <h5>Randy Carlos</h5>
            </div>
					</a>
					<ul>
						{{-- <li>
							<a href="#team"><span id="positionFont">Accounting Manager</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/accountingmanager.jpg" id="treeImageHide">
              <h5>Randy Carlos</h5>
            </div>
					</a>
						</li> --}}

						<li>
							<a href="#team"><span id="positionFont">Accounting Auditor</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/marymaymijares.jpg" id="treeImageHide">
              <h5>Mary May Mijares</h5>
            </div>
					</a>
						</li>

						<li>
							<a href="#team"><span id="positionFont">Finance Manager</span>
						<div id="treeDivHide">
              <img src="assets/images/employee/financemanager.jpg" id="treeImageHide">
              <h5>Mary Grace Ann Amargo</h5>
            </div>
					</a>
						</li>

					</ul>
				</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</div>

{{-- <ol class="organizational-chart">
  <li>
    <div>
      <h1>Primary</h1>
      <img src="assets/images/employee/boss.jpg" id="imageHideJs">
      <h5>Boss Name</h5>
      <h6>President/CEO</h6>
    </div>


  </li>


</ol> --}}

</div>

<br>
<br>

<!-- ===================== Contact Us ================================== -->
	<div class="contact wow rollIn" id="contact">
		<div class="container wow slideInLeft" data-wow-delay="1s" id="borderContactUs">
				<h2 class="animated infinite heartBeat"><span id="titleColorAboutUs">MESSAGE</span> US</h2>
				<p id="titleContact1">We're here to help and answer any question you might have</p>
				<p id="titleContact">We look forward to hearing from you</p>
			<div class="row">
				<div class="col-lg-6 col-md-6 formMsg">
					  <label class="sr-only" for="inlineFormInputGroupUsername">username</label>
				      <div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text"><i class="fas fa-user"></i></div>
				        </div>
				        <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
				      </div>

				      <label class="sr-only" for="inlineFormInputGroupUsername" id="email">email address</label>
				      <div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text"><i class="fas fa-envelope"></i></div>
				        </div>
				        <input type="text" class="form-control" id="email" name="email" placeholder="Email address">
				      </div>

				      <div class="input-group">
				      	<textarea id="message" name="message" cols="80" rows="6" class="form-control" ></textarea>
				      </div>
				      <button type="button" class="btn btn-lg submitMsg" id="btnSubmitContactUs">Send Your Message</button>
				    </div>
			
				<div class="col-lg-6 col-md-6 formMap wow fadeIn" data-wow-delay="2s">

				<button type="button" class="btn btn-primary btnChangeLocation col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5" id="tandangsora">Tandang sora</button>
				<button type="button" class="btn btn-secondary btnChangeLocation col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5" id="quirino">Quirino Hwy</button>

					<iframe id ="mapLocation" src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d18358.998038663947!2d121.03231683731941!3d14.68407191779982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3397b644af22fd13%3A0x21810b16fa5226c7!2sCipher%20Fusion%20Philippines%2C%202nd%20Floor%2C%20Unit%20E%2C%20Citiplaza%202%2C%20Tandang%20Sora%20Ave%2C%20Quezon%20City%2C%201107%20Metro%20Manila!3m2!1d14.6760708!2d121.0449331!4m5!1s0x3397b6d6227c5aa3%3A0x88e67ea174c8f48b!2sTandang%20Sora%2C%20Quezon%20City%2C%20Metro%20Manila!3m2!1d14.6819218!2d121.0421102!5e0!3m2!1sen!2sph!4v1568147756830!5m2!1sen!2sph" height="265" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				</div>		
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>

@endsection


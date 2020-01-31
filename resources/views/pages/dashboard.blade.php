@extends('layouts.template')
<style>

.ft-P{

	font-weight: bold;
}




</style>
@section('content')
<section class="content">

		{{-- <span id="span"></span> --}}

		<div class="container-fluid">
			<div class="block-header">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ul class="breadcrumb breadcrumb-style">
							<li>
								<h4 class="page-title">Dashboard</h4>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xl-8">
					<div class="card">
						<div class="header">
							<h2>
								<strong>This Year Monthly Sales</strong> Chart</h2>
						</div>
						<div class="body">
							<div class="recent-report__chart">
								<div id="barChart" style="height:450px"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-xl-4">
					<div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
									<h4 class="m-t-5 m-b-20">Delivery Orders</h4>
								<h3 class="f-w-700 col-green n-counter">{{$delivery_orders}}</h3>
									{{-- <p class="m-b-0">40% High Then Last Month</p> --}}
								</div>
								<div class="col-auto">
									{{-- <div class="chart chart-bar"></div> --}}
								</div>
							</div>
						</div>
                    </div>
                    <div class="card comp-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="m-t-5 m-b-20">Customer Inquiries</h4>
									<h3 class="f-w-700 col-orange">{{$customer_inquiries}}</h3>
                                        {{-- <p class="m-b-0">10% Less Then Last Month</p> --}}
                                    </div>
                                    <div class="col-auto">
                                        {{-- <div class="chart chart-pie"></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
					<div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
									<h4 class="m-t-5 m-b-20">Purchased Order</h4>
									<h3 class="f-w-700 col-orange">{{$purchase_order}}</h3>
									{{-- <p class="m-b-0">10% Less Then Last Month</p> --}}
								</div>
								<div class="col-auto">
									{{-- <div class="chart chart-pie"></div> --}}
								</div>
							</div>
						</div>
					</div>
					<div class="card comp-card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col">
									<h4 class="m-t-5 m-b-20">Intransit Orders</h4>
								<h3 class="f-w-700 col-cyan">{{$intransit_order}}</h3>
									{{-- <p class="m-b-0">13% High Then Last Month</p> --}}
								</div>
								<div class="col-auto">
									{{-- <div class="chart compositebar"></div> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5">
					<div class="card">
						<div class="header">
							<h2>
								<strong>Warehouse</strong> Stock Value</h2>
						</div>
						<div class="body">
							<div class="table-responsive" style="height:350px">
								<table class="table table-hover">
									<thead>
										<tr class="text-center">
											
											<th>Warehouse</th>
											<th>No of Stock</th>
											<th>Stock Value</th>
											
										</tr>
									</thead>
									<tbody>
										@foreach ($warehouse_sum as $warehouse)
											<tr>
											<td class = "text-center">{{$warehouse->warehouse_name}}</td>
											<td class = "text-center" style="font-weight: bold;">{{number_format($warehouse->total_stock)}}</td>
											<td class = "text-center" style="font-weight: bold;">{{number_format($warehouse->total_value)}}</td>
											</tr>			   
										@endforeach
										
										
									</tbody>
									
								</table>
							</div>
						</div>
					</div>
				</div>


{{-- Pie chart --}}
					<div class="col-lg-7">
						<div class="card">
							<div class="header">
									<h2><strong>This Month</strong> Sales & Expenses</h2>
							</div>
								<div class="body">
										<div id="SalesExpensesChart" style="height:350px"></div>

							</div>
						</div>
					</div>
			</div>

			<div class="row">
				<!-- line chart -->
				<div class="col-lg-5">
						{{-- <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5"> --}}
					<div class="card">
						<div class="header">
							<h2><strong>Daily Sales</strong> Chart</h2>
						</div>
						<div class="body">
							<div class="row text-center p-t-10">
								<div class="col-sm-4 col-6">
									<h4 class="margin-0">{{number_format($sales['today'])}} </h4>
									<p class="text-muted"> Today's Gross Income</p>
									<h4 class="margin-0">{{number_format($sales['net_today'])}} </h4>
									<p class="text-muted"> Today's Net Income</p>
								</div>
								
								<div class="col-sm-4 col-6">
									<h4 class="margin-0">{{number_format($sales['week'])}} </h4>
									<p class="text-muted">This Week's Gross Income</p>
									<h4 class="margin-0">{{number_format($sales['net_week'])}} </h4>
									<p class="text-muted">This Week's Net Income</p>
								</div>
								<div class="col-sm-4 col-6">
									<h4 class="margin-0 ">{{number_format($sales['month'])}} </h4>
									<p class="text-muted">This Month's Gross Income</p>
									<h4 class="margin-0 ">{{number_format($sales['net_month'])}} </h4>
									<p class="text-muted">This Month's Net Income</p>
								</div>
							</div>
							<div id="amchartLineDashboard" class="amChartHeight"></div>
						</div>
					</div>
				</div>
				<!-- Bar chart with line -->
				{{-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="card">
						<div class="header">
							<h2><strong>Revenue</strong> Chart</h2>
						</div>
						<div class="body">
							<div id="dumbbellPlotChart" class="amChartHeight"></div>
						</div>
					</div>
				</div> --}}
				<div class="col-lg-7" >
						{{-- <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7"> --}}
				<div class="card" style="height:550px">
					<div class="header">
							<h2><strong>Today's</strong> Sales Chart</h2>
					</div>
						<div class="body">
								 <div id="saleschart" style="height:350px"></div> 

					</div>
				</div>
				</div>

				
			</div>

			<div class="card">
				<div class="header">
					<h2>
						<strong>Post Dated </strong> Cheque</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable center">
							<thead>
								<tr class="text-center">
									
									<th style="width:150px">Encashment Date</th>
									<th>Amount</th>
									<th>Payee</th>
									<th>Details</th>
								</tr>
							</thead>
							<tbody id="c-list">
							
							
							</tbody>
							
						</table>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="header">
					<h2>
						<strong>Product Watchlist </strong></h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						
						<table
						class="table table-bordered table-striped table-hover js-basic-example dataTable center">
						<thead>
							<tr>
								<th>Product Code</th>
								<th>Product Name</th>
								<th>Description</th>
								<th>Total Available</th>
								<th>Total On Hand</th>
								<th>Total Value</th>
								<th>Remove</th>
								
							   
							</tr>
						</thead>
						<tbody id="t-watchlist">
						 
				   
						</tbody>
						
					</table>
					</div>
				</div>
			</div>


			<div class="card">
				<div class="header">
					<h2>
						<strong>Product Stock On HAND</strong></h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						
						<table
						class="table table-bordered table-striped table-hover js-basic-example dataTable center">
						<thead>
							<tr>
								<th>Product Code</th>
								<th>Product Name</th>
								<th>Description</th>
								<th>Total Available</th>
								<th>Total On Hand</th>
								<th>Total Value</th>
								<th>To Watchlist</th>
								
							   
							</tr>
						</thead>
						<tbody>
						  @foreach ($totalstock as $stock)
						  <tr>
						  <td class="text-center ft-P">{{$stock->product_code}}</td>
						  <td class="text-center ft-P">{{$stock->product_name}}</td>
						  <td class="text-center ft-P">{{$stock->description}}</td>
						  <td class="text-center ft-P">{{$stock->total_available}}</td>
						  <td class="text-center ft-P">{{$stock->total_stock}}</td>
						  <td class="text-center ft-P">{{number_format($stock->total_value)}}</td>
						  <td class="text-center">
							<button type="button" onclick="store_product(this)" value="{{$stock->product_id}}"
								class="btn btn-info btn-circle waves-effect waves-circle waves-float">
								<i class="material-icons">add</i>
							</button>
						  </td>
						  
						  </tr>
							  
						  @endforeach
				   
						</tbody>
						
					</table>
					</div>
				</div>
			</div>

		</div>
		


	</section>
    
@endsection
@section('js')
	<script src="{{asset('assets/js/bundles/amcharts4/core.js')}}"></script>
	<script src="{{asset('assets/js/bundles/amcharts4/charts.js')}}"></script>
	<script src="{{asset('assets/js/bundles/amcharts4/animated.js')}}"></script>
	<script src="{{asset('assets/js/pages/dashboard/dashboard2.js')}}"></script>
	<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
	<script src="{{asset('assets/js/table.min.js')}}"></script>
	<script src="{{asset('assets/js/pages/ui/notifications.js')}}"></script>
	<script>



$(function() {

	function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};


	function padDigits(number, digits) {
	  return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
	}


	const mylist = ()=>{

		fetch('/watchlist/products')
			.then((res) => res.json())
				.then((data) => {
					
					console.log(data);
					$('#t-watchlist').empty();
					data.forEach( wlist => {
						
						if (Number(wlist.total_available) <= Number(wlist.watch_qty)) {
							$('#t-watchlist').append('<tr>'+
						'<td class="text-center text-danger ft-P">'+wlist.product_code+'</td>'+
						'<td class="text-center text-danger ft-P">'+wlist.product_name+'</td>'+
						'<td class="text-center text-danger ft-P">'+wlist.description+'</td>'+
						'<td class="text-center text-danger ft-P">'+wlist.total_available+'</td>'+
						'<td class="text-center text-danger ft-P">'+wlist.total_stock+'</td>'+
						'<td class="text-center text-danger ft-P">'+formatMoney(wlist.total_value)+'</td>'+
						'<td class="text-center ft-P"><button type="button" onclick="remove_list(this)" value="'+wlist.product_id+'"'+
								'class="btn btn-danger btn-circle waves-effect waves-circle waves-float"><i class="material-icons">remove</i></button></td>'+
						'</tr>');
						}else{

						$('#t-watchlist').append('<tr>'+
						'<td class="text-center ft-P">'+wlist.product_code+'</td>'+
						'<td class="text-center ft-P">'+wlist.product_name+'</td>'+
						'<td class="text-center ft-P">'+wlist.description+'</td>'+
						'<td class="text-center ft-P">'+wlist.total_available+'</td>'+
						'<td class="text-center ft-P">'+wlist.total_stock+'</td>'+
						'<td class="text-center ft-P">'+formatMoney(wlist.total_value)+'</td>'+
						'<td class="text-center ft-P"><button type="button" onclick="remove_list(this)" value="'+wlist.product_id+'"'+
								'class="btn btn-danger btn-circle waves-effect waves-circle waves-float"><i class="material-icons">remove</i></button></td>'+
						'</tr>');
						}

					});

					
				})
	}
	
	mylist();
});

//watchlist function 
const send_data = async (res,url) => {
  
  const settings = {
	method: 'POST',
	body: JSON.stringify(res),
	headers: {
	  'Accept': 'application/json',
	  'Content-Type': 'application/json',
	  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	  
	}
  }

  const response = await fetch(url, settings);

  try {
	const data = await response.json();
	console.log(data);
  } catch (err) {
	throw err;
  }
};


const store_product = (id)=>{

	const pid = id.value;

// 	Swal.fire({
//   title: 'Enter Number of Stock Warning',
//   input: 'text',
//   inputAttributes: {
//     autocapitalize: 'off'
//   },
//   showCancelButton: true,
//   confirmButtonText: 'Look up',
//   showLoaderOnConfirm: true,
//   preConfirm: (num) => {
	 
// 	 if (Number(num) == Nan || num == 0) {
		 
// 	 } else {
		 
// 	 }
    
//   }


// })
	Swal.fire({
        title: 'Are you sure?',
        text: "You want to Add This to Watchlist?",
        type: 'info',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Add Product!'
        }).then((result) => {
        if (result.value) {

			Swal.fire({
			title: 'Enter Number of Stock Warning',
			input: 'text',
			inputAttributes: {
				autocapitalize: 'off'
			},
			showCancelButton: true,
			confirmButtonText: 'Add to Watchlist',
			showLoaderOnConfirm: true,
			preConfirm: (num) => {
					if (isNaN(num)) {
						console.log('cancel');
					}
					else{	
				
					var res = {"pid":pid,"wstock":num};
					const url = '/watchlist/store/product';
					send_data(res,url);  
						setTimeout(function(){ location.href = '/dashboard'; }, 1500);
					}
					// })



					}
				
			})
				
			}
            // Swal.fire(
            // 'Confirm! Half Way There!',
            // 'Click OK to Procced!',
            // 'success'
            // ).then((result) =>{
            //     if(result.value){
    
			// var res = {"pid":pid};
			// const url = '/watchlist/store/product';
			// send_data(res,url);  
			// 	 setTimeout(function(){ location.href = '/dashboard'; }, 1500);
            //     }
            // })


        })
    }

// })
// }



const remove_list = (id) => {

	const pid = id.value;
	Swal.fire({
        title: 'Are you sure?',
        text: "You want to Remove This to Watchlist?",
        type: 'error',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Remove Product!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){
    
			var res = {"pid":pid};
			const url = '/watchlist/remove/product';
			send_data(res,url);  
				 setTimeout(function(){ location.href = '/dashboard'; }, 1500);
                }
            })
        }
    })
}

$('.n-counter').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
    duration: 1000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter));
    }
  });
});



</script>
	
@endsection
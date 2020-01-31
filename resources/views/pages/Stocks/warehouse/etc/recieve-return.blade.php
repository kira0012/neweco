@extends('layouts.template')
@section('htmlhead')
<link href="{{asset('assets/css/form.min.css')}}" rel="stylesheet">
{{-- <link href="../../\assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet" /> --}}
    
@endsection
<style>
.modal-header{
    background-color: #007bff;
    margin-left: -10px;
    margin-right: -10px;
    margin-top: -12px;
}
.mcontent{

    margin-left: -20px;
    margin-right: -20px;
}
#imgp{

    width: 350px;
    height: 280px;
}
#txtheader{
    text-align: center;
}
#view-content{
    margin-top: 50px;
}

#print-logo{
    height:200; 
    width:100%;
    display: block;
    margin: 0 auto;
}
#report-print{
    box-shadow: 3px 3px 3px 3px;
}

.drno{
    float:right;
    margin-right: 50px;
}


.dr{

    color: red;
}

#logo-name{

    margin-top: 35px;
    margin-left: -55px;
}
.dr-code{

width: 100px !important;
}

@media print {
    /* .card {  position: relative !important; display: block; 
          box-sizing: content-box !important;
    } */
    @page {
    size: auto;  
    margin: 0;  
  }
  /* .pbr{
    page-break-after: always;
  } */
  body * {
    visibility: hidden;
    padding-left: 1.3mm;
    padding-right: 1.3mm; 
    padding-top: 1.1mm;
  }
  
  .report-print * {
    visibility: visible;
    font-size: 20px;
  }
  .report-print {
    width:100%;
    border:0px;
    position: fixed;
    left: 0;
    top: -40;
  }
  #hlogo{

      margin-right: -50px;
  }
  .bot{
    position: fixed;
    bottom: 10px;
    width: 100%;
  }

  .bot-content{

      position: absolute;
      bottom: 10px;
      width: 100%;
  }
  .td-bot{
      width: 50%;
  }
  .dr-title{
      font-size: 25px;
      margin-top: -20px;
  }
  .body {
      margin-top: -35px;
  }

  .dr{
      margin-top: -50px;
  }
  .pbr{
    page-break-after:always;
  }

  .dr-desc{

      width: 60% !important;
  }
  .dr-code{

      width: 150px !important;
  }

  .tb-content, .tb-content td,.tb-content th{

    border: 2px solid black !important;
    
  }

  

  
}

</style>
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                {{-- <h4 class="page-title">Banking Report</h4> --}}
                            </li>
                         
                        </ul>
                      <input type="hidden" value="{{$rtnid}}" id="rtnid" />
                        @can('Customers')
                            @if ($rtninfo->recieve_date == null)
                                <button class="btn-hover btn-border-radius color-8" id="recieve-all" style="float:right"><i data-feather="box" style="height:15px"></i> <span>Recieve </span></button>              
                            @endif  
                        @endcan             
                        <button class="btn-hover btn-border-radius color-8" id="print-report" style="float:right"><i data-feather="printer" style="height:15px"></i> <span>Print </span></button>
                                         
                    </div>
                </div>
            </div>
            <div class="report-print" id="report-print">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-12" id="pheader">
                                        <img src="{{asset('assets/images/logowithheader.png')}}" id="print-logo" />
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="drno">
                                            {{-- <h5 class="dr">DR NO:{{str_pad($DrDetails->id,8,"0",STR_PAD_LEFT)}}</h5>
                                    </div> --}}
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                      
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                    <table class="table tb-content">
                                            <thead>
                                                   <tr>
                                                   <input type="hidden" value="" id="s-id" />
    
                                                   <td class="tb-content" colspan="6"><b>Supplier:</b>{{$Supplier->supplier}} </td>  
                                                   <td class="tb-content" colspan="2"><b>DATE:</b> {{$rtninfo->return_date}} </td>
                                                   </tr>
                                                
                                                   <tr>
                                                        
                                                    <td class="tb-content" colspan="3"><b>RTN No:</b> RTN-{{str_pad($rtninfo->id,6,"0",STR_PAD_LEFT)}}</td>
                                                   <td class="tb-content" colspan="3"><b>Recieve Date</b>{{$rtninfo->recieve_date}}</td>
                                                   <td class="tb-content" colspan="2"><b>Returned BY:</b> {{$rtnby->name}}</td>
                                                    </tr>
                                                   
                                                   <tr>
                                                       <td colspan="8"><h6></h6></td>
                                                   </tr>
                                                   <tr>
                                                   <th class="text-center dr-code" colspan="3">Stock Code</th>
                                                   <th class="text-center" colspan = "3">Product Name</th> 
                                                   <th class="text-center">Product Description</th>
                                                   <th class="text-center">Qty</th>
                                                  
                                                  
                                                  
                                                   </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rtnproducts as $rtnproduct)
                                                <tr>
                                                <td class="text-center" colspan="3">ST-{{str_pad($rtnproduct->stock_id,8,"0",STR_PAD_LEFT)}}</td>
                                                <td class="text-center" colspan="3">{{$rtnproduct->product_name}}</td>
                                                <td class="text-center" >{{$rtnproduct->description}}</td>
                                                <td class="text-center">{{$rtnproduct->qty}}</td>
                                                </tr>
                                                    
                                                @endforeach
                                              
                                             
                                               
                                            </tbody>
                                           
                                        </table>
                            </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </div>

    <script>
           window.onload = function () {
                $('.nav-inventory').click();
                $('.nav-warehouse-inventory').addClass('active');
                $('.nav-send-back').addClass('active');
            
                $.each($(".menu .list li.active"), function(i, val) {
                  var $activeAnchors = $(val).find("a:eq(0)");
                  console.log('1');
                  console.log($activeAnchors);
                  $activeAnchors.addClass("toggled");
                  $activeAnchors.next().show();
                });
            
            }
            
            </script>

    </section>
{{-- Modals --}}     
      
@endsection
@section('js')
    

<script src="{{asset('assets/js/table.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/js/form.min.js')}}"></script>


<script>

function sum(input){    
if (toString.call(input) !== "[object Array]")
    return false;
    
    var total =  0;
    for(var i=0;i<input.length;i++)
    {                  
        if(isNaN(input[i])){
        continue;
        }
        total += Number(input[i]);
    }
    return total;
}


$('#print-report').on('click', function(){
    window.print();
    
})

$('#recieve-all').on('click',()=>{

    const rtnid = $('#rtnid').val();

    

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        animation: false,
        customClass: {
            popup: 'animated tada'
        },
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Recieve Return!'
        }).then((result) => {
        if (result.value) {
            Swal.fire(
            'Confirm! Half Way There!',
            'Click OK to Procced!',
            'success'
            ).then((result) =>{
                if(result.value){
                    const rid = {"rtnid":rtnid};
                    RecieveReturn(rid);
                   
                   
                }
            })
        }
    })

});

const RecieveReturn = async (rid) => {
  
  const settings = {
    method: 'POST',
    body: JSON.stringify(rid),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      
    }
  }

  const response = await fetch('/supplier/return-recieve', settings);

  try {
    const data = await response.json();

        if (data == 'done') {

            Swal.fire(
            'Recieve Successfully!',
            'Confirm!',
            'success'
            )
            setTimeout(function(){ location.href = '/sendback/product-order'; }, 1500);
        }else{
            Swal.fire(
            'Recieve Unsuccessfully!',
            'Confirm!',
            'error'
            )
            console.log('error');
        }
        
  } catch (err) {
    throw err;
  }
};

</script>

@endsection
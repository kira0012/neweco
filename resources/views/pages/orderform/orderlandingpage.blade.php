@extends('apps.app')
@section('content')

<div class="orderlandingpage" id="orderlandingpage">
	<div class="container" id="containerOrderLandingPage">
		<h1><span id="titleAboutUs">Thank you</span> for reaching us!</h1>
				<div class="loader"></div>
		<h5>Please wait for a moment..</h5>
	</div>
	
</div>

<script type="text/javascript">
	setTimeout(function(){ location.href='/home'; }, 3000);
</script>

@endsection
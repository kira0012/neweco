@if ($errors->any())
<div class="alert bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul>
        @foreach ($errors->all() as $error)
     
           <li> Ops {{ $error }} </li>
        @endforeach    
    </ul>
</div>
@endif

@if ($flash = session('success'))
<div class="alert bg-green alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success!</strong> {{$flash}}
</div>
@endif

@if ($flash = session('info'))
<div class="alert bg-teal alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Info!</strong>  {{ $flash }}
</div>      
@endif


@if ($flash = session('error'))
<div class="alert bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Error!</strong>  {{ $flash }}
</div>
@endif



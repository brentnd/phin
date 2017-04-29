@extends('layout')

@section('title', 'Home page')

@section('body')
<header>
    <div class="container intro-text">
	    @if (session('redirect'))
	        <div class="alert alert-dismissible alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            <strong><i class="fa fa-info-circle"></i> </strong>
	            {{ session('redirect') }}
	        </div>
	    @endif
        <h3>Another {{ config('site.name') }} site.</h3>
        <h1>See the rest</h1>
        <a href="#services" class="page-scroll btn btn-lg btn-primary">Learn More</a>
    </div>
</header>
<section id="services">
    @include('pages.partials.services', compact('services'))
</section>
@endsection
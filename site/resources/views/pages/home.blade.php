@extends('layout')

@section('title', 'Home page')

@section('body')
<header>
    <div class="container intro-text">
        <h3>Another {{ config('site.name') }} site.</h3>
        <h1>See the rest</h1>
        <a href="#services" class="page-scroll btn btn-lg btn-primary">Learn More</a>
    </div>
</header>
<section id="services">
    @include('pages.partials.services', compact('services'))
</section>
@endsection
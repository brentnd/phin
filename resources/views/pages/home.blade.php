@extends('layout')

@section('title', 'Home page')

@section('body')
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Another Phine site..</div>
            <div class="intro-heading">See the rest</div>
            <a href="#services" class="page-scroll btn btn-xl btn-primary">Learn More</a>
        </div>
    </div>
</header>
<section id="services">
    @include('pages.partials.services', compact('services'))
</section>
@endsection
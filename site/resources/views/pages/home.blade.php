@extends('layout')

@section('title', 'Home page')

@section('body')
<section class="hero has-bg-city is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            @if (session('redirect'))
                <div class="notification is-info">
                    <button class="delete"></button>
                    <strong><i class="fa fa-info-circle"></i> </strong>
                    {{ session('redirect') }}
                </div>
            @endif
            <h1 class="title">
                Another {{ config('site.name') }} site.
            </h1>
            <h2 class="subtitle">
                See the rest
            </h2>
            <a href="#services" class="page-scroll button is-primary">Learn More</a>
        </div>
    </div>
</section>
<section id="services" class="section">
    <div class="container has-text-centered">
        <h1 class="title">Services</h1>
        <h2 class="subtitle">
            A list of our stuff
        </h2>
    </div>
    <div class="container">
        @include('pages.partials.services', compact('services'))
    </div>
</section>
@endsection
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
<section class="hero is-info">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-4">
                    <p class="title">Phin Tag</p>
                    <p class="subtitle">Check this big thing out!</p>
                </div>
            </div>
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
<section class="hero is-danger">
    <div class="hero-body">
        <div class="container">
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Tweets</p>
                        <p class="title">3,456</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Following</p>
                        <p class="title">123</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Followers</p>
                        <p class="title">456K</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Likes</p>
                        <p class="title">789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
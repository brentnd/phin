@extends('layout')

@section('title', 'Home page')

@section('body')
<section class="hero has-bg-header is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">
                A {{ config('site.name') }} site.
            </h1>
            <h2 class="subtitle">
                See the rest
            </h2>
            <a href="#section2" class="page-scroll button is-primary">Learn More</a>
        </div>
    </div>
</section>
<section id="section2" class="section">
    <div class="container has-text-centered">
        <h1 class="title">Section 2</h1>
        <h2 class="subtitle">
            Next section
        </h2>
    </div>
</section>
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Services</h2>
            <h3>A list of our stuff</h3>
        </div>
    </div>
    <div class="row text-center auto-clear">
        @foreach($services as $service)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-{!! $service['icon'] !!} fa-stack-1x fa-inverse"></i>
            </span>
            <h4>{!! $service['title'] !!}</h4>
            <p class="text-muted">{!! $service['content'] !!}</p>
        </div>
        @endforeach
    </div>
</div>
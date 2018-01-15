<div class="columns is-multiline">
    @foreach($services as $service)
    <div class="column is-one-third has-text-centered">
        <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-{!! $service['icon'] !!} fa-stack-1x fa-inverse"></i>
        </span>
        <h4>{!! $service['title'] !!}</h4>
        <p class="text-muted">{!! $service['content'] !!}</p>
    </div>
    @endforeach
</div>
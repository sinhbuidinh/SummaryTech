<article id="post-{{ $id }}">
    <div class="panel-content">
        <div class="wrap">
            <header class="entry-header">
                <h2 class="entry-title">{{ $title }}</h2>
            </header>
            @if ($type == 2)
                <div class="entry-content row">
                    <ol class="column left">{!! data_get($data, 'content_left') !!}</ol>
                    <div class="column right">{!! data_get($data, 'content_right') !!}</div>
                </div>
            @else
                <div class="entry-content">
                    <div>{!! data_get($data, 'content') !!}</div>
                </div>
            @endif
        </div>
    </div>
</article>

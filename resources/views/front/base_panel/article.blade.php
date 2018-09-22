<article id="post-{{ $id }}">
    <div class="panel-content">
        <div class="wrap">
            <header class="entry-header">
                <h2 class="entry-title">{{ $title }}</h2>
            </header>
            @if ($type == '2column')
                <div class="entry-content row">
                    <ol class="column left">{!! data_get($data, 'left_data') !!}</ol>
                    <div class="column right">{!! data_get($data, 'right_data') !!}</div>
                </div>
            @else
                <div class="entry-content">
                    <div>{!! $data !!}</div>
                </div>
            @endif
        </div>
    </div>
</article>

<article id="post-{{ $id }}">
    <div class="panel-content">
        <div class="wrap">
            <header class="entry-header">
                <h2 class="entry-title">{{ $title }}</h2>
            </header>
            <div class="entry-content row">
                <ol class="column left">{!! $left_data !!}</ol>
                <div class="column right">{!! $right_data !!}</div>
            </div>
        </div>
    </div>
</article>

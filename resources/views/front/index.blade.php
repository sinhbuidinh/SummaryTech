@extends('front.base.frame')

@section('title', 'Zona thần kinh')
@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/zona/front.css') }}" />
@endsection

@section('content')
    @foreach($articles as $article)
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                @include('front.base_panel.article', [
                    'id'    => data_get($article, 'id'),
                    'type'  => data_get($article, 'column_type'),
                    'title' => data_get($article, 'title'),
                    'data'  => [
                        'content'       => data_get($article, 'content'),
                        'content_left'  => data_get($article, 'content_left'),
                        'content_right' => data_get($article, 'content_right')
                    ],
                ])
            </main>
        </div>
    </div>
    @endforeach
@endsection

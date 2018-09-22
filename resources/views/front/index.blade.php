@extends('front.base.frame')

@section('title', 'Zona thần kinh')
@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/zona/front.css') }}" />
@endsection

@section('content')
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            @include('front.base_panel.article', [
                'id'    => $id,
                'type'  => $type,
                'title' => $title,
                'data'  => $article_data,
            ])
        </main>
    </div>
</div>
@endsection

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
                'id'         => $id,
                'title'      => $title,
                'left_data'  => $left_data,
                'right_data' => $right_data,
            ])
        </main>
    </div>
</div>
@endsection

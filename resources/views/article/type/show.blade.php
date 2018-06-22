@extends('layout.base')

@section('title', 'article type')
@section('title_page', 'List article_type')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/article/create_type.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/article/create_type.js') }}"></script>
@endsection

@section('content')
<div class="row list_article table-responsive">
    <table class="table table-bordered table-striped w80_percent">
        <thead>
          <tr>
            <th class="w10_percent">ID</th>
            <th class="w40_percent">Name</th>
            <th class="w10_percent">Lang</th>
          </tr>
        </thead>
        <tbody>
            @foreach($list as $article)
            <tr>
              <td>{{ $article->id }}</td>
              <td>{{ $article->name }}</td>
              <td>{{ $article->lang_disp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
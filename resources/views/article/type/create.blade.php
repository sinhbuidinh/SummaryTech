@extends('layout.base')

@section('title', 'article type')
@section('title_page', 'Create article_type')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/article/create_type.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/article/create_type.js') }}"></script>
@endsection

@section('content')
@if (!empty($validate_result['message']))
    <div class='row'>
        {!! parseMessage($validate_result['message']) !!}
    </div>
@endif
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('article_create_type') }}"
          method="post">
        @csrf
        <div class="row">
            <label class="control-label col-sm-2" for="article_name">Name:</label>
            <div class="col-sm-5">
              <input type="text"
                     class="form-control"
                     id="article_type_form_name"
                     name="article_type_form[name]"
                     placeholder="Input article type name"
                     value="{{ old('article_type_form[name]', $article_type_form['name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="lang_disp">Lang:</label>
            <div class="dropdown col-sm-5">
                <button id="article_type_form_lang_id"
                        class="btn btn-primary dropdown-toggle"
                        type="button"
                        data-toggle="dropdown">Languages</button>
                <ul class="dropdown-menu" id='lang_id'>
                    <li value="0" data-lang-name="Default"><a href="#default">Default</a></li>
                    <li class="divider"></li>
                    <li value="1" data-lang-name="English"><a href="#eng">English</a></li>
                    <li value="2" data-lang-name="Japanese"><a href="#ja">Japanese</a></li>
                </ul>
            </div>
            <input type='hidden' name="article_type_form[lang_id]" value="{{ old('article_type_form[lang_id]', $article_type_form['lang_id']) }}" />
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
  </form>
</div>
@endsection
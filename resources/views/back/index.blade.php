@extends('back.layout.base')

@section('title', 'Index Backend')
@section('title_page', 'Quản lý bài viết')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/general/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/order/create.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/general/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/order/create.js') }}"></script>
    <script src="{{ asset('js/order/show.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <form class="form-horizontal"
            style="width: 100%"
            action=""
            method="post">
        @csrf
        <input type="hidden" id="form_name" value="{{ $form_name }}" />
        <input type="hidden" 
               id="{{ $form_name }}_id" 
               name="{{ $form_name }}[id]" 
               value="{{ old( $form_name .'[id]', $$form_name['id'] ?? '') }}"
               />
        <div class="row">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-3" for="{{ $form_name }}_content">Nội dung:</label>
            <div class="col-sm-7">
                <textarea id="{{ $form_name }}_content"
                            name="{{ $form_name }}[content]"
                            placeholder="Enter content here..."
                            rows="4" cols="50">{{ old( $form_name .'[content]', '') }}</textarea>
            </div>
        </div>
        <!--  button -->
        <div class="row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
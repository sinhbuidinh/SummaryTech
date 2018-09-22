@extends('back.layout.base')

@section('title', 'Index Backend')
@section('title_page', 'Quản lý bài viết')

@section('custom_style')
@endsection

@section('custom_script')
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
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Loại hiển thị:</label>
            <div class="col-sm-2">
                <label><input type="radio" name="{{ $form_name }}[column_type]" value="1" /> 1 Côt</label>
                <label><input type="radio" name="{{ $form_name }}[column_type]" value="2" /> 2 Côt</label>
            </div>
        </div>
        <div class="row">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content]" id="content"></textarea>
                <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
                <script>
                    CKEDITOR.replace('content');
                </script>
            </div>
        </div>
        <div class="row">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung trái:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content_left]" id="content_left"></textarea>
                <script>
                    CKEDITOR.replace('content_left');
                </script>
            </div>
        </div>
        <div class="row">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung phải:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content_right]" id="content_left"></textarea>
                <script>
                    CKEDITOR.replace('content_right');
                </script>
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
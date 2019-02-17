@extends('back.layout.base')

@section('title', 'Index Backend')
@section('title_page', 'Quản lý bài viết')

@section('custom_style')
@endsection

@section('custom_script')
@endsection

@section('content')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<div class="row">
    <form class="form-horizontal"
            style="width: 100%"
            action="{{ route('back_article_create') }}"
            method="post">
        @csrf
        <input type="hidden" id="form_name" value="{{ $form_name }}" />
        <input type="hidden" 
               id="{{ $form_name }}_id" 
               name="{{ $form_name }}[id]" 
               value="{{ old( $form_name .'[id]', $$form_name['id'] ?? '') }}"
               />
        <div class="row">
            <label id="label_{{ $form_name }}_title" class="control-label col-sm-2">Tiêu đề bài:</label>
            <div class="col-sm-4">
                <textarea class="form-control" name="{{ $form_name }}[title]" id="title"></textarea>
            </div>
        </div>
        <div class="row">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Loại hiển thị:</label>
            <div class="col-sm-2">
                <label><input type="radio" checked="checked" name="{{ $form_name }}[column_type]" value="1" /> 1 Côt</label>
                <label><input type="radio" name="{{ $form_name }}[column_type]" value="2" /> 2 Côt</label>
            </div>
        </div>
        <div class="row" id="disp_content">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content]" id="content"></textarea>
            </div>
        </div>
        <div class="row" id="disp_content_left">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung trái:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content_left]" id="content_left"></textarea>
            </div>
        </div>
        <div class="row" id="disp_content_right">
            <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung phải:</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="{{ $form_name }}[content_right]" id="content_right"></textarea>
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

<script>
    $(document).ready(function() {
        $('#disp_content').hide();
        $('#disp_content_left').hide();
        $('#disp_content_right').hide();

        var content = $('#content');
        if (content) {
            CKEDITOR.replace('content');
        }
        var content_left = $('#content_left');
        if (content_left) {
            CKEDITOR.replace('content_left');
        }
        var content_right = $('#content_right');
        if (content_right) {
            CKEDITOR.replace('content_right');
        }
        checkColumnType($('input[name="manager_article[column_type]"]:checked'));
        $('input[name="manager_article[column_type]"]').on('click', function (){
            checkColumnType($(this));
        });
    });
    function checkColumnType(column_type_obj)
    {
        var column_type = column_type_obj.val();
        if (parseInt(column_type) === parseInt(1)) {
            $('#disp_content').show();
            $('#disp_content_left').hide();
            $('#disp_content_right').hide();
        } else {
            $('#disp_content').hide();
            $('#disp_content_left').show();
            $('#disp_content_right').show();
        }
    }
</script>
@endsection
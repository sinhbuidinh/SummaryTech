@extends('back.layout.base')

@section('title', 'Article edit')
@section('title_page', 'Chỉnh sửa bài viết')

@section('custom_style')
@endsection

@section('custom_script')
@endsection

@section('content')
    <input type="hidden" 
           id="{{ $form_name }}_id" 
           name="{{ $form_name }}[id]" 
           value="{{ old( $form_name .'[id]', $$form_name['id'] ?? '') }}"
           />
    <div class="row">
        <label id="label_{{ $form_name }}_title" class="control-label col-sm-2">Tiêu đề bài:</label>
        <div class="col-sm-4">
            <textarea class="form-control"
                      name="{{ $form_name }}[title]" 
                      id="title">{!! data_get($article, 'title') !!}</textarea>
        </div>
    </div>
    <div class="row">
        <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Loại hiển thị:</label>
        @php
            $column_type = data_get($article, 'column_type');
            $checked_1 = '';
            $checked_2 = '';
            if ($column_type == 1) {
                $checked_1 = 'checked="checked"';
            } elseif ($column_type == 2) {
                $checked_2 = 'checked="checked"';
            }
        @endphp
        <div class="col-sm-2">
            <label><input type="radio" {{ $checked_1 }} name="{{ $form_name }}[column_type]" value="1" /> 1 Côt</label>
            <label><input type="radio" {{ $checked_2 }} name="{{ $form_name }}[column_type]" value="2" /> 2 Côt</label>
        </div>
    </div>
    <div class="row" id="disp_content">
        <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung:</label>
        <div class="col-sm-7">
            <textarea class="form-control"
                      name="{{ $form_name }}[content]" 
                      id="content">{!! data_get($article, 'title') !!}</textarea>
        </div>
    </div>
    <div class="row" id="disp_content_left">
        <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung trái:</label>
        <div class="col-sm-7">
            <textarea class="form-control"
                      name="{{ $form_name }}[content_left]" 
                      id="content_left">{!! data_get($article, 'content_left') !!}</textarea>
        </div>
    </div>
    <div class="row" id="disp_content_right">
        <label id="label_{{ $form_name }}_content" class="control-label col-sm-2">Nội dung phải:</label>
        <div class="col-sm-7">
            <textarea class="form-control"
                      name="{{ $form_name }}[content_right]" 
                      id="content_right">{!! data_get($article, 'content_right') !!}</textarea>
        </div>
    </div>
@endsection
@extends('back.layout.base')

@section('title', 'Article Backend')
@section('title_page', 'Danh sách bài viết')

@section('custom_style')
@endsection

@section('custom_script')
@endsection

@section('content')
    @foreach($list as $article)
        <table>
            <thead>
                <td>Action</td>
                <td>Title</td>
                <td>Some content</td>
            </thead>
            <tbody>
                <td>
                    <input type="hidden" 
                        id="{{ $form_name }}_id" 
                        name="{{ $form_name }}[id]" 
                        value="{{ old( $form_name .'[id]', $$form_name['id'] ?? '') }}"
                        />
                </td>
                <td>{!! data_get($article, 'title') !!}</td>
                <td>{{ data_get($article, 'column_type') }}</td>
                <td>{!! data_get($article, 'content') !!}</td>
                <td>{!! data_get($article, 'content_left') !!}</td>
                <td>{!! data_get($article, 'content_right') !!}</td>
            </tbody>
        </table>
    @endforeach
@endsection
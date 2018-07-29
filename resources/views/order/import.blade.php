@extends('layout.base')

@section('title', 'Import Order')
@section('title_page', 'Import data')

@section('custom_style')
@endsection

@section('custom_script')
@endsection

@section('content')
<div class="row">
    <form class="form-horizontal"
            style="width: 100%"
            enctype="multipart/form-data"
            method="post">
        @csrf
        <div class="row">
            <input type="file" id="file_import" name="file_import" />
        </div>
        <div class="row">
            <button type="submit" id="import_btn" class="btn btn-primary">Import</button>
        </div>
    </form>
</div>
@endsection
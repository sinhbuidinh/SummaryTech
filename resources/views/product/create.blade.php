@extends('layout.base')

@section('title', 'Product')
@section('title_page', 'Tạo mới sản phẩm')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
@endsection

@section('custom_script')
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('product_create_post') }}"
          method="post"
          style="width: 100%"
          >
        @csrf
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_deck_type">Loại ván ép:</label>
            <div class="col-sm-5">
                <select name="{{ $form_name }}[deck_type]" id="{{ $form_name }}_deck_type">
                    <option value="0">Default</option>
                    @if (!empty($product_type_list))
                    @foreach ($product_type_list as $product_type)
                    <option value="{{ $product_type['id'] }}">{{ $product_type['name'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_code_name">Tên mã sản phẩm:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_code_name"
                     name="{{ $form_name }}[code_name]"
                     placeholder="Input product code name"
                     value="{{ old( $form_name .'[code_name]', $$form_name['code_name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_is_foreign">Nơi nhập:</label>
            <div class="col-sm-5">
                <select name="{{ $form_name }}[is_foreign]" id="{{ $form_name }}_is_foreign">
                    <option value="0">Nội nhập</option>
                    <option value="1">Ngoại nhập</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_color">Màu:</label>
            <div class="col-sm-5">
                <select name="{{ $form_name }}[color]" id="{{ $form_name }}_color">
                    <option value="0">Default</option>
                    <option value="1">White</option>
                    <option value="2">Red</option>
                    <option value="3">Green</option>
                    <option value="4">Blue</option>
                    <option value="5">Black</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_height">Cao:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="{{ $form_name }}_height"
                     name="{{ $form_name }}[height]"
                     placeholder="Input product height"
                     value="{{ old( $form_name . '[height]', $$form_name['height']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_width">Rộng:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="{{ $form_name }}_width"
                     name="{{ $form_name }}[width]"
                     placeholder="Input product width"
                     value="{{ old( $form_name. '[width]', $$form_name['width']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_length">Dài:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="{{ $form_name }}_length"
                     name="{{ $form_name }}[length]"
                     placeholder="Input product length"
                     value="{{ old($form_name. '[length]', $$form_name['length']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_unit_size">Đơn vị độ dài:</label>
            <div class="col-sm-5">
              <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_unit_size"
                     name="{{ $form_name }}[unit_size]"
                     placeholder="Input product unit_size"
                     value="{{ old($form_name. '[unit_size]', $$form_name['unit_size']) }}"/>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
  </form>
</div>
@endsection
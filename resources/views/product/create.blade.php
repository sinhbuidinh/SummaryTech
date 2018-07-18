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
        <input type="hidden" 
               id="{{ $form_name }}_id" 
               name="{{ $form_name }}[id]" 
               value="{{ old( $form_name .'.id', $$form_name['id'] ?? '') }}"
               />
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_deck_type">Loại ván ép:</label>
            <div class="col-sm-5">
                <select name="{{ $form_name }}[deck_type]" id="{{ $form_name }}_deck_type">
                    <option value="0">Default</option>
                    @if (!empty($product_type_list))
                    @foreach ($product_type_list as $product_type)
                    <option @if ($product_type['id'] == old( $form_name .'.deck_type', $$form_name['deck_type'] ?? 0))
                             selected="selected"
                        @endif
                        value="{{ $product_type['id'] }}">{{ $product_type['name'] }}</option>
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
                    @foreach ($product_color as $code => $name)
                    <option @if (old( $form_name . '.color', $$form_name['color']) == $code)
                                selected="selected"
                            @endif
                        value="{{ $code }}">{{ $name }}</option>
                    @endforeach
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
@extends('layout.base')

@section('title', 'Product')
@section('title_page', 'Create new Product')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
@endsection

@section('custom_script')
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
          action="{{ route('product_create') }}"
          method="get">
        @csrf
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_deck_type">Loại ép:</label>
            <div class="col-sm-5">
                <select name="product_form[deck_type]" id="product_form_deck_type">
                    <option value="0">Default</option>
                    <option value="1">Phủ phim</option>
                    <option value="2">Phủ nhựa</option>
                    <option value="3">Phủ keo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_owner">Tên hãng:</label>
            <div class="col-sm-5">
              <select name="product_form[owner]" id="product_form_owner">
                    <option value="0">Default</option>
                    <option value="1">Hoàng Châu</option>
                    <option value="2">HC New</option>
                    <option value="3">HC Wood</option>
                    <option value="4">Chuột Túi</option>
                    <option value="5">FLYWOOD</option>
                    <option value="6">Bò Tót</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_color">Màu:</label>
            <div class="col-sm-5">
              <select name="product_form[color]" id="product_form_color">
                    <option value="0">Default</option>
                    <option value="1">Trắng</option>
                    <option value="2">Đỏ</option>
                    <option value="3">Green</option>
                    <option value="4">Blue</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_length">Dài:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="product_form_length"
                     name="product_form[length]"
                     placeholder="Input product length"
                     value="{{ old('product_form[length]', $product_form['length']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_width">Rộng:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="product_form_width"
                     name="product_form[width]"
                     placeholder="Input product width"
                     value="{{ old('product_form[width]', $product_form['width']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="product_form_height">Cao:</label>
            <div class="col-sm-5">
              <input type="number"
                     class="form-control"
                     id="product_form_height"
                     name="product_form[height]"
                     placeholder="Input product height"
                     value="{{ old('product_form[height]', $product_form['height']) }}"/>
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
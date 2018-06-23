@extends('layout.base')

@section('title', 'Product Type')
@section('title_page', 'Tạo loại ván ép')

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('product_create_type_post') }}"
          method="post"
          style="width: 100%"
          >
        @csrf
        @if (!empty($list_product_type_old))
        <div class="row">
            <label class="control-label col-sm-4" for="{{ $form_name }}_form_name">Danh sách ván ép trước đó:</label>
            <div class="col-sm-3">
                <select>
                    @foreach ($list_product_type_old as $key => $val)
                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_name">Loại ván ép:</label>
            <div class="col-sm-5">
              <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_name"
                     name="{{ $form_name }}[name]"
                     placeholder="Input product type name"
                     value="{{ old($form_name .'[name]', $$form_name['name']) }}"/>
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
@extends('layout.base')

@section('title', 'Product Wood Type')
@section('title_page', 'Tạo loại gỗ')

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('product_wood_type_create_post') }}"
          method="post"
          style="width: 100%"
          >
        @csrf
        <input type="hidden" 
               id="{{ $form_name }}_id" 
               name="{{ $form_name }}[id]" 
               value="{{ old( $form_name .'.id', $$form_name['id'] ?? '') }}"
               />
        @if (!empty($list_wood_type_old))
        <div class="row">
            <label class="control-label col-sm-4" for="{{ $form_name }}_form_name">Danh sách gỗ dùng đã có:</label>
            <div class="col-sm-3">
                <select>
                    @foreach ($list_wood_type_old as $key => $val)
                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_name">Loại gỗ:</label>
            <div class="col-sm-5">
              <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_name"
                     name="{{ $form_name }}[name]"
                     placeholder="Input wood type name"
                     value="{{ old($form_name .'.name', $$form_name['name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2" for="{{ $form_name }}_short_name">Tên ngắn gọn:</label>
            <div class="col-sm-5">
              <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_short_name"
                     name="{{ $form_name }}[short_name]"
                     placeholder="Input wood type name short "
                     value="{{ old($form_name .'.short_name', $$form_name['short_name']) }}"/>
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
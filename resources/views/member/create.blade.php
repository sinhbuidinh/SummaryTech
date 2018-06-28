@extends('layout.base')

@section('title', 'Member')
@section('title_page', 'Tạo mới nhân viên')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
@endsection

@section('custom_script')
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('member_create_post') }}"
          method="post"
          style="width: 100%"
          >
        @csrf
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_name">Tên nhân viên:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_name"
                     name="{{ $form_name }}[name]"
                     placeholder="Input member name"
                     value="{{ old( $form_name .'[name]', $$form_name['name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_address">Địa chỉ:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_address"
                     name="{{ $form_name }}[address]"
                     placeholder="Input member address"
                     value="{{ old( $form_name .'[address]', $$form_name['address']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_telephone">Số điện thoại:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_telephone"
                     name="{{ $form_name }}[telephone]"
                     placeholder="Input member telephone"
                     value="{{ old( $form_name .'[telephone]', $$form_name['telephone']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_group_type">Group nhân viên :</label>
            <div class="col-sm-5">
                <!--list member-->
                <select name="{{ $form_name }}[group_type]" id="{{ $form_name }}_group_type">
                    @foreach ($member_group_list as $code => $group_name)
                    <option value="{{ $code }}"
                            @if (old($form_name.'[group_type]') == $code || $$form_name['group_type'] == $code)
                            selected="selected"
                            @endif
                            >{{ $group_name }}</option>
                    @endforeach
                </select>
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
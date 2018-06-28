@extends('layout.base')

@section('title', 'Customer')
@section('title_page', 'Tạo mới khách hàng')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
@endsection

@section('custom_script')
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('customer_create_post') }}"
          method="post"
          style="width: 100%"
          >
        @csrf
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_company_name">Tên công ty:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_company_name"
                     name="{{ $form_name }}[company_name]"
                     placeholder="Input product company_name"
                     value="{{ old( $form_name .'[company_name]', $$form_name['company_name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_short_name">Mã CTy:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_short_name"
                     name="{{ $form_name }}[short_name]"
                     placeholder="Input product short_name"
                     value="{{ old( $form_name .'[short_name]', $$form_name['short_name']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_address">Địa chỉ:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_address"
                     name="{{ $form_name }}[address]"
                     placeholder="Input product address"
                     value="{{ old( $form_name .'[address]', $$form_name['address']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_telephone">Số điện thoại liên hệ:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_telephone"
                     name="{{ $form_name }}[telephone]"
                     placeholder="Input product telephone"
                     value="{{ old( $form_name .'[telephone]', $$form_name['telephone']) }}"/>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_contact_info">Thông tin người liên hệ:</label>
            <div class="col-sm-5">
                <input type="text"
                     class="form-control"
                     id="{{ $form_name }}_contact_info"
                     name="{{ $form_name }}[contact_info]"
                     placeholder="Input contact info"
                     value="{{ old( $form_name .'[contact_info]', $$form_name['contact_info']) }}" />
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_business_member">Nhân viên quản lý khách hàng:</label>
            <div class="col-sm-5">
                <!--list member-->
                <select name="{{ $form_name }}[business_member]" id="{{ $form_name }}_business_member">
                    <option value="0">Default</option>
                    <option value="1">A linh</option>
                    <option value="2">A Phuong</option>
                    <option value="3">A thanh</option>
                    <option value="4">A Cuong</option>
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
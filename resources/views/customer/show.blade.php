@extends('layout.base')

@section('title', 'Customer list')
@section('title_page', 'Danh sách khách hàng')

@section('custom_style')
@endsection

@section('content')
<!-- display all data -->
<div class="row">
    <form class="form-horizontal"
          action="#"
          method="post"
          style="width: 100%"
          >
        <div class="row">
            <table class="table table-bordered table-striped w100_percent">
                <thead>
                    <tr>
                      <th class="w10_percent">ID</th>
                      <th class="w30_percent">Tên công ty</th>
                      <th class="w20_percent">Mã CTy</th>
                      <th class="w20_percent">Địa chỉ</th>
                      <th class="w10_percent">Số điện thoại liên hệ</th>
                      <th class="w10_percent">Thông tin người liên hệ</th>
                      <th class="w10_percent">Nhân viên quản lý khách hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $customer)
                    <tr>
                        <td>
                            {{ $customer->id }}
                            <a class="btn btn-default btn-sm edit_customer" 
                               href="{{ route('customer_edit', ['customer_id' => $customer->id]) }}" >
                              Edit
                            </a>
                        </td>
                        <th class="w40_percent">{{ $customer->company_name }}</th>
                        <th class="w20_percent">{{ $customer->short_name }}</th>
                        <th class="w10_percent">{{ $customer->address }}</th>
                        <th class="w10_percent">{{ $customer->telephone ?? '' }}</th>
                        <th class="w10_percent">{{ $customer->contact_info }}</th>
                        <th class="w10_percent">{{ $customer->member->name ?? '' }}:{{ $customer->member->telephone ?? '' }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
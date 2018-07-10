@extends('layout.base')

@section('title', 'Order')
@section('title_page', 'Danh sách đơn hàng')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/general/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/order/create.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/general/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/order/create.js') }}"></script>
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <!-- list product -->
    <table class="table table-bordered table-striped w100_percent">
        <thead>
            <tr>
              <th>STT</th>
              <th>Khách hàng</th>
              <th>Ngày xuất hàng</th>
              <th>Địa chỉ giao hàng</th>
              <th>Sản phẩm</th>
              <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>STT</td>
              <td>Khách hàng</td>
              <td>Ngày xuất hàng</td>
              <td>Địa chỉ giao hàng</td>
              <td>Sản phẩm</td>
              <td>Thành tiền</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
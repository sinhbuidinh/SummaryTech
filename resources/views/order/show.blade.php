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
    <script src="{{ asset('js/order/show.js') }}"></script>
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <!-- list product -->
    <table class="table table-bordered table-striped w100_percent">
        <thead>
            <tr>
<!--              <th>STT</th>-->
                <th>Order code</th>
                <th>Order NO</th>
                <th>Ngày xuất hàng</th>
                <th>Ngày tạo order</th>
                <th>Khách hàng</th>
                <th>Địa chỉ giao hàng</th>
                <th>Sản phẩm</th>
                <th>VAT/NOT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
            <tr>
              <!--<td>{{ $index + 1}}</td>-->
              <td>{{ $order->order_code }}</td>
              <td>
                  <form id="edit_{{ $order->id }}" action="{{ route('order_edit', ['order_id' => $order->id]) }}">
                  {{ $order->id }}
                  <input type="hidden" name="order_id" value="{{ $order->id }}" />
                  <button type="submit" 
                          class="btn btn-default btn-sm edit_order" >
                    <!--<span class="glyphicon glyphicon-pencil"></span>-->
                    Edit
                  </button>
                  </form>
              </td>
              <td>{{ $order->date_export }}</td>
              <td>{{ $order->date_create }}</td>
              <td>{{ $order->customer->short_name }}</td>
              <td>{{ $order->address_delivery }}</td>
              <td>
                  <label class="dropdown" for="order_product_detail">Show details<span class="caret"></span></label>
                  <table id="order_product_detail" style="display: none;">
                      <thead>
                          <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                            $rowspan = 0;
                        @endphp
                        @if (!empty($order->orderProduct))
                            @php
                                $rowspan = count($order->orderProduct);
                            @endphp
                            @foreach ($order->orderProduct as $order_product)
                            <tr>
                                <td>{!! $order_product->product->displayName !!}</td>
                                <td>{{ $order_product->number }}</td>
                                <td>{{ $order_product->unit }}</td>
                                <td>{{ $order_product->total }}</td>
                            </tr>
                            @endforeach
                        @endif
                            <tr rowspan="{{ $rowspan }}">
                                <td>Tổng: </td>
                                <td>{{ $order->total_all_number }}</td>
                                <td></td>
                                <td>{{ $order->total_all_price }}</td>
                            </tr>
                      </tbody>
                  </table>
              </td>
              <td>{{ $vat_define[$order->is_vat] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
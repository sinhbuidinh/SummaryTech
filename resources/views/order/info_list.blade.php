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
            @if (!isset($is_search) 
            || (isset($is_search) && $is_search == false)
            )
            <th>Sản phẩm</th>
            @else
            <th>Tổng tiền</th>
            @endif
            <th>VAT/NOT</th>
            <th>Địa chỉ giao hàng</th>
        </tr>
    </thead>
    <tbody>
        @if (blank($orders))
            @php
                $colspan = 8;
                if (!isset($is_search) 
                    || (isset($is_search) && $is_search == false)
                ) {
                    $colspan = 7;
                }
            @endphp
            <tr>
                <td class="text-center" colspan="{{ $colspan }}">Không có đơn hàng {{ $cond_text }}</td>
            </tr>
        @else
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
                          @if (isset($is_search))
                          Detail
                          @else
                          Edit
                          @endif
                        </button>
                    </form>
              </td>
              <td>{{ $order->date_export }}</td>
              <td>{{ $order->date_create }}</td>
              <td>{{ $order->customer->short_name }}</td>
              @if (!isset($is_search) 
                || (isset($is_search) && $is_search == false)
              )
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
              @else
              <td>{{ $order->total_all_price }}</td>
              @endif
              <td>{{ $vat_define[$order->is_vat] }}</td>
              <td>{{ $order->address_delivery }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
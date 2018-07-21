@extends('layout.base')

@section('title', 'Owe Manager')
@section('title_page', 'Quản lý công nợ')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/table_width.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/general/select2.min.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/general/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/order/select_search.js') }}"></script>
    <script src="{{ asset('js/order/show.js') }}"></script>
    <script src="{{ asset('js/order/owe.js') }}"></script>
@endsection

@section('content')
<!-- content owe -->
<div class="row">
    <form method="post" id="search">
        @csrf
        @if (isset($search_by['order_code']))
        <input type="hidden" name="search_by[order_code]" value="{{ $search_by['order_code'] }}" />
        @endif
        @if (isset($search_by['name']))
        <input type="hidden" name="search_by[name]" value="{{ $search_by['name'] }}" />
        @endif
        @if (isset($search_by['date']))
        <input type="hidden" name="search_by[date]" value="{{ $search_by['date'] }}" />
        @endif
        <input type="hidden" name="search_by[is_export]" value="0" />
    </form>
    <div class="row">
        <div class="row w50_percent">
            <label class="control-label col-sm-2" for="order_code">Mã hóa đơn</label>
            <div class="col-sm-2">
                <select id="order_code"
                        class="select_search"
                        name="order_code">
                    <option value="0">Default</option>
                    @if (!empty($list_order))
                        @foreach ($list_order as $order)
                            @if (!empty($order->order_code))
                                <option @if (isset($search_by['order_code']) && $search_by['order_code'] == $order->order_code)
                                        selected="selected"
                                        @endif
                                    value="{{ $order->order_code }}">{{ $order->order_code }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row w50_percent">
            <label class="control-label col-sm-2" for="company">Công ty</label>
            <div class="col-sm-2">
                <select id="company"
                        class="select_search"
                        name="company">
                    <option value="0">Default</option>
                    @if (!empty($list_company))
                        @foreach ($list_company as $customer)
                            @if (!empty($customer->short_name))
                                <option @if (isset($search_by['name']) && $search_by['name'] == $customer->short_name)
                                        selected="selected"
                                        @endif
                                        value="{{ $customer->short_name }}">{{ $customer->short_name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="row w50_percent">
            <label class="control-label col-sm-2" for="date">Ngày</label>
            <div class="col-sm-2">
                @php
                    $date = '';
                    if (isset($search_by['date'])) {
                        $date = $search_by['date'];
                    }
                @endphp
                <input type="date" id="date" name="search_by[date]" value="{{ $date }}" />
            </div>
        </div>
        <div class="row" style="margin-left: 50px;">
            <div class="col-sm-2">
                <button id="export_owe_search" class="btn btn-primary">Export</button>
            </div>
        </div>
    </div>

    <div id="result_search">
        @if (!empty($result_search))
            @include('order.info_list', [
                'orders'    => $result_search,
                'is_search' => $is_search
            ])
        @endif
    </div>
</div>
@endsection

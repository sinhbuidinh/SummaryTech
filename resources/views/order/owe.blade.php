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
    <script src="{{ asset('js/order/owe.js') }}"></script>
@endsection

@section('content')
<!-- content owe -->
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
                            <option value="{{ $order->order_code }}">{{ $order->order_code }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row w50_percent">
        <label class="control-label col-sm-2" for="company">Công ty:</label>
        <div class="col-sm-2">
            <select id="company"
                    class="select_search"
                    name="company">
                <option value="0">Default</option>
                @if (!empty($list_company))
                    @foreach ($list_company as $customer)
                        @if (!empty($customer->id))
                            <option value="{{ $customer->id }}">{{ $customer->short_name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <form method="post" id="search">
        @csrf
    </form>
    @if (!empty($result))
        @foreach ($result as $order)
        @endforeach
    @endif
</div>
@endsection

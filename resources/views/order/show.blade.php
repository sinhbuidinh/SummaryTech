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
    @include('order.info_list')
</div>
@endsection
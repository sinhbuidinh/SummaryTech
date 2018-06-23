<div class="w3-sidebar w3-collapse" id='sidenav' style="top: 0px;">
    <div class="w3-light-grey" id="leftmenuinner">
        <!--class="active"-->
        <h2 class="left"><span class="left_h2">Product Manager</span></h2>
        <a class="{{ classOfLeftMenu('product_list') }}" href="{{ route('product_list') }}">Danh sách sản phẩm</a>
        <a class="{{ classOfLeftMenu('product_create') }}" href="{{ route('product_create') }}">Tạo sản phẩm mới</a>
        <a class="{{ classOfLeftMenu('product_create_type') }}" href="{{ route('product_create_type') }}">Tạo loại ván ép</a>
    </div>
</div>
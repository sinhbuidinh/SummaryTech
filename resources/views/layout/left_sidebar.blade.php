<div class="w3-sidebar w3-collapse" id='sidenav' style="top: 0px;">
    <div class="w3-light-grey" id="leftmenuinner">
        <!--class="active"-->
        <h2 id="product_manager" class="left product"><span class="left_h2">Product Manager</span></h2>
        <a class="product_manager child list {{ classOfLeftMenu('product_list') }}"
           href="{{ route('product_list') }}">Danh sách sản phẩm</a>
        <a class="product_manager child create {{ classOfLeftMenu('product_create') }}"
           href="{{ route('product_create') }}">Tạo sản phẩm mới</a>
        <a class="product_manager child create_type {{ classOfLeftMenu('product_create_type') }}"
           href="{{ route('product_create_type') }}">Tạo loại ván ép</a>
    </div>
</div>
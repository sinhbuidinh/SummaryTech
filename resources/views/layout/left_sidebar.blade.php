<div class="w3-sidebar w3-collapse" id='sidenav' style="top: 0px;">
    <div class="w3-light-grey" id="leftmenuinner">
        <h2 id="order_manager" class="left"><span class="left_h2">Order Manager</span></h2>
        <a class="order_manager child list {{ classOfLeftMenu('order_create') }}"
           href="{{ route('order_create') }}">Tạo mới đơn hàng</a>
        <h2 id="product_manager" class="left product"><span class="left_h2">Product Manager</span></h2>
        <a class="product_manager child list {{ classOfLeftMenu('product_list') }}"
           href="{{ route('product_list') }}">Danh sách sản phẩm</a>
        <a class="product_manager child create {{ classOfLeftMenu('product_create') }}"
           href="{{ route('product_create') }}">Tạo sản phẩm mới</a>
        <a class="product_manager child create_type {{ classOfLeftMenu('product_create_type') }}"
           href="{{ route('product_create_type') }}">Tạo loại ván ép</a>
        <h2 id="customer_manager" class="left"><span class="left_h2">Customer Manager</span></h2>
        <a class="customer_manager child list {{ classOfLeftMenu('customer_list') }}"
           href="{{ route('customer_list') }}">Danh sách khách hàng</a>
        <a class="customer_manager child create {{ classOfLeftMenu('customer_create') }}"
           href="{{ route('customer_create') }}">Tạo khách hàng mới</a>
        <h2 id="member_manager" class="left"><span class="left_h2">Member Manager</span></h2>
        <a class="member_manager child list {{ classOfLeftMenu('member_list') }}"
           href="{{ route('member_list') }}">Danh sách nhân viên</a>
        <a class="member_manager child create {{ classOfLeftMenu('member_create') }}"
           href="{{ route('member_create') }}">Tạo nhân viên mới</a>
    </div>
</div>
<div class="w3-sidebar w3-collapse" id='sidenav' style="top: 0px;">
    <div class="w3-light-grey" id="leftmenuinner">
        <h2 id="order_manager" class="left"><span class="left_h2">Order Manager</span></h2>
        <a class="order_manager child owe {{ classOfLeftMenu('order_owe') }}"
           href="{{ route('order_owe') }}">Quản lý công nợ</a>
        <a class="order_manager child create {{ classOfLeftMenu('order_create') }}"
           href="{{ route('order_create') }}">Tạo mới đơn hàng</a>
        <a class="order_manager child list {{ classOfLeftMenu('order_list') }}"
           href="{{ route('order_list') }}">Danh sách đơn hàng</a>
        @if (classOfLeftMenu('order_edit'))
        <a class="order_manager child edit {{ classOfLeftMenu('order_edit') }}"
           href="#">Chỉnh sửa đơn hàng</a>
        @endif
        <h2 id="product_manager" class="left product"><span class="left_h2">Product Manager</span></h2>
        <a class="product_manager child list {{ classOfLeftMenu('product_list') }}"
           href="{{ route('product_list') }}">Danh sách sản phẩm</a>
        <a class="product_manager child create {{ classOfLeftMenu('product_create') }}"
           href="{{ route('product_create') }}">Tạo sản phẩm mới</a>
        @if (classOfLeftMenu('product_edit'))
        <a class="product_manager child edit {{ classOfLeftMenu('product_edit') }}"
           href="#">Chỉnh sửa sản phẩm</a>
        @endif
        <a class="product_manager child type_list {{ classOfLeftMenu('product_type_list') }}"
           href="{{ route('product_type_list') }}">Danh sách ván ép</a>
        <a class="product_manager child create_type {{ classOfLeftMenu('product_create_type') }}"
           href="{{ route('product_create_type') }}">Tạo loại ván ép</a>
        @if (classOfLeftMenu('product_type_edit'))
        <a class="product_manager child type_edit {{ classOfLeftMenu('product_type_edit') }}"
           href="#">Chỉnh sửa loại ván</a>
        @endif
        <a class="product_manager child wood_type_list {{ classOfLeftMenu('product_wood_type_list') }}"
           href="{{ route('product_wood_type_list') }}">Danh sách loại gỗ</a>
        <a class="product_manager child create_wood_type {{ classOfLeftMenu('product_wood_type_create') }}"
           href="{{ route('product_wood_type_create') }}">Tạo loại gỗ</a>
        <h2 id="customer_manager" class="left"><span class="left_h2">Customer Manager</span></h2>
        <a class="customer_manager child list {{ classOfLeftMenu('customer_list') }}"
           href="{{ route('customer_list') }}">Danh sách khách hàng</a>
        <a class="customer_manager child create {{ classOfLeftMenu('customer_create') }}"
           href="{{ route('customer_create') }}">Tạo khách hàng mới</a>
        @if (classOfLeftMenu('customer_edit'))
        <a class="customer_manager child edit {{ classOfLeftMenu('customer_edit') }}"
           href="#">Chỉnh sửa thông tin khách hàng</a>
        @endif
        <h2 id="member_manager" class="left"><span class="left_h2">Member Manager</span></h2>
        <a class="member_manager child list {{ classOfLeftMenu('member_list') }}"
           href="{{ route('member_list') }}">Danh sách nhân viên</a>
        <a class="member_manager child create {{ classOfLeftMenu('member_create') }}"
           href="{{ route('member_create') }}">Tạo nhân viên mới</a>
        @if (classOfLeftMenu('member_edit'))
        <a class="member_manager child edit {{ classOfLeftMenu('member_edit') }}"
           href="#">Chỉnh sửa thông tin nhân viên</a>
        @endif
    </div>
</div>
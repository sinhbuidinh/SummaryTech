@extends('layout.base')

@section('title', 'Product list')
@section('title_page', 'Danh sách sản phẩm')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/product/show.css') }}" />
@endsection

@section('content')
<!-- display all data -->
<div class="row">
    <form class="form-horizontal"
          action="#"
          method="post"
          style="width: 100%"
          >
        <div class="row">
            <table class="table table-bordered table-striped w100_percent">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th class="w40_percent">Loại ván</th>
                      <th class="w10_percent">Loại gỗ</th>
                      <th class="w40_percent">Tên sản phẩm</th>
                      <th class="w10_percent">Nội nhập/Ngoại nhập</th>
                      <th class="w10_percent">Màu</th>
                      <th class="w10_percent">(Cao)x(Rộng)x(Dài)(đơn vị)</th>
                      <th class="w10_percent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $deck_type[$product->deck_type]['name'] }}</td>
                      <td>{{ $product->woodTypeName }}</td>
                      <td>{{ $product->code_name }}</td>
                      <td>{{ $product_come_from[$product->is_foreign] }}</td>
                      <td class="text-{{ strtolower($product_color[$product->color]) }}">{{ $product_color[$product->color] }}</td>
                      <td>{{ $product->height }}x{{ $product->width }}x{{ $product->length }}({{ $product->unit_size }})</td>
                      <td>
                          <a class="btn btn-info btn-sm edit_product" 
                               href="{{ route('product_edit', ['product_id' => $product->id]) }}" >
                            Edit
                          </a>
                          <a class="btn btn-info btn-sm delete_product" 
                               href="{{ route('product_delete', ['product_id' => $product->id]) }}" >
                            Delete
                          </a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
  </form>
</div>
@endsection
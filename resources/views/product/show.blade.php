@extends('layout.base')

@section('title', 'Product list')
@section('title_page', 'Danh sách sản phẩm')

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
                      <th class="w10_percent">ID</th>
                      <th class="w40_percent">Loại ván</th>
                      <th class="w40_percent">Tên sản phẩm</th>
                      <th class="w10_percent">Nội nhập/Ngoại nhập</th>
                      <th class="w10_percent">Màu</th>
                      <th class="w10_percent">(Cao)x(Rộng)x(Dài)(đơn vị)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->deck_type }}</td>
                      <td>{{ $product->code_name }}</td>
                      <td>{{ $product->is_foreign }}</td>
                      <td>{{ $product->color }}</td>
                      <td>{{ $product->height }}x{{ $product->width }}x{{ $product->length }}({{ $product->unit_size }})</td>
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
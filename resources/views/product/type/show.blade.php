@extends('layout.base')

@section('title', 'Product Type list')
@section('title_page', 'Danh sách ván ép')

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
                      <th class="w10_percent">ID</th>
                      <th class="w40_percent">Loại ván</th>
                      <th class="w40_percent">Thứ tự hiển thị</th>
                      <th class="w10_percent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $product_type)
                    <tr>
                      <td>{{ $product_type['id'] }}
                      </td>
                      <td>{{ $product_type['name'] }}</td>
                      <td>{{ $product_type['order'] }}</td>
                      <td>
                          <a class="btn btn-info btn-sm edit_product_type" 
                            href="{{ route('product_type_edit', ['product_type_id' => $product_type['id']]) }}" >
                            Edit
                          </a>
                          <a class="btn btn-info btn-sm delete_product_type" 
                            href="{{ route('product_type_delete', ['product_type_id' => $product_type['id']]) }}" >
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
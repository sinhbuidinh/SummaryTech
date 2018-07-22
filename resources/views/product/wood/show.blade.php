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
                      <th class="w40_percent">Loại gỗ</th>
                      <th class="w40_percent">Tên ngắn gọn</th>
                      <th class="w10_percent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $wood_type)
                    <tr>
                      <td>{{ $wood_type['id'] }}</td>
                      <td>{{ $wood_type['name'] }}</td>
                      <td>{{ $wood_type['short_name'] }}</td>
                      <td>
                          <a class="btn btn-info btn-sm edit_product_type" 
                            href="{{ route('product_wood_type_edit', ['wood_type_id' => $wood_type['id']]) }}" >
                            Edit
                          </a>
                          <a class="btn btn-info btn-sm delete_product_type" 
                            href="{{ route('product_wood_type_delete', ['wood_type_id' => $wood_type['id']]) }}" >
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
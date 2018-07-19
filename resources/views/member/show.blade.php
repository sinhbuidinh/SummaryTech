@extends('layout.base')

@section('title', 'Member list')
@section('title_page', 'Danh sách nhân viên')

@section('custom_style')
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
                      <th class="w30_percent">Tên nhân viên</th>
                      <th class="w20_percent">Số điện thoại</th>
                      <th class="w30_percent">Địa chỉ</th>
                      <th class="w10_percent">Loại nhân viên</th>
                      <th class="w10_percent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $member)
                    <tr>
                      <td>{{ $member->id }}</td>
                      <th class="w30_percent">{{ $member->name }}</th>
                      <th class="w20_percent">{{ $member->telephone }}</th>
                      <th class="w30_percent">{{ $member->address }}</th>
                      <th class="w10_percent">{{ $member_group_list[$member->group_type] ?? '' }}</th>
                      <td>
                          <a class="btn btn-info btn-sm edit_member" 
                            href="{{ route('member_edit', ['member_id' => $member->id]) }}" >
                            Edit
                        </a>
                        <a class="btn btn-info btn-sm delete_member" 
                           href="{{ route('member_delete', ['member_id' => $member->id]) }}" >
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
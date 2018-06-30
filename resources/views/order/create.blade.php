@extends('layout.base')

@section('title', 'Order')
@section('title_page', 'Tạo mới đơn hàng')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/general/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/order/create.css') }}" />
@endsection

@section('custom_script')
    <script src="{{ asset('js/general/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/order/create.js') }}"></script>
@endsection

@section('content')
<!-- real data -->
<div class="row">
    <form class="form-horizontal"
          action="{{ route('order_create_post') }}"
          method="post"
          style="width: 100%"
          >
        <input type="hidden" id="form_name" value="{{ $form_name }}" />
        @csrf
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_date_create">Ngày làm đơn:</label>
            <div class="col-sm-5">
                <input type="date"
                        id="{{ $form_name }}_date_create"
                        name="{{ $form_name }}[date_create]"
                        placeholder="Input date create"
                        value="{{ old( $form_name .'[date_create]', $$form_name['date_create']) }}" />
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_date_export">Ngày xuất hàng:</label>
            <div class="col-sm-5">
                <input type="date"
                        id="{{ $form_name }}_date_export"
                        name="{{ $form_name }}[date_export]"
                        placeholder="Input date create"
                        value="{{ old( $form_name .'[date_export]', $$form_name['date_export']) }}" />
            </div>
        </div>
        <!--list customer-->
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_date_export">Khách hàng:</label>
            <div class="col-sm-5">
                <select id="{{ $form_name }}_customer_id"
                        class="select_search"
                        name="{{ $form_name }}[customer_id]">
                    <option value="0">Default</option>
                    @foreach ($list_customer as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- address delivery -->
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_address_delivery">Địa chỉ giao hàng:</label>
            <div class="col-sm-7">
                <textarea id="{{ $form_name }}_address_delivery"
                            name="{{ $form_name }}[address_delivery]"
                            placeholder="Enter address_delivery here..."
                            rows="4" cols="50">{{ old( $form_name .'[address_delivery]', $$form_name['address_delivery']) }}</textarea>
            </div>
        </div>
        <!-- contact info -->
        <div class="row">
            <label class="control-label col-sm-3" for="{{ $form_name }}_contact_info">Thông tin liên lạc khách hàng:</label>
            <div class="col-sm-7">
                <textarea id="{{ $form_name }}_contact_info"
                            name="{{ $form_name }}[contact_info]"
                            placeholder="Enter contact_info here..."
                            rows="4" cols="50">{{ old( $form_name .'[contact_info]', $$form_name['contact_info']) }}</textarea>
            </div>
        </div>
        <!-- list product -->
        <table class="table table-bordered table-striped w100_percent">
            <thead>
                <tr>
                  <th class="">STT</th>
                  <th class="">Tên hàng hóa</th>
                  <th class="">SL(Tấm)</th>
                  <th class="">Đơn Giá(VND)</th>
                  <th class="">Có VAT/Không</th>
                  <th class="">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products['list'] as $key => $product)
                <tr>
                  <td class="">{{ $key }}</td>
                  <td class="">{!! $product->displayName !!}</td>
                  <td class=""><input type="number" 
                                      name="{{ $form_name }}[number][{{ $product->id }}]" 
                                      id="{{ $form_name }}_number_{{ $product->id }}" 
                                      value="{{ old($form_name.'[number]['. $product->id .']', '') }}" /></td>
                  <td class=""><input type="text" 
                                      name="{{ $form_name }}[unit][{{ $product->id }}]" 
                                      id="{{ $form_name }}_unit_{{ $product->id }}" 
                                      value="{{ old($form_name.'[unit]['. $product->id .']', '') }}" /></td>
                  <td class="">
                      <select 
                          name="{{ $form_name }}[have_vat][{{ $product->id }}]"
                          id="{{ $form_name }}_have_vat_{{ $product->id }}"
                              >
                          @foreach ($have_vat_list as $k => $v)
                          <option value="{{ $k }}">{{ $v }}</option>
                          @endforeach
                      </select>
                  </td>
                  <td>
                      <span id="display_total_{{ $product->id }}"></span>
                      <input type="hidden" name="{{ $form_name }}[total][{{ $product->id }}]" value="" />
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td class=""></td>
                  <td class="">Tổng</td>
                  <td class=""><input type="number" 
                                      disabled="disabled"
                                      name="{{ $form_name }}[total_all][number]" 
                                      id="{{ $form_name }}_total_all_number" 
                                      value="{{ old($form_name.'[total_all][number]', '') }}" /></td>
                  <td class=""><input type="number" 
                                      disabled="disabled"
                                      name="{{ $form_name }}[total_all][unit]" 
                                      value="{{ old($form_name.'[total_all][unit]', '') }}"/>
                                      </td>
                  <td></td>
                  <td class="">
                      <input type="number" 
                             disabled="disabled"
                             name="{{ $form_name }}[total_all][total]" 
                             value="{{ old($form_name.'[total_all][total]', '') }}" />
                  </td>
                </tr>
            </tbody>
        </table>
        <!-- suggest member -->
        <!--  button -->
        <div class="row">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
  </form>
</div>
@endsection
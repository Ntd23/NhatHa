@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-9">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
				<div class="col-sm-3"><a href="{{ route('admin.product.index') }}" class="btn btn-success float-right btn-rounded"><i
              class="fa fa-backward"></i>
            Quay lại</a></div>

      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @include('admin.layout.message')
      <div class="row">
        <div class="col-lg-12">
          <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Sản phẩm</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tên sản phẩm</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Danh mục</label>
                <div class="col-md-10">
                  <select class="form-control" name="category_id" id="ChangeCategory">
                    @foreach ($getCategory as $category)
                      <option @selected(old('category_id', $category->id) == $product->category_id) value="{{ old('category_id', $category->id) }}">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Danh mục con</label>
                <div class="col-md-10">
                  <select class="form-control" name="sub_category_id" id="getSubCategory">
                    @foreach ($getSubCategory as $sub_category)
                      <option @selected(old('sub_category_id', $sub_category->id) == $product->sub_category_id) value="{{ old('sub_category_id', $sub_category->id) }}">
                        {{ $sub_category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Thương hiệu</label>
                <div class="col-md-10">
                  <select class="form-control" name="brand_id">
                    @foreach ($getBrand as $brand)
                      <option @selected(old('brand_id', $brand->id) == $product->brand_id) value="{{ old('brand_id', $brand->id) }}">
                        {{ $brand->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Giá</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="price"
                    value="{{ !empty($product->price) ? $product->price : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Giá cũ</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="old_price"
                    value="{{ !empty($product->old_price) ? $product->old_price : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Sản phẩm xu hướng</label>
                <div class="col-md-10 mt-2">
                  <input {{ !empty($product->is_trendy) ? 'checked' : '' }} name="is_trendy" type="checkbox">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Ảnh</label>
                <div class="col-md-10">
                  <input class="form-control" type="file" name="image[]" accept="image/*" multiple>
                  @if (!empty($product->getImage->count()))
                    <div class="row" id="sortable">
                      @foreach ($product->getImage as $image)
                        @if (!empty($image->getLogo()))
                          <div class="col-md-2 text-center sortable_image" sortable_image id="{{ $image->id }}">
                            <img src="{{ asset($image->getLogo()) }}" style="width: 150px;height: 150px;" alt="">
                            <a href="{{ route('admin.product.image_delete', $image->id) }}"
                              onclick="return confirm('Xóa ảnh này?')" class="btn btn-sm btn-outline-danger mt-3">Xóa</a>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Size</label>
                <div class="col-md-10 mt-2">
                  <table>
                    <thead>
                      <tr>
                        <td>Tên</td>
                        <td>Giá</td>
                        <td>+/-</td>
                      </tr>
                    </thead>
                    <tbody id="AppendSize">
                      @php
                        $i_s = 1;
                      @endphp
                      @foreach ($product->getSize as $size)
                        <tr id="DeleteSize{{ $i_s }}">
                          <td><input type="text" name="size[{{ $i_s }}][name]" value="{{ $size->name }}"
                              class="form-control">
                          </td>
                          <td><input type="text" name="size[{{ $i_s }}][price]" value="{{ $size->price }}"
                              class="form-control"></td>
                          <td style="width: 100px;">
                            <button type="button" class="btn btn-outline-danger p-1 DeleteSize">-</button>
                          </td>
                        </tr>
                        @php
                          $i_s++;
                        @endphp
                      @endforeach
                      <tr>
                        <td><input type="text" name="size[299999][name]" class="form-control">
                        </td>
                        <td><input type="text" name="size[299999][price]" class="form-control"></td>
                        <td style="width: 100px;">
                          <button type="button" class="btn btn-outline-success p-2 AddSize">+</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mô tả ngắn</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="short_description">{{ old('short_description', $product->short_description) }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mô tả</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="description" >{{ old('description', $product->description) }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Thông tin bổ sung</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="additional_information">{{ old('additional_information', $product->additional_information) }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Trả hàng</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="shipping_returns">{{ old('shipping_returns', $product->shipping_returns) }}</textarea>
                </div>
              </div>
            </div>
            <div class="card-box">
              <h4 class="card-title">Hiển thị</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Trạng thái</label>
                <div class="col-md-10">
                  <select class="form-control" name="status">
                    <option>-- Chọn --</option>
                    <option @selected(old('status', $product->status) == 0) value="0">Hoạt động
                    </option>
                    <option @selected(old('status', $product->status) == 1) value="1">Không hoạt động
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
              <button class="btn btn-primary submit-btn">{{ $header_title }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('#sortable').sortable({
        update: function(event, ui) {
          var photo_id = new Array();
          $('.sortable_image').each(function() {
            let id = $(this).attr('id');
            photo_id.push(id)
          })
          $.ajax({
            type: 'POST',
            url: "{{ route('admin.product.image_sortable') }}",
            data: {
              'photo_id': photo_id,
              '_token': {{ csrf_token() }}
            },
            dataType: "json",
            success: function(data) {

            }
          })
        }
      })

      $('body').delegate('#ChangeCategory', 'change', function(e) {
        let id = $(this).val()
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.subcategory.get_sub_category') }}",
          data: {
            'id': id,
            '_token': '{{ csrf_token() }}'
          },
          dataType: 'json',
          success: function(data) {
            $('#getSubCategory').html(data.html)
          }
        })
      })
    })

    var i = 300000;
    $('body').delegate('.AddSize', 'click', function() {
      var html = '<tr id="DeleteSize' + i +
        '">\n\<td>\n\<input type="text" name="size[' + i + '][name]" placeholder="Name" class="form-control">\n\
    	</td>\n\<td>\n\<input type="text" name="size[' + i + '][price]" placeholder="Price" class="form-control">\n\
    	</td>\n\<td>\n\<button type="button" id="' +
        i + '" class="btn btn-outline-danger p-2 DeleteSize">-</button>\n\</td>\n\
    </tr>';
      i++;
      $('#AppendSize').append(html)
    })
    $('body').delegate('.DeleteSize', 'click', function() {
      var id = $(this).attr('id');
      $('#DeleteSize' + id).remove();
    })
  </script>
@endsection

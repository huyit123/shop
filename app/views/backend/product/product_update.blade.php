@extends('backend.layout.layout')

@section('title', 'Sản phẩm')
@section('description', 'Sản phẩm')
@section('keywords', 'Sản phẩm ')
<?php
$action = 'Tạo Mới';
if (!empty($data->id)) {
    $action = 'Cập Nhật';
}
$arr_featured = array('normal'=>'Bình Thường','new'=>'Mới','sale' => 'Giảm Giá')
?>
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_product">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{ URL::to('admin/product') }}">Sản Phẩm</a></li>
        <li class="active">{{$action}} Sản Phẩm</li>
    </ol>

    <h4 class="page-title">{{$action}} Sản Phẩm</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Tên Sản Phẩm</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập tên sản phẩm" name="name"
                           value="{{$data->name}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="name" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Giá Sản Phẩm</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập giá sản phẩm" name="price"
                           data-val-number="Giá sản phẩm là số"
                           value="{{$data->price}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="price" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Giá Sản Phẩm Cũ</label>
                    <input type="text" data-val="true" name="price_old" data-val-number="Giá sản phẩm cũ là số"
                           value="{{$data->price_old}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="price_old" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Chọn danh mục cho sản phẩm</label>
                    <div class="">
                        <select class="select" name="categoryid">
                            @foreach($categories as $category)
                                <option @if($category->id == $data->categoryid) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                @foreach($category->subCategory as $sub)
                                    <option @if($sub->id == $data->categoryid) selected @endif value="{{$sub->id}}">-- {{$sub->title}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Đặc tính sản phẩm</label>
                    <div class="">
                        <select class="select" name="featured">
                            @foreach($arr_featured as $key=>$value)
                                <option @if($key == $data->featured) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Sản phẩm nổi bật</label>
                    <div>
                        <div class="make-switch switch-small">
                            <input name="featured_show" type="checkbox" @if($data->featured_show == 1) checked @endif >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Mã sản phẩm</label>
                    <input type="text" data-val="true" name="productcode"
                           value="{{$data->productcode}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="productcode"
                          data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Nhãn hiệu</label>
                    <input type="text" data-val="true" name="brand"
                           value="{{$data->brand}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="brand" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Nơi sản xuất</label>
                    <input type="text" data-val="true" name="madein"
                           value="{{$data->madein}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="madein" data-valmsg-replace="true"></span>
                </div>

                <div class="form-group">
                    <label for="email">Số lượng sản phẩm</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập số lượng sản phẩm"
                           name="quantity"
                           data-val-number="Số lương sản phẩm là số"
                           value="{{$data->quantity}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="quantity" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Tags</label>
                    <div>
                        <input type="text" name="tags"
                               value="{{$data->tags}}"
                               placeholder="" class="form-control tags">
                    </div>

                </div>
                <div class="form-group">
                    <label for="email">Hình ảnh (540x698 px)</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->image))
                                <img src='{{asset('public/uploads/product/'.$data->image)}}'>
                            @endif

                        </div>
                        <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Chọn hình ảnh</span>
                                <span class="fileupload-exists">Thay đổi</span>
                                <input type="file" name="image"/>
                            </span>
                            <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Tóm tắt sản phẩm</label>
                    <textarea rows="5" name="summary" class="form-control">{{$data->summary}}</textarea>
                </div>
                <div class="form-group">
                    <label for="email">Mô tả sản phẩm</label>
                    <textarea id="editor1" rows="8" name="description"
                              class="form-control">{{$data->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-alt ">Lưu</button>
                <a href="{{ URL::to('admin/product') }}" class="btn btn-alt">Quay về</a>
            </form>
        </div>

    </div>

@section('script')
    <script src="https://cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
    <script>
        $(".tags").tagsinput('items');
        $(function () {
            CKEDITOR.replace('editor1', {
                filebrowserBrowseUrl: '/public/backend/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '/public/backend/ckfinder/ckfinder.html?Type=Blog',
                filebrowserUploadUrl: '/public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '/public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Blog',
            });
        });
    </script>
@endsection
@endsection

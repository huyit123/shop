@extends('backend.layout.layout')

@section('title', 'Blog')
@section('description', 'Blog')
@section('keywords', 'Blog')
<?php
$action = 'Tạo Mới';
if (!empty($data->id)) {
    $action = 'Cập Nhật';
}
?>
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_blog">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{ URL::to('admin/blog') }}">Blog</a></li>
        <li class="active">{{$action}} Blog</li>
    </ol>

    <h4 class="page-title">{{$action}} Blog</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Tiêu đề</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập tiêu đề" name="title"
                           value="{{$data->title}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="title" data-valmsg-replace="true"></span>
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
                    <label for="email">Hình ảnh (390x266 px)</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->image))
                                <img src='{{asset('public/uploads/blog/'.$data->image)}}'>
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
                    <label for="email">Tóm tắt nội dung</label>
                    <textarea rows="5" name="summary" class="form-control" data-val="true" data-val-required="Vui lòng nhập tóm tắt nôi dung">{{$data->summary}}</textarea>
                    <span class="field-validation-error" data-valmsg-for="summary" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Nội dung bài viết</label>
                    <textarea id="editor1" rows="8" name="description"
                              class="form-control">{{$data->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-alt ">Lưu</button>
                <a href="{{ URL::to('admin/blog') }}" class="btn btn-alt">Quay về</a>
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

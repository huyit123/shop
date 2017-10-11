@extends('backend.layout.layout')

@section('title', 'Banner quảng cáo')
@section('description', 'Banner quảng cáo')
@section('keywords', 'Banner quảng cáo')
<?php
$action = 'Tạo Mới';
if (!empty($data->id)) {
    $action = 'Cập Nhật';
}
?>
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_banner">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{ URL::to('admin/banner') }}">Banner</a></li>
        <li class="active">{{$action}} Banner</li>
    </ol>

    <h4 class="page-title">{{$action}} Banner</h4>

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
                    <label for="email">Link banner</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập link" name="link"
                           value="{{$data->link}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="link" data-valmsg-replace="true"></span>
                </div>

                <div class="form-group">
                    <label for="email">Chọn loại banner</label>
                    <div class="">
                        <select class="select" name="type">
                                     <option @if($data->type == 'main') selected @endif value="main">Banner chính (size: 1920x728)</option>
                            <option @if($data->type == 'big') selected @endif value="big">Banner lớn (size: 1058x751)</option>
                            <option @if($data->type == 'midium') selected @endif value="midium">Banner vừa (size: 1058x419)</option>
                            <option @if($data->type == 'small') selected @endif value="small">Banner nhỏ (size: 529x334)</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="email">Hình ảnh</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->image))
                                <img src='{{asset('public/uploads/banner/'.$data->image)}}'>
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
                <button type="submit" class="btn btn-alt ">Lưu</button>
                <a href="{{ URL::to('admin/banner') }}" class="btn btn-alt">Quay về</a>
            </form>
        </div>

    </div>
@endsection
@endsection

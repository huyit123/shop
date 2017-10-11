@extends('backend.layout.layout')

@section('title', 'admin')
@section('description', 'home')
@section('keywords', 'home')
<?php
$action = 'Tạo Mới';
if (!empty($category->id)) {
    $action = 'Cập Nhật';
}
?>
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_category">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{ URL::to('admin/category') }}">Danh Mục</a></li>
        <li class="active">{{$action}} Danh Mục</li>
    </ol>

    <h4 class="page-title">{{$action}} Danh Mục</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}">
                <div class="form-group">
                    <label for="email">Tên Danh Mục</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập tên danh mục" name="title"
                           value="{{$category->title}}"
                           placeholder="Tên danh mục" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="title" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Chọn loại cha</label>
                    <div class="">
                        <select class="select" name="parentid">
                            <option>Danh mục cha</option>
                            @if(count($listcategory) > 0)
                                @foreach($listcategory as $item)
                                    <option @if($category->parentid == $item->id) selected
                                            @endif value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Sắp Xếp</label>
                    <input type="number" data-val="true" data-val-required="Vui lòng nhập số sắp xếp" name="orderby"
                           placeholder="Sắp xếp" class="form-control" value="{{$category->orderby}}">
                    <span class="field-validation-error" data-valmsg-for="orderby" data-valmsg-replace="true"></span>

                </div>
                <div class="form-group">
                    <label for="email">Hiện Thị Trang Chủ</label>
                    <div>
                        <div class="make-switch switch-small">
                            <input name="display" type="checkbox" @if($category->display == 1) checked @endif >
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-alt ">Lưu</button>
                <a href="{{ URL::to('admin/category') }}" class="btn btn-alt">Quay về</a>
            </form>
        </div>

    </div>
@endsection

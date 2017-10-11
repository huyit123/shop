@extends('backend.layout.layout')

@section('title', 'chương trình khuyến mãi')
@section('description', 'chương trình khuyến mãi')
@section('keywords', 'chương trình khuyến mãi')
<?php
$action = 'Tạo Mới';
if (!empty($data->id)) {
    $action = 'Cập Nhật';
}
?>
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_discount">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{ URL::to('admin/discount') }}">Chương trình khuyến mãi</a></li>
        <li class="active">{{$action}} Chương trình khuyến mãi</li>
    </ol>

    <h4 class="page-title">{{$action}} Chương trình khuyến mãi</h4>

    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Tên sự kiện</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập tên sự kiện" name="name"
                           value="{{$data->name}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="name" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Mã sự kiện</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập mã sự kiện" name="codeevent"
                           value="{{$data->codeevent}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="codeevent" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label for="email">Số phiếu giảm giá</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập số phiếu"
                           name="quantity"
                           data-val-number="Số phiếu giảm giá là số"
                           value="{{$data->quantity}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="quantity" data-valmsg-replace="true"></span>
                </div>
                <?php
                $start = '';
                if (!empty($data->startdate)) {
                    $start = date('d/m/Y', strtotime($data->startdate));
                }
                $end = '';
                if (!empty($data->enddate)) {
                    $end = date('d/m/Y', strtotime($data->enddate));
                }
                ?>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Ngày bắt đầu</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" class="form-control input-sm" value="{{$start}}" name="startdate" data-val="true" data-val-required="Vui lòng chọn ngày bắt đầu" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                            <span class="field-validation-error" data-valmsg-for="startdate" data-valmsg-replace="true"></span>
                        </div>
                        <div class="col-md-6">
                            <label>Ngày kết thúc</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" class="form-control input-sm" value="{{$end}}" name="enddate" data-val="true" data-val-required="Vui lòng chọn ngày kết thúc" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                            <span class="field-validation-error" data-valmsg-for="enddate" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Giảm giá theo</label>
                    <div class="">
                        <select class="select" name="type">
                                <option value="price">Giảm theo giá tiền</option>
                                <option value="percent">Giảm theo phần trăm</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Số tiền (phần trăm) giảm</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập số tiền"
                           name="price"
                           data-val-number="Số tiền là số"
                           value="{{$data->price}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="price" data-valmsg-replace="true"></span>
                </div>

                <button type="submit" class="btn btn-alt ">Lưu</button>
                <a href="{{ URL::to('admin/discount') }}" class="btn btn-alt">Quay về</a>
            </form>
        </div>

    </div>
@endsection
@endsection

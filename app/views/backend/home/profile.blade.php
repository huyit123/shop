@extends('backend.layout.layout')

@section('title', 'Cập nhật tài khoản admin')
@section('description', 'Cập nhật tài khoản admin')
@section('keywords', 'Cập nhật tài khoản admin')
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_profile">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active"> Cập nhật tài khoản admin</li>
    </ol>

    <h4 class="page-title">Cập nhật tài khoản admin</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Email <span class="required">*</span> </label>
                    <input type="text" data-val="true" data-val-email="Email không hợp lệ"
                           data-val-required="Vui lòng nhập email" name="email" placeholder=""
                           class="form-control valid dart-form-control" value="{{$data->email}}">
                    <span class="field-validation-valid" data-valmsg-for="email"
                          data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label>Mật Khẩu <span class="required">*</span></label>
                    <input type="password" data-val="true" data-val-required="Vui lòng nhập mật khẩu"
                           name="password" placeholder="" class="dart-form-control valid form-control">
                    <span class="field-validation-valid" data-valmsg-for="password"
                          data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label>Xác Nhận Mật Khẩu <span class="required">*</span></label>
                    <input type="password" data-val="true"
                           data-val-required="Vui lòng nhập mật khẩu xác nhận" data-val-equalto = "Mật khẩu xác nhận không chính xác" data-val-equalto-other = "password"
                           name="confirmmPassword" placeholder="" class="dart-form-control valid form-control">
                    <span class="field-validation-valid" data-valmsg-for="confirmmPassword"
                          data-valmsg-replace="true"></span>
                </div>
                <button type="submit" class="btn btn-alt ">Lưu</button>
            </form>
        </div>

    </div>
@endsection

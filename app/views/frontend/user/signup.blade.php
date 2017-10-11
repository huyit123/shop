@extends('frontend.layout.layout')

@section('title', 'Đăng ký')
@section('description', 'Đăng ký')
@section('keywords', 'Đăng ký')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>ĐĂNG KÝ</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>ĐĂNG KÝ</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')

    <section class="dart-pt-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <div id="rd_login_form">
                        <h3 class="text-center">Đăng Ký Tài Khoản</h3>
                        <form class="dart-pt-20 form-login" method="post" action="{{URL::current()}}">
                            {{FcHelper::Alertmessage_frontend($errors)}}
                            <div class="form-group">
                                <label>Email <span class="required">*</span> </label>
                                <input type="text" data-val="true" data-val-email="Email không hợp lệ"
                                       data-val-required="Vui lòng nhập email" name="email" placeholder=""
                                       class="form-control valid dart-form-control">
                                <span class="field-validation-valid" data-valmsg-for="email"
                                      data-valmsg-replace="true"></span>
                            </div>

                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input type="text" name="name" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="mobile" placeholder="" class="form-control" data-val="true" data-val-number="Vui lòng nhập số">
                                <span class="field-validation-valid" data-valmsg-for="mobile"
                                      data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu <span class="required">*</span></label>
                                <input type="password" data-val="true" data-val-required="Vui lòng nhập mật khẩu"
                                       name="password" placeholder="" class="dart-form-control valid">
                                <span class="field-validation-valid" data-valmsg-for="password"
                                      data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label>Xác Nhận Mật Khẩu <span class="required">*</span></label>
                                <input type="password" data-val="true"
                                       data-val-required="Vui lòng nhập mật khẩu xác nhận" data-val-equalto = "Mật khẩu xác nhận không chính xác" data-val-equalto-other = "password"
                                       name="confirmmPassword" placeholder="" class="dart-form-control valid">
                                <span class="field-validation-valid" data-valmsg-for="confirmmPassword"
                                      data-valmsg-replace="true"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn normal-btn dart-btn-xs">Đăng Ký</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

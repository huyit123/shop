@extends('frontend.layout.layout')

@section('title', 'Đăng nhập')
@section('description', 'Đăng nhập')
@section('keywords', 'Đăng nhập')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>ĐĂNG NHẬP</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>ĐĂNG NHẬP</span></li>
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
                        <h3 class="text-center">Đăng Nhập</h3>

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
                                <label>Mật Khẩu <span class="required">*</span></label>
                                <input type="password" data-val="true" data-val-required="Vui lòng nhập mật khẩu"
                                       name="password" placeholder="" class="dart-form-control valid">
                                <span class="field-validation-valid" data-valmsg-for="password"
                                      data-valmsg-replace="true"></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                                </label>
                            </div>
                            <button type="submit" class="btn normal-btn dart-btn-xs">Đăng Nhập</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layout.layout')

@section('title', 'Liên hệ')
@section('description', 'Liên hệ')
@section('keywords', 'Liên hệ')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>LIÊN HỆ</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>LIÊN HỆ</span></li>
            </ol>

        </div>
    </div>
    <?php
    $configinfo = Configdat::where('type','event')->first();
    ?>
@endsection
@section('content')
    <section class="contactus-one" id="id_page" data-id="id_contact"><!-- Section id-->
        <div class="container">
            <div class="row">
                <div class=" col-md-12 col-sm-12">
                    <div class="contact-block">
                        <div class="dart-headingstyle-one dart-mb-20">  <!--Style 1-->
                            <h2 class="dart-heading">LIÊN HỆ</h2>
                        </div>

                        <div class="contact-form">
                            {{FcHelper::Alertmessage_frontend($errors)}}
                            <form class="row" action="#" id="contact" name="contact" method="post">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Họ và tên" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="title" placeholder="Tiêu đề" required="">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Nội dung" required=""></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button name="submit" type="submit" class="btn normal-btn dart-btn-xs">GỬI EMAIL</button>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <div class=" row contact-info">
                            <div class="col-md-12 col-sm-12">
                                <p class="addre"><i class="fa fa-map-marker"></i>{{$configinfo->address}}</p>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p class="phone-call"><i class="fa fa-phone"></i> <a href="tel:{{$configinfo->phone}}">{{$configinfo->phone}}</a></p>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p class="mail-id"><i class="fa fa-envelope"></i>{{$configinfo->email}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

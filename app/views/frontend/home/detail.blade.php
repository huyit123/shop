@extends('frontend.layout.layout')

@section('title', $product->name)
@section('description', $product->name)
@section('keywords', $product->name)
<?php

$socialimage = URL::asset('public/uploads/blog') . '/' . rawurlencode($product->image);
$currentUrl = Url::current();
$social = new stdClass();
$social->url = $currentUrl;
$social->image = $socialimage;
$social->title = $product->name;
$social->desc = $product->summary;
$social->img_width = 250;
$social->img_height = 320;
?>
@section('meta')
    @include('frontend.facebookmeta',array('social'=>$social))
@endsection
@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>SẢN PHẨM</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>CHI TIẾT SẢN PHẨM</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')

    <!--Shoping with Sidebar Section-->
    <div class="shop-pages">
        <section class="product-single-wrap section-padding">
            <div class="container">
                <div class="product-content-wrap">
                    <div class="row">
                        <div class="col-md-6 col-sm-8 col-sm-offset-2 col-md-offset-0">

                            <!-- template -->
                            <div class="ms-showcase2-template ms-showcase2-vertical">
                                <!-- masterslider -->
                                <div class="master-slider ms-skin-default" id="masterslidershop">
                                    <div class="ms-slide">
                                        <img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"
                                             data-src="{{asset('public/uploads/product/'.$product->image)}}"
                                             alt="lorem ipsum dolor sit"/>
                                        <img class="ms-thumb"
                                             src="{{asset('public/uploads/product/'.$product->image)}}"
                                             alt="thumb"/>
                                    </div>
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-13.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-13.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-16.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-16.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-17.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-17.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-18.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-18.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-19.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-19.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                    {{--<div class="ms-slide">--}}
                                    {{--<img src="{{asset('public/frontend/vendor/masterslider/style/blank.gif')}}"--}}
                                    {{--data-src="{{asset('public/frontend/images/product/product-18.jpg')}}"--}}
                                    {{--alt="lorem ipsum dolor sit"/>--}}
                                    {{--<img class="ms-thumb"--}}
                                    {{--src="{{asset('public/frontend/images/product/product-18.jpg')}}"--}}
                                    {{--alt="thumb"/>--}}
                                    {{--</div>--}}
                                </div>
                                <!-- end of masterslider -->
                            </div>
                            <!-- end of template -->

                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="product-content dart-mt-30">
                                <div class="product-title">
                                    <h2>{{$product->name}}</h2>
                                </div>
                                <div class="product-price-review">
                                    <span class="font-semibold sell-price">{{FcHelper::formatprice($product->price)}}</span>
                                    @if(!empty($product->price_old) && $product->price_old > 0)
                                        <span class="price"><span
                                                    class="actual-price">{{FcHelper::formatprice($product->price_old)}}</span></span>
                                    @endif

                                    {{--<div class="rating">--}}
                                    {{--<span class="star active"></span>--}}
                                    {{--<span class="star active"></span>--}}
                                    {{--<span class="star active"></span>--}}
                                    {{--<span class="star active"></span>--}}
                                    {{--<span class="star"></span>--}}
                                    {{--<span class="text">3 Customer Reviews</span>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="product-description">
                                    <div>
                                        {{$product->summary}}
                                    </div>
                                    <div class="qty-add-wish-btn">
                                        <span class="quantity">
                                            <input type="text" class="input-text qty text" id="quantityaddtocart"
                                                   title="Qty" value="1"
                                                   name="cart">
                                            <input type="button" class="plus" value="+">
                                            <input type="button" class="minus" value="-">
                                        </span>
                                        <span><a class="btn rd-stroke-btn border_2px dart-btn-sm"
                                                 href="javascript:void(0)" onclick="addtocart({{$product->id}})">Thêm vào Giỏ Hàng</a></span>
                                    </div>
                                    <ul class="list-unstyled list-infoproduct">
                                        <li>Số lượng:
                                            @if($product->quantity > 0)
                                                {{$product->quantity}}
                                            @else
                                               <span style="color:red">Hết Hàng</span>
                                            @endif
                                        </li>
                                        <li>MSP: {{$product->productcode}}</li>
                                        <li>Danh Mục: {{$product->categoryname}}</li>
                                        <li>Tags: {{$product->tags}}</li>
                                    </ul>
                                    <div class="social-media">
                                        <span class="black-color">Chia sẻ</span>
                                        <ul class="social-icons list-unstyled">
                                            <li><a onclick="share_fb('{{Url::current()}}')"><i
                                                            class="fa fa-facebook-official" aria-hidden="true"
                                                            style="color:#3b5998;font-size: 25px;cursor: pointer;"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

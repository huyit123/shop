@extends('frontend.layout.layout')

@section('title', 'ĐẶT HÀNG THÀNH CÔNG')
@section('description', 'ĐẶT HÀNG THÀNH CÔNG')
@section('keywords', 'ĐẶT HÀNG THÀNH CÔNG')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>ĐẶT HÀNG THÀNH CÔNG</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>ĐẶT HÀNG THÀNH CÔNG</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Bạn đã đặt hàng thành công, shop chúng tôi sẽ giao hàng cho bạn trong thời gian sớm nhất.</h3>
                    <h3 class="text-center">Xin chân thành cám ơn.</h3>
                    <h3 class="text-center"><a href="/" class="btn">Quay Về Trang Chủ</a></h3>
                </div>
            </div>
        </div>
    </section>
@endsection

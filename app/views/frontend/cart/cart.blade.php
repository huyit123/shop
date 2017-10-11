@extends('frontend.layout.layout')

@section('title', 'Giỏ hàng')
@section('description', 'Giỏ hàng')
@section('keywords', 'Giỏ hàng')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>GIỎ HÀNG</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>GIỎ HÀNG</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')
    <section>
        @if(count($cart))
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">

                            <table class="table cart">
                                <thead>
                                <tr>
                                    <th class="cart-product-thumbnail">Sản Phẩm</th>
                                    <th class="cart-product-name">Tên</th>
                                    <th class="cart-product-price">Giá</th>
                                    <th class="cart-product-quantity">Số Lượng</th>
                                    <th class="cart-product-subtotal">Tổng</th>
                                    <th class="cart-product-remove">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    <tr class="cart_item">
                                        <td class="cart-product-thumbnail">
                                            <a href="{{URL::to('/san-pham/'.$item->options->image.'/'.$item->id)}}"><img width="64" height="64" src="{{asset('public/uploads/product/'.$item->options->image)}}"
                                                             alt="{{$item->name}}"></a>
                                        </td>

                                        <td class="cart-product-name">
                                            <a href="{{URL::to('/san-pham/'.$item->options->image.'/'.$item->id)}}">{{$item->name}}</a>
                                        </td>

                                        <td class="cart-product-price">
                                            <span class="amount">{{FcHelper::formatprice($item->price)}}</span>
                                        </td>

                                        <td class="quantity">
                                            <div class="quantity buttons-add-minus">
                                                <input type="text" name="cart" value="{{$item->qty}}" title="Qty"
                                                       class="input-text qty text">
                                                <input type="button" value="+" class="plus" onclick="updatetocart(this,'{{$item->id}}','plus')">
                                                <input type="button" value="-" class="minus" onclick="updatetocart(this,'{{$item->id}}','minus')">
                                            </div>
                                        </td>

                                        <td class="cart-product-subtotal subtotal-item">
                                            <span class="amount">{{FcHelper::formatprice($item->subtotal)}}</span>
                                        </td>

                                        <td class="cart-product-remove">
                                            <a href="{{URL::to('/cart/remove/item?id='.$item->rowid)}}" class="remove removeitemcart" data-id="{{$item->rowid}}" title="Remove this item"><i
                                                        class="fa fa-remove"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart_item coupon-check">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{--<div class="col-md-7 col-sm-6 col-xs-12">--}}
                                        {{--<input type="text" value="" class="dart-form-control"--}}
                                               {{--placeholder="Enter Coupon Code..">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-5 col-sm-6 col-xs-12">--}}
                                        {{--<a href="#" class="btn normal-btn dart-btn-xs">Apply Coupon</a>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-right">

                                    <div class="col-md-8 col-sm-6 col-xs-6">
                                        <a href="{{URL::to('/removeall')}}" class="btn rd-stroke-btn border_1px dart-btn-xs">Xóa Giỏ hàng</a>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <a href="{{URL::to('/gio-hang/dat-hang')}}" class="btn rd-stroke-btn border_1px dart-btn-xs">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{----}}
                {{--<div class="row clearfix">--}}
                    {{--<div class="col-md-6 clearfix">--}}
                        {{--<h4>Calculate Shipping</h4>--}}
                        {{--<form>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-12">--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<input type="text" class="dart-form-control" placeholder="State / Country">--}}
                                {{--</div>--}}

                                {{--<div class="col-sm-6">--}}
                                    {{--<input type="text" class="dart-form-control" placeholder="PostCode / Zip">--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<a href="#" class="btn normal-btn dart-btn-xs">Update Totals</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-6 clearfix">--}}
                        {{--<div class="table-responsive totle-cart">--}}
                            {{--<h4>Tổng giỏ hàng</h4>--}}

                            {{--<table class="table cart">--}}
                                {{--<tbody>--}}
                                {{--<tr class="cart_item cart_totle">--}}
                                    {{--<td class="cart-product-name">--}}
                                        {{--<strong>Tạm Tính</strong>--}}
                                    {{--</td>--}}

                                    {{--<td class="cart-product-name tamtinh">--}}
                                        {{--<span class="amount">{{FcHelper::formatprice( Cart::total())}}</span>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr class="cart_item cart_totle">--}}
                                    {{--<td class="cart-product-name">--}}
                                        {{--<strong>Shipping</strong>--}}
                                    {{--</td>--}}

                                    {{--<td class="cart-product-name">--}}
                                        {{--<span class="amount">Free Shipping</span>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr class="cart_item cart_totle">--}}
                                    {{--<td class="cart-product-name">--}}
                                        {{--<strong>Tồng Tiền</strong>--}}
                                    {{--</td>--}}

                                    {{--<td class="cart-product-name tongtien">--}}
                                        {{--<span class="blue"><strong>{{FcHelper::formatprice( Cart::total())}}</strong></span>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}

                            {{--</table>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{----}}
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Hiện giỏ hàng của bạn không có sản phẩm.</h3>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

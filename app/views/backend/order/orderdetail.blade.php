@extends('backend.layout.layout')

@section('title', 'Chi tiết đơn hàng')
@section('description', 'Chi tiết đơn hàng')
@section('keywords', 'Chi tiết đơn hàng')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_order">
        <li><a href="#">Trang Chủ</a></li>
        <li><a href="{{URL::to('/admin/order')}}">Danh sách đơn hàng</a></li>
        <li class="active">Chi tiết đơn hàng</li>
    </ol>

    <h4 class="page-title">Danh sách đơn hàng</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="widget-body">
                    <div style="margin-bottom:10px">
                        <a href="{{URL::to('/admin/order')}}"  class="btn btn-alt">TRỞ LẠI</a>
                    </div>

                    <table class="table table-cus">
                        <thead>
                        <tr>
                            <th colspan="2">Thông tin nhận hàng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Họ và tên</td>
                            <td class="information">{{$order->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="information">{{$order->email}} </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td class="information">{{$order->phone}}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td class="information">{{$order->address.' '.$order->district.' '.$order->city}}</td>
                        </tr>
                        <tr>
                            <td>Mã đơn hàng</td>
                            <td class="information">{{$order->codeorder}}</td>
                        </tr>
                        <tr>
                            <td>Ngày đặt hàng</td>
                            <td class="information">{{date('d/m/Y', strtotime($order->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>Thời gian giao hàng</td>
                            <td class="information"></td>
                        </tr>
                        <tr>
                            <td>Trạng thái đơn hàng</td>
                            <td class="information" style="color:red">
                                @if($order->status == 'pending')
                                    <span>Chờ duyệt đơn hàng</span>
                                @elseif($order->status == 'confirm')
                                    <span>Đang giao hàng</span>
                                @elseif($order->status == 'complete')
                                    <span>Đã giao hàng</span>
                                @else
                                    <span>Hủy đơn hàng</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Ghi chú đơn hàng</td>
                            <td class="information">{{$order->note}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Hình ảnh</th>
                                <th class="product-name left-name">Tên sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($product as $item)
                                <?php
                                $price = $item->price * $item->quantity;
                                ?>
                                <tr class="pro_@item.IdProduct">
                                    <td class="product-thumbnail"><img src="{{asset('public/uploads/product/'.$item->image)}}" alt="" width="60" /></td>
                                    <td class="product-name left-name">
                                        <p class="cus-cart">{{$item->name}}</p>
                                    </td>
                                    <td class="product-price"><span class="amount">{{FcHelper::formatprice($item->price)}}</span></td>
                                    <td class="product-quantity">x {{$item->quantity}}</td>
                                    <td class="product-subtotal thanhtien">{{FcHelper::formatprice($price)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="total-quantity" colspan="4">Tạm Tính</td>
                                    <td class="total-amount">{{FcHelper::formatprice($order->price)}}</td>
                                </tr>
                                <tr>
                                    <td class="total-quantity" colspan="4">Phí giao hàng</td>
                                    <td class="total-amount">{{FcHelper::formatprice($order->priceship)}}</td>
                                </tr>
                                <tr>
                                    <td class="total-quantity" colspan="4">Phiếu giảm giá</td>
                                    <td class="total-amount">-{{FcHelper::formatprice($order->pricecoupon)}}</td>
                                </tr>
                                <tr>
                                    <td class="total-quantity" colspan="4">Tổng đơn hàng</td>
                                    <td class="total-amount totalall" style="color:red">{{FcHelper::formatprice($order->total)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </article>
        </div>
    </div>

    <style>
        .table-content table {
            background: transparent none repeat scroll 0 0;
            border-color: rgba(221, 221, 221, 0.25);
            border-radius: 0;
            border-style: solid;
            border-width: 1px 0 0 1px;
            margin: 0 0 50px;
            text-align: center;
            width: 100%;
        }

        .table-content table th, .table-content table td {
            border-bottom: 1px solid rgba(221, 221, 221, 0.25);
            border-right: 1px solid rgba(221, 221, 221, 0.25);
        }

        .table-content table th {
            border-top: medium none;
            font-family: Montserrat,Arial,Helvetica,sans-serif;
            font-weight: normal;
            padding: 20px 10px;
            text-align: center;
            text-transform: uppercase;
            vertical-align: middle;
            white-space: nowrap;
            font-weight: 600;
        }

        .table-content table {
            text-align: center;
        }

        .table-content table td.product-thumbnail {
            width: 130px;
        }

        .table-content table td.product-name {
            width: 270px;
        }

        .table-content table td {
            border-top: medium none;
            padding: 20px 10px;
            vertical-align: middle;
            font-size: 13px;
            font-size: 16px !important;
            font-weight: 700;
        }

        .table-content table td.product-name a {
            font-size: 14px;
            font-weight: 700;
            margin-left: 10px;
            color: #6f6f6f;
        }

        .table-content table td.product-price {
            width: 130px;
        }

        .table-content table td.product-quantity {
            width: 180px;
        }

        .table-content table td.product-subtotal {
            font-size: 14px;
            font-weight: bold;
            width: 120px;
        }

        .table-content table td.product-remove {
            width: 150px;
        }

        .table-content table td input {
            background: #e5e5e5 none repeat scroll 0 0;
            border: medium none;
            border-radius: 3px;
            color: #6f6f6f;
            font-family: Montserrat,Arial,Helvetica,sans-serif;
            font-size: 15px;
            font-weight: normal;
            height: 40px;
            padding: 0 5px 0 10px;
            width: 60px;
        }

        .table-content table td.product-remove i {
            color: #919191;
            display: inline-block;
            font-size: 20px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            width: 40px;
        }

        .table-cus {
            margin-bottom: 50px !important;
        }

        .table-cus > thead > tr > th {
            border-bottom: 1px solid #6abd45;
            color: #ffffff;
        }

        .table-cus > tbody > tr:nth-of-type(odd) {
            background-color: transparent;
        }

        .table-cus > tbody > tr:nth-of-type(even) {
            background-color: transparent;
        }

        .table-cus > tbody > tr > td, .table > tfoot > tr > td {
            padding: 8px 15px;
            border-top: 1px solid #f3f3f3;
        }

        .total-quantity {
            text-align: right;
        }
    </style>
@endsection


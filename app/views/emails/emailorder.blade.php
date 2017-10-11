<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>EmailOrder</title>
</head>
<body>
<div style="margin-top:20px">
    <div style="width:100%;margin:0 auto">
        <div style="margin-bottom:40px">
            <div style="border-radius:10px;padding:20px;background: #F1F1F1;">
                <div style="font-size:24px;color:#444;">

                </div>
                <div style="background: #ffffff;padding: 15px;">
                    <div class="col-sm-12 headform">
                        <div class="col-sm-3 textcenter">
                            <div class="col-sm-12 logo">

                            </div>
                        </div>
                        <div class="col-sm-12" style="margin: 10px 0;line-height: 1.5;">
                            Cảm ơn quý khách <span>
                                    {{$info->name}}
                                </span> đã đặt hàng !<br>

                            shop rất vui thông báo đơn hàng {{$cartdb->codeorder}} của quý khách đã được tiếp nhận và
                            đang trong quá trình xử lý. Chúng tôi sẽ thông báo đến quý khách hàng khi hàng chuẩn bị
                            giao.

                        </div>
                        <div class="col-sm-12">
                            <h2 class="ddh" style="color: #FC9A38;">THÔNG TIN GIAO HÀNG</h2>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p style="text-transform: capitalize;"><b style="width: 169px; display: inline-block;">Họ và
                                    tên</b> {{$info->name}}</p>
                            <p><b style="width: 169px; display: inline-block;">Email</b> {{$info->email}}</p>
                            <p style="text-transform: capitalize;"><b style="width: 169px; display: inline-block;">Số
                                    điện thoại</b> {{$info->phone}}</p>
                            <p style="text-transform: capitalize;"><b style="width: 169px; display: inline-block;">Địa
                                    chị</b>{{$info->address}}, {{$info->district}}, {{$info->city}}</p>
                            <p style="text-transform: capitalize;"><b style="width: 169px; display: inline-block;">Mã
                                    đơn hàng</b> {{$cartdb->codeorder}}</p>
                            <p style="text-transform: capitalize;"><b style="width: 169px; display: inline-block;">Ngày
                                    đặt hàng</b> {{date('d/m/Y', strtotime($cartdb->created_at))}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 table-cart">
                        <h2 class="ddh" style="color: #FC9A38;">CHI TIẾT ĐƠN HÀNG</h2>
                        <div class="col-sm-12 maintable">
                            <table style="border-collapse: collapse; border-spacing: 0; width: 100%; display: table;">

                                <thead style="font-family: Conv_ShadowsIntoLight; background-color: #ee2b63;">
                                <tr>
                                    <th style="color:#fff;padding:10px;border-right: 1px solid #ddd;">Hình ảnh</th>
                                    <th style="color:#fff;padding:10px;border-right: 1px solid #ddd;">Tên</th>
                                    <th style="color:#fff;padding:10px;border-right: 1px solid #ddd;">Giá</th>
                                    <th style="color:#fff;padding:10px;border-right: 1px solid #ddd;">Số lượng</th>
                                    <th style="color:#fff;padding:10px;border-right: 1px solid #ddd;">Tổng cộng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cart as $item)

                                    <tr>
                                        <td style="border: 1px solid #ddd; text-align: center;padding:10px;">
                                            <div class="cartpage-image">
                                                <a href="{{URL::to('/san-pham/'.$item->options->image.'/'.$item->id)}}"><img width="64" height="64" src="{{asset('public/uploads/product/'.$item->options->image)}}"
                                                                                                                             alt="{{$item->name}}"></a>
                                            </div>
                                        </td>
                                        <td style="border: 1px solid #ddd; text-align: left;padding:10px;">{{$item->name}}</td>
                                        <td class="tr" style="border: 1px solid #ddd; text-align: right;padding:10px;">
                                            <strong>{{FcHelper::formatprice($item->price)}}</strong></td>
                                        <td style="border: 1px solid #ddd; text-align: center;padding:10px;">x{{$item->qty}}</td>
                                        <td class="tr" style="text-align: right; border: 1px solid #ddd;padding:10px;">
                                            <strong>{{FcHelper::formatprice($item->subtotal)}}</strong></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" style="border: 1px solid #ddd; text-align: right; padding: 10px;">
                                        <b>Tạm Tính</b></td>
                                    <td colspan="1"
                                        style="text-align: right; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">
                                        <span id="tongtien"><strong>{{FcHelper::formatprice($cartdb->price)}}</strong> </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" style="border: 1px solid #ddd; text-align: right; padding: 10px;">
                                        <b>Phí vận chuyển</b></td>
                                    <td colspan="1"
                                        style="text-align: right; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">
                                        <strong><span id="ShipOrder">{{FcHelper::formatprice($cartdb->priceship)}}</span></strong></td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<td colspan="4" style="border: 1px solid #ddd; text-align: right; padding: 10px;">--}}
                                        {{--<b>Thời gian giao hàng dự kiến</b></td>--}}
                                    {{--<td colspan="1"--}}
                                        {{--style="text-align: right; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">--}}
                                        {{--<strong><span id="time">0</span></strong></td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <td colspan="4" style="border: 1px solid #ddd; text-align: right; padding: 10px;">
                                        <b>Phiếu giảm giá</b></td>
                                    <td colspan="1"
                                        style="text-align: right; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">
                                        <strong><span id="time">-{{FcHelper::formatprice($cartdb->pricecoupon)}}</span></strong></td>
                                </tr>

                                <tr>
                                    <td colspan="4" style="border: 1px solid #ddd; text-align: right; padding: 10px;">
                                        <b>Tổng đơn hàng</b></td>
                                    <td colspan="1"
                                        style="text-align: right; padding-right: 10px; border: 1px solid #ddd; padding: 10px;">
                                        <span id="total"><strong>{{FcHelper::formatprice($cartdb->total)}}</strong> </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>


                    </div>
                    <div class="clr" style="height: 20px; clear: both;">
                    </div>
                    <div class="clr" style="height: 20px; clear: both;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
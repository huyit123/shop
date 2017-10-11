@extends('frontend.layout.layout')

@section('title', 'Đặt hàng')
@section('description', 'Đặt hàng')
@section('keywords', 'Đặt hàng')

@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>ĐẶT HÀNG</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li><a href="{{URL::to('/gio-hang')}}">GIỎ HÀNG</a></li>
                <li class="active"><span>ĐẶT HÀNG</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')
    <section class="dart-pt-30">
        <div class="container">
            <form class="row custom-form" action="{{URL::current()}}" method="post">

                <div class="col-md-6 col-sm-6">
                    <h3 class="">THÔNG TIN NHẬN HÀNG</h3>


                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" data-val="true"
                               data-val-required="Vui lòng nhập họ tên" name="name"
                               class="form-control valid dart-form-control">
                        <span class="field-validation-valid" data-valmsg-for="name"
                              data-valmsg-replace="true"></span>
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" data-val="true"
                               data-val-required="Vui lòng nhập số điện thoại" name="phone"
                               data-val-number="Vui lòng nhập số"
                               class="form-control valid dart-form-control">
                        <span class="field-validation-valid" data-valmsg-for="phone"
                              data-valmsg-replace="true"></span>
                    </div>

                    <div class="clear"></div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" data-val="true" data-val-email="Email không hợp lệ"
                               data-val-required="Vui lòng nhập email" name="email" placeholder=""
                               class="form-control valid dart-form-control">
                        <span class="field-validation-valid" data-valmsg-for="email"
                              data-valmsg-replace="true"></span>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" data-val="true"
                               data-val-required="Vui lòng nhập địa chỉ" name="address"
                               class="form-control valid dart-form-control">
                        <span class="field-validation-valid" data-valmsg-for="address"
                              data-valmsg-replace="true"></span>
                    </div>


                    <div class="form-group">
                        <label>Tỉnh/Thành</label>
                        <select class="city" data-val="true" onchange="changecity(this)"
                                data-val-required="Vui lòng chọn tỉnh/thành"
                                name="city">
                            <option disabled selected>Chọn Tỉnh/Thành</option>
                            @foreach($city as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <span class="field-validation-valid" data-valmsg-for="city"
                              data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label>Quận/Huyện</label>
                        <select class="district dart-form-control" name="district" data-val="true"
                                onchange="changedistrict(this)"
                                data-val-required="Vui lòng chọn quận/huyện"
                                name="district">
                            <option disabled selected>Chọn Quận/Huyện</option>
                        </select>
                        <span class="field-validation-valid" data-valmsg-for="district"
                              data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú
                            <small>*</small>
                        </label>
                        <textarea class="dart-form-control" name="note"
                                  rows="6" cols="30"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="table-responsive">
                        <h3 class="dart-pb-20">ĐƠN HÀNG CỦA BẠN</h3>
                        <table class="table cart checkout">
                            <thead>
                            <tr>
                                <th class="cart-product-thumbnail">Sản Phẩm</th>
                                <th class="cart-product-name">Tên</th>
                                <th class="cart-product-quantity">Số Lượng</th>
                                <th class="cart-product-subtotal">Tổng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $item)
                                <tr class="cart_item">
                                    <td class="cart-product-thumbnail">
                                        <a href="{{URL::to('/san-pham/'.$item->options->image.'/'.$item->id)}}"><img
                                                    width="64" height="64"
                                                    src="{{asset('public/uploads/product/'.$item->options->image)}}"
                                                    alt="{{$item->name}}"></a>
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="{{URL::to('/san-pham/'.$item->options->image.'/'.$item->id)}}">{{$item->name}}</a>
                                    </td>

                                    <td class="quantity">
                                        <span>{{$item->qty}}</span>
                                    </td>

                                    <td class="cart-product-subtotal">
                                        <span class="amount">{{FcHelper::formatprice($item->subtotal)}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart_item coupon-check" style="position: relative">
                        <div class="row clearfix">
                            <?php
                            $hideinputcpoupon = '';
                            $showcodecounpon = 'display:none;';
                            $pricediscount = 0;
                            if (Session::has('codecoupon')) {
                                $hideinputcpoupon = 'display:none;';
                                $showcodecounpon = 'display:block;';
                                $pricediscount = Session::get('codecoupon')['pricecode'];
                            }
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 hide-inputcpoupon" style="{{$hideinputcpoupon}}">
                                <span class="msg" style="display: none;color: red;margin-left: 15px"></span>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                    <input type="text" class="dart-form-control clcode"
                                           placeholder="Mã giảm giá">
                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                    <a href="javascript:void(0)" class="btn normal-btn dart-btn-xs applycode">Áp
                                        Dụng</a>
                                </div>
                            </div>
                            <div class="text-center show-codecounpon" style="{{$showcodecounpon}}">
                                <span href="javascript:void(0)" class="btn"
                                      style="position: relative;background-color: #ee2b63; color: #fff;cursor: context-menu;">
                                    Đã áp dụng mã giảm giá
                                    <span style="position: absolute; top: -10px; right: -5px; color: #706b6b;cursor: pointer;"
                                          class="removecode"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive totle-cart">
                        <h3 class="dart-pb-20">Tổng đơn hàng</h3>
                        <div class="loadingprice" style="position: relative">
                            <table class="table cart">
                                <tbody>
                                <tr class="cart_item cart_totle">
                                    <td class="cart-product-name">
                                        <strong>Tạm Tính</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount">{{FcHelper::formatprice( Cart::total())}}</span>
                                    </td>
                                </tr>
                                <tr class="cart_item cart_totle">
                                    <td class="cart-product-name">
                                        <strong>Phí Giao Hàng</strong>
                                    </td>

                                    <td class="cart-product-name price-shipping">
                                        <span class="amount">0 Đ</span>
                                    </td>
                                </tr>
                                <tr class="cart_item cart_totle">
                                    <td class="cart-product-name">
                                        <strong>Giảm Giá</strong>
                                    </td>

                                    <td class="cart-product-name price-discount">
                                        <span class="amount">-{{FcHelper::formatprice($pricediscount)}}</span>
                                    </td>
                                </tr>
                                <tr class="cart_item cart_totle">
                                    <td class="cart-product-name">
                                        <strong>Tổng Tiền</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <?php
                                        $total = 0;
                                        if (Cart::total() > $pricediscount) {
                                            $total = Cart::total() - $pricediscount;
                                        }
                                        ?>
                                        <span class="blue"><strong
                                                    class="total-cart">{{FcHelper::formatprice( $total)}}</strong></span>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="payments-options">
                        <ul class="list-unstyled">
                            <li>
                                <label id="direct-transfer" for="payment_method_bacs">
                                    <input id="payment_method_bacs" class="input-radio" type="radio"
                                           data-order_button_text="" value="bacs" name="payment_method" checked>
                                    Thanh Toán Khi Nhận Hàng
                                </label>
                            </li>
                            <li>
                                <label for="payment_method_paypal" id="paypal-transfer">
                                    <input type="radio" data-order_button_text="Proceed to PayPal" value="bacs"
                                           name="payment_method" class="input-radio" id="payment_method_paypal"
                                           disabled>
                                    Thanh Toán Trực Tuyến
                                </label>
                            </li>
                        </ul>
                    </div>
                    <button class="btn  dart-btn-sm  normal-btn" type="submit">ĐẶT HÀNG</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{URL::asset('public/frontend/js/select2.min.js')}}"></script>
    <script>
        var total = {{Cart::total()}};
        var pricediscount = {{$pricediscount}};
        var priceshipping = 0;
        $(".city").select2({width: '100%'});
        function changecity(el) {
            var id = $(el).val();
            var link = "/cart/district";
            $.get(link, {id: id}, function (response) {
                var html = '<option disabled selected>Chọn Quận/Huyện</option>';
                $.each(response, function (key, value) {
                    var selected = '';
                    if (value.Id == el) {
                        selected = "selected";
                    }
                    html += '<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>';
                });
                $(".district").html(html);
            });
            priceshipping = 0;
            var total_ship = total;
            if (total_ship > pricediscount) {
                total_ship = total_ship - pricediscount;
            } else {
                total_ship = 0;
            }
            $('.price-shipping').html(priceshipping.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
            $('.total-cart').html(total_ship.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
        }
        function changedistrict(el) {
            imgspinner.show('.loadingprice', true);
            var id = $(el).val();
            var link = "/cart/shipping";
            $.get(link, {id: id}, function (response) {
                priceshipping = response;
                var total_ship = total + response;
                if (total_ship > pricediscount) {
                    total_ship = total_ship - pricediscount;
                } else {
                    total_ship = 0;
                }
                $('.price-shipping').html(response.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                $('.total-cart').html(total_ship.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                imgspinner.hide();
            });
        }

        $('.applycode').click(function () {
            var codecoupon = $('.clcode').val();
            if (codecoupon == '') {
                $('.msg').html('Vui lòng nhập mã giảm giá');
                $('.msg').css('display', 'block');
            } else {
                imgspinner.show('.coupon-check', true);
                $.ajax({
                    type: 'post',
                    url: '/cart/check-code-coupon',
                    data: {codecoupon: codecoupon},
                    success: function (data) {
                        setTimeout(function () {
                            if (data.success == true) {
                                var totalcarrt = total + priceshipping;
                                pricediscount = data.pricecode;
                                if (pricediscount < totalcarrt) {
                                    totalcarrt = totalcarrt - pricediscount;
                                } else {
                                    totalcarrt = 0;
                                }
                                $('.show-codecounpon').css('display', 'block');
                                $('.hide-inputcpoupon').css('display', 'none');
                                $('.total-cart').html(totalcarrt.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                                $('.price-discount').html('-' + data.pricecode.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                            }
                            else {
                                $('.msg').html(data.msg);
                                $('.msg').css('display', 'block');
                            }
                            imgspinner.hide();
                        }, 1000);
                    },
                });
            }
        })
        $('.clcode').keyup(function () {
            $('.msg').html('');
            $('.msg').css('display', 'none');
        })
        $('.removecode').click(function () {
            $.ajax({
                type: 'post',
                url: '/cart/remove-code-coupon',
                success: function (data) {
                    var totalcarrt = total + priceshipping;
                    pricediscount = data.pricecode;
                    $('.show-codecounpon').css('display', 'none');
                    $('.hide-inputcpoupon').css('display', 'block');
                    $('.total-cart').html(totalcarrt.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                    $('.price-discount').html('-' + data.pricecode.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' Đ');
                },
            });
        })
    </script>
    <style>
        .imgloader span {
            position: absolute;
            top: 40%;
            left: 49%;
            margin-left: -30px;
            margin-top: 40px;
            color: #ee2b63;
            font-size: 13px;
        }

        .imgloader:before, .imgloader:after {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            content: "";
        }
    </style>
@endsection
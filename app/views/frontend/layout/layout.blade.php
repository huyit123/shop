
<?php
$configinfo = Configdat::where('type','event')->first();
?>
<!DOCTYPE html>
<html class="ie9">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @yield('meta')
    <meta name="title" content="@yield('title')"/>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')"/>
    <link rel="icon" href="{{asset('/public/uploads/logo/favicon.ico')}}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('public/frontend/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{URL::asset('public/frontend/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css">
    <link href="{{URL::asset('public/frontend/css/smartadmin-production-plugins.min.css')}}" rel="stylesheet"
          type="text/css">
    <!-- template CSS -->
    <link href="{{URL::asset('public/frontend/css/style.css')}}" rel="stylesheet">


    <!-- Base MasterSlider style sheet -->
    <link rel="stylesheet" href="{{URL::asset('public/frontend/vendor/masterslider/style/masterslider.css')}}"/>

    <!-- Master Slider Skin -->
    <link href="{{URL::asset('public/frontend/vendor/masterslider/skins/default/style.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- masterSlider Template Style -->
    <link href="{{URL::asset('public/frontend/vendor/masterslider/style/ms-layers-style.css')}}" rel="stylesheet"
          type="text/css">

    <!-- owl Slider Style -->
    <link rel="stylesheet" href="{{URL::asset('public/frontend/vendor/owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet"
          href="{{URL::asset('public/frontend/vendor/owlcarousel/dist/assets/owl.theme.default.min.css')}}">

    <!-- Custom CSS -->
    <link href="{{URL::asset('public/frontend/css/custom.css')}}" rel="stylesheet">
    @yield('style')
</head>
<body id="home">
<div class="top-container">
    <div class="container-fluid">
        <div class="row">
            <div class="top-column-left">
                <ul class="contact-line">
                    <li><i class="fa fa-envelope"></i> {{$configinfo->email}}</li>
                    <li><i class="fa fa-phone"></i> {{$configinfo->phone}}</li>
                </ul>
            </div>
            <div class="top-column-right">
                <div class="top-social-network">
                    <a target="_blank" href="{{$configinfo->facebook}}"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>
                <ul class="register">
                    @if(Auth::check())
                        @if(Auth::user()->role == 1)
                        <li><a href="{{URL::to('/admin/order')}}">Quản lý</a></li>
                        @else
                            <li><a href="{{URL::to('/')}}">Quản lý</a></li>
                        @endif
                        <li><a href="{{URL::to('/logout')}}">Đăng Xuất</a></li>
                    @else
                        <li><a href="{{URL::to('/dang-nhap')}}">Đăng Nhập</a></li>
                        <li><a href="{{URL::to('/dang-ky')}}">Đăng Ký</a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>


<nav class="navbar navbar-default navbar-sticky awesomenav">
    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container-fluid">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
    <div class="container-fluid">

        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <li class="search"><a href="#"><i class="fa fa-2x fa-search"></i></a></li>
                <li class="dropdown">
                    <a href="{{URL::to('/gio-hang')}}">
                        <i class="fa fa-2x fa-shopping-basket"></i>
                        <span class="badge" id="countcart">{{Cart::count()}}</span>
                    </a>
                </li>
                {{--<li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li>--}}
            </ul>
        </div>
        <!-- End Atribute Navigation -->


        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/"><img src="{{asset('public/uploads/logo/logo.png')}}" class="logo"
                                                  alt=""></a>
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                <li id="id_home"><a href="/">TRANG CHỦ</a></li>
                <li id="id_product"><a href="{{URL::to('san-pham')}}">SẢN PHẨM</a></li>

                <li id="id_blog">
                    <a href="{{URL::to('blog')}}">Blog</a>
                </li>

                <li id="id_about"><a href="#">GIỚI THIỆU</a></li>
                <li id="id_contact"><a href="{{URL::to('/lien-he')}}">LIÊN HỆ</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>

    <!-- Start Side Menu -->
    {{--<div class="side">--}}
        {{--<a href="#" class="close-side"><i class="fa fa-times"></i></a>--}}
        {{--<div class="widget">--}}
            {{--<h6 class="title">Custom Pages</h6>--}}
            {{--<ul class="link">--}}
                {{--<li><a href="index.html">MY Account</a></li>--}}
                {{--<li><a href="checkout.html">Checkout</a></li>--}}
                {{--<li><a href="cart.html">Ordrer</a></li>--}}
                {{--<li><a href="index.html">FAQ</a></li>--}}
                {{--<li><a href="contact.html">Policy</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- End Side Menu -->

</nav>
@yield('banner')

@yield('content')

<section class="newsletter-bg">
    <div class="container">
        <div class="row">
            <div class="dart-headingstyle-one dart-mb-20 text-center">  <!--Style 1-->
                <h2 class="dart-heading">Đăng Ký Nhận Tin</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline" id="newsletter_forrm">
                    <div class="newsletter">
                        <div style="text-align: left;">
                            <span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
                            <span class="field-validation-error msg-newsletter" style="display: none"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" data-val="true" data-val-email="Email không hợp lệ" data-val-required="Vui lòng nhập email" name="email" placeholder="" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">Đăng Ký<i class="fa fa-envelope-o"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="footer-block about">
                    <h3>Giới Thiệu</h3>
                    <p>Cosmetic Agency is a Premium eCommerce Template.<br>Best choice for your online store.<br>Let
                        purchase it to enjoy now</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="footer-block twitter">
                    <h3>Về chung tôi</h3>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 5px;"><a style="color: #898989 !important; font-family: 'Montserrat', sans-serif; font-weight: 500;" href="#">Giới Thiệu</a></li>
                        <li style="margin-bottom: 5px;"><a style="color: #898989 !important; font-family: 'Montserrat', sans-serif; font-weight: 500;" href="{{URL::to('/lien-he')}}">Liên Hệ</a></li>
                        <li style="margin-bottom: 5px;"><a style="color: #898989 !important; font-family: 'Montserrat', sans-serif; font-weight: 500;" href="{{URL::to('/blog')}}">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="footer-block contact">
                    <h3>liên hệ</h3>
                    <p>{{$configinfo->address}}<br>{{$configinfo->phone}}<br>{{$configinfo->email}}</p>
                </div>
            </div>
            <div class="col-md-12  col-sm-12">
                <div class="social">
                    <h5>Theo dõi chúng tôi</h5>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{$configinfo->facebook}}"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="copy">
                <p>© 2017 <span>Shop</span>. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>


<script src="{{URL::asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('public/frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/backend/js/validate.js')}}"></script>
<!-- Nav JavaScript -->
<script src="{{URL::asset('public/frontend/js/awesomenav.js')}}"></script>
<!-- jQuery -->
<!--<script src="vendor/masterslider/jquery.min.js"></script>-->
<script src="{{URL::asset('public/frontend/vendor/masterslider/jquery.easing.min.js')}}"></script>
<!-- Master Slider -->
<script src="{{URL::asset('public/frontend/vendor/masterslider/masterslider.min.js')}}"></script>

<!-- owl Slider JavaScript -->
<script src="{{URL::asset('public/frontend/vendor/owlcarousel/dist/owl.carousel.min.js')}}"></script>
<!-- Counter required files -->
<script type="text/javascript" src="{{URL::asset('public/frontend/js/dscountdown.min.js')}}"></script>
<!-- template JavaScript -->
<script type="text/javascript" src="{{URL::asset('public/frontend/js/SmartNotification.min.js')}}"></script>
<script src="{{URL::asset('public/frontend/js/template.js')}}"></script>
<!-- custom JavaScript -->
<script src="{{URL::asset('public/frontend/js/custom.js')}}"></script>
@yield('script')
@yield('script1')
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '483514828677060',
            xfbml: true,
            version: 'v2.10'
        });
        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function share_fb(url) {
        var leftPosition, topPosition;
        var width = 626;
        var height = 436;
        //Allow for borders.
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        //Allow for title and status bars.
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
        var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'facebook-share-dialog', windowFeatures)
    }
</script>
</body>
</html>



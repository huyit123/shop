<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="title" content="@yield('title')"/>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')"/>

    <!-- CSS -->
    <link href="{{URL::asset('public/backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/form.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/calendar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/media-player.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/icons.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/backend/css/generics.css')}}" rel="stylesheet">


    @yield('style')
</head>
<body id="skin-blur-chrome">
<header id="header" class="media">
    <a href="" id="menu-toggle"></a>
    <a class="logo pull-left" href="/"> ADMIN   </a>

    <div class="media-body">
        <div class="media" id="top-menu">
            <div class="pull-left tm-icon">
                <a data-drawer="messages" class="drawer-toggle" href="">
                    <i class="sa-top-message"></i>

                    <span>Messages</span>
                </a>
            </div>
            <div class="pull-left tm-icon">
                <a data-drawer="notifications" class="drawer-toggle" href="">
                    <i class="sa-top-updates"></i>

                    <span>Updates</span>
                </a>
            </div>


            <div id="time" class="pull-right">
                <span id="hours"></span>
                :
                <span id="min"></span>
                :
                <span id="sec"></span>
            </div>

            <div class="media-body">
                <input type="text" class="main-search">
            </div>
        </div>
    </div>
</header>

<div class="clearfix"></div>

<section id="main" class="p-relative" role="main">

    <!-- Sidebar -->
    <aside id="sidebar">
        <ul class="list-unstyled side-menu">
            <li class="main-nav__item">
                <a class="main-nav__link active js-main-nav__tooltip" title="Trang Chủ" href="/"><i
                            class="s-icon-home-b icon-large"></i>
                    Trang Chủ
                </a>
            </li>
            <li class="main-nav__item" id="li_category">
                <a class="main-nav__link" title="danh mục" href="{{ URL::to('admin/category') }}"><i
                            class="s-icon-event-list icon-large"></i>
                    Danh Mục
                </a>
            </li>

            <li class="main-nav__item" id="li_product">
                <a class="main-nav__link" title="sản phẩm" href="{{ URL::to('admin/product') }}"><i
                            class="s-icon-inventory-b icon-large"></i>
                    Sản Phẩm
                </a>
            </li>
            <li class="main-nav__item" id="li_banner">
                <a class="main-nav__link" title="banner quảng cáo" href="{{ URL::to('admin/banner') }}"><i
                            class="icon-reorder icon-large"></i>
                    Banner quảng cáo
                </a>
            </li>
            <li class="main-nav__item" id="li_discount">
                <a class="main-nav__link  js-main-nav__tooltip" title="khuyến mãi"
                   href="{{ URL::to('admin/discount') }}">
                    <i class="fa fa-gift" aria-hidden="true" style="font-size: 25px;"></i>
                    Phiếu giảm giá
                </a>
            </li>
            <li class="main-nav__item" id="li_sales">
                <a class="main-nav__link  js-main-nav__tooltip" title="sales" href="{{ URL::to('admin/sales') }}">
                    <i class="s-icon-calendar-b icon-large"></i>
                    Sản phẩm sales
                </a>
            </li>
            <li class="main-nav__item" id="li_order">
                <a class="main-nav__link  js-main-nav__tooltip" title="đơn hàng"
                   href="{{URL::to('admin/order')}}"><i class="s-icon-cloud-b icon-large"></i>
                    Đơn hàng
                </a>
            </li>
            <li class="main-nav__item" id="li_blog">
                <a class="main-nav__link  js-main-nav__tooltip" title="blog" href="{{ URL::to('admin/blog') }}"><i
                            class="s-icon-sales-b icon-large"></i>
                    Blog
                </a>
            </li>
            <li class="main-nav__item" id="id_customer">
                <a class="main-nav__link  js-main-nav__tooltip" title="khách hàng" href="{{ URL::to('admin/customer') }}"><i
                            class="s-icon-client-b icon-large"></i>
                    Khách hàng
                </a>
            </li>

            <li class="main-nav__item" id="id_newsletter">
                <a class="main-nav__link  js-main-nav__tooltip" title="Đăng ký nhận tin" href="{{ URL::to('admin/newsletter') }}"><i
                            class="s-icon-user-b icon-large"></i>
                    Newsletter
                </a>
            </li>


            <li class="main-nav__item" id="li_shipping">
                <a class="main-nav__link  js-main-nav__tooltip" title="Phí giao hàng" href="{{URL::to('admin/shipping')}}"><i class="fa fa-truck" style="font-size:25px;"></i>
                    Phí giao hàng
                </a></li>
            <li class="main-nav__item" id="li_setup">
                <a class="main-nav__link  js-main-nav__tooltip" id="setup-menu-toggle" title="thiết lập website"
                   href="{{URL::to('/admin/setup')}}"><i class="s-icon-settings-b icon-large"></i>
                    Thiết lập
                </a></li>
            <li class="main-nav__item" id="li_profile">
                <a class="main-nav__link  js-main-nav__tooltip" id="setup-menu-toggle" title="tài khoản"
                   href="{{URL::to('admin/update/profile')}}"><i class="fa fa-info-circle" aria-hidden="true" style="font-size: 25px;"></i>
                    Tài khoản Admin
                </a></li>
            <li class="main-nav__item">
                <a class="main-nav__link  js-main-nav__tooltip" id="setup-menu-toggle" title="Đăng xuất"
                   href="{{URL::to('/logout')}}"><i class="fa fa-sign-out" style="font-size: 25px;"></i>
                    Đăng xuất
                </a></li>
        </ul>

    </aside>
    <section id="content" class="container">
        @yield('content')
    </section>
    <br/><br/>
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<script src="{{URL::asset('public/backend/js/jquery.min.js')}}"></script>
<!-- jQuery Library -->

<!-- Bootstrap -->
<script src="{{URL::asset('public/backend/js/bootstrap.min.js')}}"></script>

<!-- UX -->
<script src="{{URL::asset('public/backend/js/scroll.min.js')}}"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="{{URL::asset('public/backend/js/calendar.min.js')}}"></script> <!-- Calendar -->
{{--<script src="{{URL::asset('public/backend/js/feeds.min.js')}}"></script> <!-- News Feeds -->--}}
<script src="{{URL::asset('public/backend/js/validate.js')}}"></script>
<script src="{{URL::asset('public/backend/js/select.min.js')}}"></script>
<script src="{{URL::asset('public/backend/js/chosen.min.js')}}"></script> <!-- Custom Multi Select -->
<script src="{{URL::asset('public/backend/js/datetimepicker.min.js')}}"></script> <!-- Date & Time Picker -->
<script src="{{URL::asset('public/backend/js/icheck.js')}}"></script>
<script src="{{URL::asset('public/backend/js/toggler.min.js')}}"></script> <!-- Toggler -->
<script src="{{URL::asset('public/backend/js/fileupload.min.js')}}"></script> <!-- File Upload -->
<script src="{{URL::asset('public/backend/js/datatable.js')}}"></script> <!-- table -->
<script src="{{URL::asset('public/backend/js/bootstrap-tagsinput.js')}}"></script> <!-- tags -->
<!-- All JS functions -->
<script src="{{URL::asset('public/backend/js/functions.js')}}"></script>
@yield('script')
</body>
</html>



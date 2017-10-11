@extends('frontend.layout.layout')
<?php
$configinfo = Configdat::where('type', 'event')->first();
$main = $banner->filter(function ($subQuery) {
    return $subQuery->type == 'main';
});
if (count($main)) {
    $main = json_decode($main);
}
$small = $banner->filter(function ($subQuery) {
    return $subQuery->type == 'small';
})->take(2);
if (count($small)) {
    $small = json_decode($small);
}
$midium = $banner->filter(function ($subQuery) {
    return $subQuery->type == 'midium';
})->take(1);
if (count($midium) > 0) {
    $midium = json_decode($midium)[0];
}
$big = $banner->filter(function ($subQuery) {
    return $subQuery->type == 'big';
})->take(1);

if (count($big) > 0) {
    $big = json_decode($big)[0];
}

?>
@section('title', $configinfo->titleweb)
@section('description', $configinfo->description)
@section('keywords', $configinfo->keyword)
@section('banner')
    <!-- End top area -->
    <div class="clearfix"></div>
    <!--Slider Here-->
    <section class="dart-no-padding-tb">

        <div class="ms-layers-template">
            <!-- masterslider -->
            <div class="master-slider ms-skin-black-2 round-skin" id="masterslider">
                @foreach($main as $item)
                    <a href="{{$item->link}}" class="ms-slide slide-1" style="z-index: 10" data-delay="10">
                        <img src="public/frontend/vendor/masterslider/style/blank.gif"
                             data-src="{{asset('public/uploads/banner/'.$item->image)}}" alt="{{$item->title}}"/>

                    </a>
                @endforeach
            </div>

        </div>

    </section>

    <div class="clearfix"></div>

    <section class="dart-no-padding">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-6 col-md-6">
                    <div class="clearfix no-gutter">
                        @foreach($small as $item)
                            <div class="col-sm-6">
                                <a href="{{$item->link}}"><img src="{{asset('public/uploads/banner/'.$item->image)}}"
                                                               style="width:100%"
                                                               class="img-responsive"
                                                               alt="{{$item->title}}"></a>
                            </div>
                        @endforeach
                        @if(count($midium) > 0)
                            <div class="col-sm-12">
                                <a href="{{$midium->link}}"><img
                                            src="{{asset('public/uploads/banner/'.$midium->image)}}"
                                            class="img-responsive" alt="{{$midium->title}}" style="width:100%"></a>
                            </div>
                        @endif
                    </div>
                </div>
                @if(count($big) > 0)
                    <div class="col-lg-6 col-md-6">
                        <a href="{{$big->link}}"><img src="{{asset('public/uploads/banner/'.$big->image)}}"
                                                      class="img-responsive" alt="{{$big->title}}"
                                                      style="width:100%"></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@section('content')

    <section class="product-slide" id="id_page" data-id="id_home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 loadingproduct">
                    <div role="tabpanel" class="tabSix text-center"><!--Style 6-->

                        <!-- Nav tabs -->
                        <ul id="tabSix" class="nav nav-tabs">
                            <?php $first = true; ?>
                            @foreach($category as $item)
                                <li @if($first == true)class="active" @endif>
                                    <a href="#contentSix-{{$item->id}}" data-categoryid="{{$item->id}}"
                                       data-toggle="tab">
                                        <p>{{$item->title}}</p>
                                    </a>
                                </li>
                                <?php $first = false; ?>
                            @endforeach

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php $first = true; ?>
                            @foreach($category as $item)
                                <div class="tab-pane in @if($first == true)active @endif" id="contentSix-{{$item->id}}">
                                    <div class="row equal" style="animation: animatezoom 60s;">
                                    </div>
                                </div>
                                <?php $first = false; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

    @if(!empty($event))
        <?php
        $product = json_decode($event->data);
        ?>
        <section class="super-deal-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <div class="super-deal">
                            {{--<p class="dart-fs-18">wow ! super deal only today</p>--}}
                            <h1 class="dart-fs-48">{{$event->title}}</h1>
                            <p>{{$event->summary}}</p>
                            <div class="clearfix"></div>

                            <div class="demo2"></div>
                            @if(count($product) > 1)
                                <a href="{{URL::to('/san-pham/sale')}}" class="btn btn-normal">Shop sale</a>
                            @else
                                <?php
                                $productsale = Product::find($product[0]);
                                ?>
                                <a href="{{URL::to('/san-pham/'.$productsale->alias.'/'.$productsale->id)}}"
                                   class="btn btn-normal">Xem Ngay</a>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <img src="{{asset('public/uploads/config/'.$event->image)}}" class="img-responsive" alt="Deal"/>
                    </div>
                </div>
            </div>
        </section>
@section('script1')
    <script>
        $('.demo2').dsCountDown({
            endDate: new Date("{{date('m-d-Y H:i:s', strtotime($event->enddate))}}"),
            theme: 'black'
        });
    </script>
@endsection

@endif

<section class="featured-product">
    <div class="container">
        <div class="row">
            <div class="dart-headingstyle-one dart-mb-60 text-center">
                <h2 class="dart-heading">SẢN PHẨM NỔI BẬT</h2>
                <img src="public/frontend/images/Icon-sep.png" alt="img"/>
            </div>
        </div>
        <div class="row featured-product-content">
        </div>
    </div>
</section>


<section class="blog">
    <div class="container">
        <div class="row">
            <div class="dart-headingstyle-one dart-mb-60 text-center">
                <h2 class="dart-heading">BLOG</h2>
                <img src="public/frontend/images/Icon-sep.png" alt="img"/>
            </div>
        </div>
        <?php $count = 1; ?>
        <div class="row no-gutter">
            @foreach($blog as $item)
                @if($count == 2)
                    <div class="col-md-4 col-sm-4">
                        <div class="blog-wapper">
                            <div class="blog-content dart-mb-0">
                                <h4 class="blog-title"><a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}"
                                                          title="{{$item->title}}">{{$item->title}}</a></h4>
                                <p class="post-date"><i
                                            class="fa fa-calendar"></i> {{date('d-m-Y', strtotime($item->created_at))}}
                                </p>
                                <p class="post-content">
                                    {{mb_substr($item->summary, 0, 250, 'utf-8')}}
                                </p>
                                <a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}">Xem Thêm</a>
                            </div>
                            <div class="blog-img ImageWrapper">
                                <a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}" class="bubble-bottom">
                                    <img src="{{asset('public/uploads/blog/'.$item->image)}}" class="img-responsive"
                                         alt="{{$item->title}}"/>
                                    <div class="PStyleHe"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4 col-sm-4">
                        <div class="blog-wapper">
                            <div class="blog-img ImageWrapper">
                                <a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}" class="bubble-top">
                                    <img src="{{asset('public/uploads/blog/'.$item->image)}}" class="img-responsive"
                                         alt="{{$item->title}}"/>
                                    <div class="PStyleHe"></div>
                                </a>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}"
                                                          title="{{$item->title}}">{{$item->title}}</a></h4>
                                <p class="post-date"><i
                                            class="fa fa-calendar"></i> {{date('d-m-Y', strtotime($item->created_at))}}
                                </p>
                                <p class="post-content">
                                    {{mb_substr($item->summary, 0, 250, 'utf-8')}}
                                </p>
                                <a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                @endif
                <?php $count++; ?>
            @endforeach


        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        var arrayproduct = {};
        function loadproduct(categoryid) {
            imgspinner.addheight('.loadingproduct');
            imgspinner.show('.loadingproduct', true);

            if (categoryid in arrayproduct) {
                var data = arrayproduct[categoryid];
                $('#contentSix-' + categoryid + ' .row').html(data);
                imgspinner.removeheight('.loadingproduct');
                imgspinner.hide();
            }
            else {
                $.ajax({
                    type: 'get',
                    url: '/home/getproduct',
                    data: {categoryid: categoryid},
                    success: function (data) {
                        arrayproduct[categoryid] = data;
                        setTimeout(function () {
                            $('#contentSix-' + categoryid + ' .row').html(data);
                            imgspinner.removeheight('.loadingproduct');
                            imgspinner.hide();
                        }, 500);

                    },
                });
            }
        }
        $('#tabSix li a').click(function () {
            var categoryid = $(this).data('categoryid');
            loadproduct(categoryid);
        })
        var categoryid = $('#tabSix li.active a').data('categoryid');
        loadproduct(categoryid);
        $.ajax({
            type: 'get',
            url: '/home/getproduct/featured',
            success: function (data) {
                $('.featured-product-content').html(data);
            },
        });
    </script>
@endsection
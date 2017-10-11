@extends('frontend.layout.layout')

@section('title', 'admin home')
@section('description', 'home')
@section('keywords', 'home')
@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>SẢN PHẨM</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>SẢN PHẨM</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')
    <section class="sidebar-shop shop-pages dart-pt-20" id="id_page" data-id="id_product">
        <div class="container">
            <div class="content-wrap ">
                <div class="shorter">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <span class="showing-result">Sản phẩm ưu đãi hấp dẫn nhất</span>
                        </div>
                        <div class="col-sm-6 col-xs-6 text-right">
                            <span class="showing-result">Hiện có <b style="color: #ee2b63;font-weight: 600;">{{$count}}</b>  sản phẩm</span>
                            {{--<div class="short-by">--}}
                                {{--<span>short by</span>--}}
                                {{--<select class="selectpicker form-control">--}}
                                    {{--<option>Newnest</option>--}}
                                    {{--<option>Type 1</option>--}}
                                    {{--<option>Type 2</option>--}}
                                    {{--<option>Type 3</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="product-wrap">
                            <div class="row equal">

                                @foreach($product as $item)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="wa-theme-design-block">
                                            <figure class="dark-theme">
                                                <img src="{{asset('public/uploads/product/'.$item->image)}}"
                                                     alt="{{$item->name}}">

                                                @if($item->featured == 'new')
                                                    <div class="ribbon">
                                                        <span>New</span>
                                                    </div>
                                                @elseif($item->featured == 'sale')
                                                    <div class="ribbon">
                                                        <span>Sale</span>
                                                    </div>
                                                @endif

                                                <span class="block-sticker-tag1" onclick="addtocart({{$item->id}})" title="Thêm vào giỏ hàng">
                                                <span class="off_tag">
                                                    <strong>
                                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                    </strong>
                                                </span>
                                            </span>
                                                <span class="block-sticker-tag2" onclick="share_fb('{{URL::to('/san-pham/'.$item->alias.'/'.$item->id)}}')" title="Chia sẻ facebook">
                                                <span class="off_tag1">
                                                    <strong>
                                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                                    </strong>
                                                </span>
                                            </span>
                                                <span class="block-sticker-tag3" title="Xem chi tiết sản phẩm">
                                                <a class="off_tag2 btn-action btn-quickview"
                                                   href="{{URL::to('/san-pham/'.$item->alias.'/'.$item->id)}}">
                                                    <strong>
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </strong>
                                                </a>
                                            </span>
                                            </figure>
                                            <div class="block-caption1">
                                                <div class="price">
                                                    <span class="sell-price">{{FcHelper::formatprice($item->price)}}</span>
                                                    @if(!empty($item->price_old) && $item->price_old > 0)
                                                        <span class="actual-price">{{FcHelper::formatprice($item->price_old)}}</span>
                                                    @endif
                                                </div>
                                                <div class="clear"></div>
                                                <h4><a class="aproduct"
                                                       href="{{URL::to('/san-pham/'.$item->alias.'/'.$item->id)}}">{{$item->name}}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination-wrap text-right">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
@endsection
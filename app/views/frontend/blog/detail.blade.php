@extends('frontend.layout.layout')

@section('title', $blog->title)
@section('description', $blog->summary)
@section('keywords', $blog->title)
<?php

$socialimage = URL::asset('public/uploads/blog') . '/' . rawurlencode($blog->image);
$currentUrl = Url::current();
$social = new stdClass();
$social->url = $currentUrl;
$social->image = $socialimage;
$social->title = $blog->title;
$social->desc = $blog->summary;
$social->img_width = 250;
$social->img_height = 320;
?>
@section('meta')
    @include('frontend.facebookmeta',array('social'=>$social))
@endsection
@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>BLOG</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li><a href="{{URL::to('/blog')}}">BLOG</a></li>
                <li class="active"><span>CHI TIẾT</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')

    <section class="blog-single" id="id_page" data-id="id_blog">
        <div class="container">

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="blog-posts single-post">

                        <article class="post post-large blog-single-post">
                            <div class="post-date">
                                <span class="day">{{date('d', strtotime($blog->created_at))}}</span>
                                <span class="month">Tháng {{date('m', strtotime($blog->created_at))}}</span>
                            </div>
                            <div class="post-content">
                                <h2 class="bl-title"><a>{{$blog->title}}</a></h2>
                                <div class="post-meta">
                                    <span><i class="fa fa-calendar"></i> {{date('d-m-Y', strtotime($blog->created_at))}} </span>
                                    {{--<span><i class="fa fa-tag"></i>  </span>--}}
                                    <span><i class="fa fa-street-view" aria-hidden="true"></i> {{$blog->view}} views</span>
                                </div>
                                {{$blog->description}}
                                <div class="post-block post-share">
                                    <h3 onclick="share_fb('{{URL::to('/blog/'.$blog->alias.'/'.$blog->id)}}')"><i class="fa fa-share"></i>Chia sẻ blog</h3>

                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

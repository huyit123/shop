@extends('frontend.layout.layout')

@section('title', 'Blog')
@section('description', 'Blog')
@section('keywords', 'Blog')
@section('banner')
    <div class="page_title_ctn">
        <div class="container-fluid">
            <h2>BLOG</h2>
            <ol class="breadcrumb">
                <li><a href="/">TRANG CHỦ</a></li>
                <li class="active"><span>BLOG</span></li>
            </ol>

        </div>
    </div>

@endsection
@section('content')

    <section class="blogstyle-1" id="id_page" data-id="id_blog">
        <div class="container">
            <div class="row equal">
                @foreach($blog as $item)
                    <div class="col-md-4 col-sm-4">
                        <article class="blog-post-container clearfix">
                            <div class="post-thumbnail">
                                <img src="{{asset('public/uploads/blog/'.$item->image)}}" class="img-responsive " alt="{{$item->title}}">
                            </div>
                            <div class="blog-content">
                                <div class="dart-header">
                                    <h4 class="dart-title"><a href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}" title="{{$item->title}}">{{$item->title}}</a></h4>
                                    <div class="dart-meta">
                                        <ul class="list-unstyled">
                                            <li><span class="posted-date"><i class="fa fa-calendar"></i> {{date('d-m-Y', strtotime($item->created_at))}}</span></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="dart-content">
                                    <p>{{mb_substr($item->summary, 0, 230, 'utf-8').'...'}}</p>
                                </div>

                                <div class="dart-footer">
                                    <ul class="dart-meta clearfix list-unstyled">
                                        <li><a class="pull-left" href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}"><i class="fa fa-street-view" aria-hidden="true"></i> &nbsp; {{$item->view}} views</a></li>
                                        <li><a class="pull-right" href="{{URL::to('/blog/'.$item->alias.'/'.$item->id)}}"> Xem Thêm <i
                                                        class="fa fa-angle-double-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>

                @endforeach

            </div>

            <div class="pagination-wrap text-right">
                {{ $blog->links() }}
            </div>
        </div>
    </section>
@endsection

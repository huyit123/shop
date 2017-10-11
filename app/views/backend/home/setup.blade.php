@extends('backend.layout.layout')

@section('title', 'Thiết lập')
@section('description', 'Thiết lập')
@section('keywords', 'Thiết lập')
@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_setup">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active"> Thiết lập</li>
    </ol>

    <h4 class="page-title">Thiết lập</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Link facebook</label>
                    <input type="text" name="facebook"
                           value="{{$data->facebook}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email (điền đúng thông tin email và mật khẩu, email này được dùng để gửi đơn hàng cho khác hàng thông qua email của bạn)</label>
                    <input type="text" name="email"
                           value="{{$data->email}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password email</label>
                    <input type="password" name="password"
                           value="{{$data->password}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone"
                           value="{{$data->phone}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address"
                           value="{{$data->address}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Giới thiệu ngắn</label>
                    <input type="text" name="aboutus"
                           value="{{$data->aboutus}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Logo</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->logo))
                                <img src='{{asset('public/uploads/logo/'.$data->logo)}}'>
                            @endif

                        </div>
                        <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Chọn hình ảnh</span>
                                <span class="fileupload-exists">Thay đổi</span>
                                <input type="file" name="logo"/>
                            </span>
                            <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Favicon</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->favicon))
                                <img src='{{asset('public/uploads/logo/'.$data->favicon)}}'>
                            @endif

                        </div>
                        <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Chọn hình ảnh</span>
                                <span class="fileupload-exists">Thay đổi</span>
                                <input type="file" name="favicon"/>
                            </span>
                            <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tiêu đề website</label>
                    <input type="text" name="titleweb"
                           value="{{$data->titleweb}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Mô tả </label>
                    <input type="text" name="description"
                           value="{{$data->description}}"
                           placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Keyword</label>
                    <input type="text" name="keyword"
                           value="{{$data->keyword}}"
                           placeholder="" class="form-control">
                </div>
                <button type="submit" class="btn btn-alt ">Lưu</button>
            </form>
        </div>

    </div>
@endsection

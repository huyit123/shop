@extends('backend.layout.layout')

@section('title', 'Danh sách banner')
@section('description', 'Danh sách banner')
@section('keywords', 'Danh sách banner')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_banner">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách banner</li>
    </ol>

    <h4 class="page-title">Danh sách banner</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        {{FcHelper::Alertmessage($errors)}}
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/banner/update') }}" class="btn">Tạo Mới banner</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Type</th>
                <th>Cập nhật</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($banners as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td><img src="{{asset('public/uploads/banner/'.$item->image)}}" width="100"/></td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->link}}</td>
                    <td>
                        @if($item->type == 'main')
                            <span>Banner chính (size: 1920x728)</span>
                        @elseif($item->type == 'big')
                            <span>Banner lớn (size: 1058x751)</span>
                        @elseif($item->type == 'midium')
                            <span>Banner vừa (size: 1058x419)</span>
                        @else
                            <span>Banner nhỏ (size: 529x334)</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-alt" href="{{ URL::to('admin/banner/update/'.$item->id) }}">Cập Nhật</a>
                        <a onclick="return confirm('Bạn muốn xóa banner này?');" class="btn btn-alt" href="{{ URL::to('admin/banner/delete/'.$item->id) }}">Xóa</a>
                    </td>
                </tr>
                <?php $stt++; ?>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script>
        $('#example2').DataTable({
            "sPaginationType": "full_numbers",
            "aaSorting": [],
            "aoColumnDefs": [
                {"aTargets": [0], "bSortable": true},
                {"aTargets": [1], "bSortable": true},
                {"aTargets": [2], "bSortable": true},
                {"aTargets": [3], "bSortable": true},
                {"aTargets": [4], "bSortable": true},
            ]
        });
    </script>
@endsection

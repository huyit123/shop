@extends('backend.layout.layout')

@section('title', 'Danh sách blog')
@section('description', 'Danh sách blog')
@section('keywords', 'Danh sách blog')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_blog">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách blog</li>
    </ol>

    <h4 class="page-title">Danh sách blog</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/blog/update') }}" class="btn">Tạo Mới Blog</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>View</th>
                <th>Tags</th>
                <th>Cập nhật</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($blogs as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td><img src="{{asset('public/uploads/blog/'.$item->image)}}" width="100" /></td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->view}}</td>
                    <td>{{$item->tags}}</td>
                    <td><a class="btn btn-alt" href="{{ URL::to('admin/blog/update/'.$item->id) }}">Cập Nhật</a></td>
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

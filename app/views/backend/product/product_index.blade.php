@extends('backend.layout.layout')

@section('title', 'Sản phẩm')
@section('description', 'Sản phẩm')
@section('keywords', 'Sản phẩm')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_product">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Sản Phẩm</li>
    </ol>

    <h4 class="page-title">Sản Phẩm</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        {{FcHelper::Alertmessage($errors)}}
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/product/update') }}" class="btn">Tạo Mới Sản Phẩm</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên Sản phẩm</th>
                <th>Giá</th>
                <th>Giá cũ</th>
                <th>Danh mục</th>
                <th>Số lượng</th>
                <th>Cập nhật</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($products as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td><img src="{{asset('public/uploads/product/'.$item->image)}}" width="100" /></td>
                    <td>{{$item->name}}</td>
                    <td>{{FcHelper::formatprice($item->price)}}</td>
                    <td>{{FcHelper::formatprice($item->price_old)}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->quantity}}</td>
                    <td><a class="btn btn-alt" href="{{ URL::to('admin/product/update/'.$item->id) }}">Cập Nhật</a>
                        <a onclick="return confirm('Bạn muốn xóa sản phẩm này?');" class="btn btn-alt" href="{{ URL::to('admin/product/delete/'.$item->id) }}">Xóa</a>
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

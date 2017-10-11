@extends('backend.layout.layout')

@section('title', 'Danh sách chương trình giảm giá')
@section('description', 'Danh sách chương trình giảm giá')
@section('keywords', 'Danh sách chương trình giảm giá')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_discount">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách chương trình giảm giá</li>
    </ol>

    <h4 class="page-title">Danh sách chương trình giảm giá</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/discount/update') }}" class="btn">Tạo mới chương trình giảm giá</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sự kiện</th>
                <th>Mã sự kiện</th>
                <th>Số lượng</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Kiểu giảm giá</th>
                <th>Giá hoặc %</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($discount as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->codeevent}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{date('d/m/Y', strtotime($item->startdate))}}</td>
                    <td>{{date('d/m/Y', strtotime($item->enddate))}}</td>
                    <td>
                        @if($item->type == 'price')
                            <span>Giảm theo giá tiền</span>
                        @else
                            <span>Giảm theo phần trăm</span>
                        @endif
                    </td>
                    <td>
                        @if($item->type == 'price')
                            <span>{{FcHelper::formatprice($item->price)}}</span>
                        @else
                            <span>{{$item->price . '%'}}</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-alt" href="{{ URL::to('admin/discount/update/'.$item->id) }}">Cập Nhật</a>
                        <a class="btn btn-alt" href="{{ URL::to('admin/discount/code/'.$item->id) }}">Danh Sách Mã Giảm Giá</a>
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

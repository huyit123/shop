@extends('backend.layout.layout')

@section('title', 'Danh sách mã giảm giá')
@section('description', 'Danh sách mã giảm giá')
@section('keywords', 'Danh sách mã giảm giá')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_discount">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách mã giảm giá</li>
    </ol>

    <h4 class="page-title">Danh sách mã giảm giá</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/discount') }}" class="btn">Quay về</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sự kiện</th>
                <th>Mã sự kiện</th>
                <th>Mã giảm giá</th>
                <th>Trạng thái sử dụng</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($discount as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->codeevent}}</td>
                    <td>{{$item->code}}</td>
                    <td>
                        @if($item->isused == 0)
                            <span class="label label-warning">Chưa sử dụng</span>
                        @else
                            <span class="label label-success">Đã sử dụng</span>
                        @endif
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

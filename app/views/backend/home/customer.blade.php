@extends('backend.layout.layout')

@section('title', 'Danh sách khách hàng')
@section('description', 'Danh sách khách hàng')
@section('keywords', 'Danh sách khách hàng')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="id_customer">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách khách hàng</li>
    </ol>

    <h4 class="page-title">Danh sách khách hàng</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Ngày tạo</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($data as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
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
            ]
        });
    </script>
@endsection

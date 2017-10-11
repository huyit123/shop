@extends('backend.layout.layout')

@section('title', 'Danh sách đăng ký')
@section('description', 'Danh sách đăng ký')
@section('keywords', 'Danh sách đăng ký')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="id_newsletter">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh sách đăng ký</li>
    </ol>

    <h4 class="page-title">Danh sách đăng ký</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($emails as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$item->data}}</td>
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

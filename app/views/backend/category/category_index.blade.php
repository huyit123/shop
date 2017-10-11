@extends('backend.layout.layout')

@section('title', 'Danh mục')
@section('description', 'Danh mục')
@section('keywords', 'Danh mục')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_category">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Danh Mục</li>
    </ol>

    <h4 class="page-title">Danh Mục</h4>

    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        <div style="margin: 10px 0;">
            <a href="{{ URL::to('admin/category/update') }}" class="btn">Tạo Mới Danh Mục</a>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Sắp Xếp</th>
                <th>Hiển thị</th>
                <th>Cập nhật</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($categories as $category)

                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->orderby}}</td>
                    <td>
                        @if($category->display == 1)
                            <span class="label label-success">CÓ</span>
                        @else
                            <span class="label label-warning">KHÔNG</span>
                        @endif
                    </td>
                    <td><a class="btn btn-alt" href="{{ URL::to('admin/category/update/'.$category->id) }}">Cập Nhật</a></td>
                </tr>
                @foreach($category->subCategory as $sub)
                    <tr>
                        <td></td>
                        <td>-- {{$sub->title}}</td>
                        <td>{{$sub->orderby}}</td>
                        <td>
                            @if($sub->display == 1)
                                <span class="label label-success">CÓ</span>
                            @else
                                <span class="label label-warning">KHÔNG</span>
                            @endif

                        </td>
                        <td><a class="btn btn-alt" href="{{ URL::to('admin/category/update/'.$sub->id) }}">Cập Nhật</a></td>
                    </tr>
                @endforeach
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
                {"aTargets": [0], "bSortable": false},
                {"aTargets": [1], "bSortable": false},
                {"aTargets": [2], "bSortable": false},
                {"aTargets": [3], "bSortable": false},
                {"aTargets": [4], "bSortable": false},
            ]
        });
        //        $('#example2').DataTable({
        //            "sPaginationType": "full_numbers",
        //            "aaSorting": [[0, 'asc']],
        //            "aoColumnDefs": [
        //                { "aTargets": [0], "bSortable": false },
        //                { "aTargets": [1], "bSortable": false },
        //                { "aTargets": [2], "bSortable": false }
        //            ]
        //        });

    </script>
@endsection

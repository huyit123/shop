@extends('backend.layout.layout')

@section('title', 'Phí giao hàng')
@section('description', 'Phí giao hàng')
@section('keywords', 'Phí giao hàng')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_shipping">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Phí giao hàng</li>
    </ol>

    <h4 class="page-title">Phí giao hàng</h4>
    <!-- Deafult Table -->
    <div class="block-area" id="defaultStyle">
        {{FcHelper::Alertmessage($errors)}}
        <div style="margin: 10px 0;">
            <button data-toggle="modal" href="#myModal" class="btn">Cập nhật phí giao hàng</button>
        </div>
        <table class="table tile" id="example2">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tỉnh/ Thành</th>
                <th>Phí giao</th>
                <th>Thời gian giao</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach($data as $item)
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{FcHelper::formatprice($item->price)}}</td>
                    <td>{{$item->timeshipping}}</td>
                </tr>
                @foreach($item->subprovince as $sub)
                    <tr>
                        <td></td>
                        <td>{{$sub->name}}</td>
                        <td>{{FcHelper::formatprice($sub->price)}}</td>
                        <td>{{$sub->timeshipping}}</td>
                    </tr>
                @endforeach
                <?php $stt++; ?>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h3 class="modal-title">
                        Cập nhật phí giao hàng
                    </h3>
                </div>
                <div class="modal-body no-padding">
                    <form id="checkout-form" class="smart-form" action="{{URL::current()}}" method="post">
                        <div class="form-group">
                            <label>Khu vực *</label>
                            <select class="form-control tag-select" name="id" required id="district">
                                <option value=""  selected="">chọn khu vực</option>
                                @foreach($data as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @foreach($item->subprovince as $sub)
                                        <option value="{{$sub->id}}">|-- {{$sub->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phí giao hàng *</label>
                            <input type="text" name="price" placeholder="phí giao hàng" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Thời gian giao hàng *</label>
                            <input type="text" name="timeshipping" placeholder="thời gian giao hàng dự kiến" class="form-control" required>
                        </div>

                    <footer>
                        <button type="submit" class="btn btn-primary">
                            Lưu
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Hủy
                        </button>

                    </footer>
                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <style>
        #district_chzn a{
            padding: 10px 8px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: block;
        }
        #district_chzn .chzn-drop .chzn-search input{
            width: 100%;
            color: #333;
            padding: 0 10px;
            height: 35px;
        }
    </style>
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
                {"aTargets": [3], "bSortable": true}
            ]
        });
        $('#district').chosen();
    </script>
@endsection

@extends('backend.layout.layout')

@section('title', 'Sản phẩm sales')
@section('description', 'Sản phẩm sales')
@section('keywords', 'Sản phẩm sales')

@section('content')

    <ol class="breadcrumb hidden-xs" data-active="li_sales">
        <li><a href="#">Trang Chủ</a></li>
        <li class="active">Sản phẩm sales</li>
    </ol>

    <h4 class="page-title">Sales</h4>

    <div class="block-area" id="invalid">
        {{FcHelper::Alertmessage($errors)}}
        <div class="tile p-15">
            <form class="abc" method="post" action="{{URL::current()}}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Tên chương trình</label>
                    <input type="text" data-val="true" data-val-required="Vui lòng nhập tên chương trình" name="title"
                           value="{{$data->title}}"
                           placeholder="" class="form-control">
                    <span class="field-validation-error" data-valmsg-for="title" data-valmsg-replace="true"></span>
                </div>

                <div class="form-group">
                    <label for="email">Chọn sản phẩm</label>
                    <div class="">
                        <select name="productid[]" multiple id="productid" data-placeholder="Chọn sản phẩm sale">
                            @foreach($product as $item)
                                <?php
                                $selected = '';
                                if (in_array($item->id, $data->data)) {
                                    $selected = 'selected';
                                }
                                ?>
                                <option {{$selected}} value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <?php
                $start = '';
                if (!empty($data->startdate)) {
                    $start = date('d/m/Y', strtotime($data->startdate));
                }
                $end = '';
                if (!empty($data->enddate)) {
                    $end = date('d/m/Y', strtotime($data->enddate));
                }
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Ngày bắt đầu</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" class="form-control input-sm"
                                       value="{{$start}}" name="startdate"
                                       data-val="true" data-val-required="Vui lòng chọn ngày bắt đầu"/>
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                            <span class="field-validation-error" data-valmsg-for="startdate"
                                  data-valmsg-replace="true"></span>
                        </div>
                        <div class="col-md-6">
                            <label>Ngày kết thúc</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" class="form-control input-sm"
                                       value="{{$end}}" name="enddate"
                                       data-val="true" data-val-required="Vui lòng chọn ngày kết thúc"/>
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                            <span class="field-validation-error" data-valmsg-for="enddate"
                                  data-valmsg-replace="true"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Hình ảnh</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control">
                            @if(!empty($data->image))
                                <img src='{{asset('public/uploads/config/'.$data->image)}}'>
                            @endif

                        </div>
                        <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Chọn hình ảnh</span>
                                <span class="fileupload-exists">Thay đổi</span>
                                <input type="file" name="image"/>
                            </span>
                            <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Tóm tắt sản phẩm</label>
                    <textarea rows="5" name="summary" class="form-control">{{$data->summary}}</textarea>
                </div>


                <button type="submit" class="btn btn-alt ">Lưu</button>
            </form>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $('#productid').chosen();
    </script>
@endsection

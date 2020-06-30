@extends('admin.layoutsite')
@section('title')
    Quản Lý Hãng
@endsection
@section('head')

@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Thêm Hãng </li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
@includeIf('admin.products.modules.message')

<div class="container">
<form  action="{{ Route('post_add_brandproduct') }}" method="post" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                <strong class="text-danger">
                    Thêm Hãng
                </strong>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-success" id="save-form" ><i class="far fa-save"></i>Lưu[Sữa]</button>

                    <a href="{{ Route('indexbrandproduct') }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i>Quay Lại

                    </a>
                </div>

            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-9 box effect1">
                <div class="form-group">
                    <label>Tên Hãng Đồng Hồ</label>
                    <input name="name" class="form-control" type="text" value="{{ old('name') }}">
                 @if ($errors->has('name'))
                 <span class="text-danger">{{ $errors->first('name') }}</span>
                 @endif


                </div>
                <div class="form-group">
                    <label>Mã Hãng Đồng Hồ</label>
                    <input name="code" class="form-control" type="text" value="{{ old('name') }}">
                 @if ($errors->has('code'))
                 <span class="text-danger">{{ $errors->first('code') }}</span>
                 @endif

                </div>
                <div class="form-group">
                    <label>Chi Tiết Đồng Hồ</label>
                    <textarea id="my-editor" name="detail" class="form-control">
                        {{ old('detail') }}
                    </textarea>

            </div>
                <div class="form-group">
                    <label>Từ Khóa Meta Key</label>
                    <textarea name="metakey" class="form-control" rows="3">{{ old('metakey') }}
                    </textarea>
                 @if ($errors->has('metakey'))
                 <span class="text-danger">{{ $errors->first('metakey') }}</span>
                 @endif

                </div>
                <div class="form-group">
                    <label>Từ Khóa Meta Key</label>
                    <textarea name="metadesc" class="form-control" rows="3">{{ old('metakey') }}
                    </textarea>
                 @if ($errors->has('metadesc'))
                 <span class="text-danger">{{ $errors->first('metadesc') }}</span>
                 @endif

                </div>

                <div class="form-group text-center">
                 <label>Trạng Thái</label>
                 <div class="custom-control custom-switch">
                     <input type="checkbox" class="custom-control-input" name="status" id="status" >
                     <label class="custom-control-label" for="status"></label>
                 </div>

                </div>
            </div>
            <div class="col-md-3 box effect1">
                     <div class="form-group">
                         <label>Chọn Ảnh Đại Diện</label>
                         <div class="input-group">
                             <span class="input-group-btn">
                               <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                 <i class="far fa-images"></i>Chọn Ảnh
                               </a>
                             </span>
                             <input id="thumbnail" class="form-control" type="text" name="filepath" readonly value="{{old('filepath')}}">
                           </div>
                           <img id="holder" style="margin-top:15px;max-height:100px;" src="">
                           @if ($errors->has('filepath'))
                           <span class="text-danger">{{ $errors->first('filepath') }}</span>
                           @endif
                     </div>
                </div>
        </div>

    </div>
 </div>
 </div>
 </form>
</div>


@includeIf('admin.products.modules.message')
@endsection
@section('script')
<script>
        $(document).ready(function(){
            if($("#status").is(":checked"))
            {
                $(".custom-control-label").text('Đang Hoạt Động');
            }else
            {
                $(".custom-control-label").text('Tắt Hoạt Động');
            }
            $('#status').click(function(){
                if($("#status").is(":checked"))
                {
                    $(".custom-control-label").text('Đang Hoạt Động');
                }else
                {
                    $(".custom-control-label").text('Tắt Hoạt Động');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            if($("#status").is(":checked"))
            {
                $(".custom-control-label").text('Đang Hoạt Động');
            }else
            {
                $(".custom-control-label").text('Tắt Hoạt Động');
            }
            $('#status').click(function(){
                if($("#status").is(":checked"))
                {
                    $(".custom-control-label").text('Đang Hoạt Động');
                }else
                {
                    $(".custom-control-label").text('Tắt Hoạt Động');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
                language:'vi',
                uiColor: '#14B8C4',
                };
                CKEDITOR.replace('my-editor', options);
        });
    </script>
    {{-- <script src="/vendor/laravel-filemanager/js/lfm.js"></script> --}}

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
   <script>
    var route_prefix = "/laravel-filemanager?type=Images";
    $('#lfm').filemanager('image', {prefix: route_prefix});
    </script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
        });
    </script>

@endsection

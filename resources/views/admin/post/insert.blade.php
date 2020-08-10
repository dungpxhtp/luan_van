@extends('admin.layoutsite')
@section('title')
    Thêm bài viết
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

<style>
    body{
        background-color: #ccc;

    }
    .box{
        background: #fff;
        margin: 10px auto;
    }
    .effect1{
        -webkit-box-shadow: 0 10px 6px -6px #777;
           -moz-box-shadow: 0 10px 6px -6px #777;
                box-shadow: 0 10px 6px -6px #777;
    }

</style>


@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Tin Tức</li>
               <li class="breadcrumb-item active">Thêm bài viết</li>

            </ol>
    </div>

</nav>
    @includeIf('admin.products.modules.message')
    <div class="container">
        <form  action="{{ Route('insert.postPost') }}" method="post" role="form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
<div class="container-fluid">
       <div class="card">
           <div class="card-header">
               <div class="row">
                   <div class="col-md-6">
                   <strong class="text-danger">
                        Thêm bài viết
                    </strong>
                   </div>
                   <div class="col-md-6 text-right">
                       <button type="submit" class="btn btn-success" id="save-form" ><i class="far fa-save"></i>Lưu[Sữa]</button>

                       <a href="{{ Route('index.post') }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i>Quay Lại

                       </a>
                   </div>

               </div>

           </div>

       </div>
       <div class="card-body">
           <div class="row">
               <div class="col-md-9 box effect1">
                   <div class="form-group">
                       <label>Tên Bài Viết</label>
                       <input name="title" class="form-control" type="text" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif


                   </div>

                   <div class="form-group">
                           <label>Bài Viết</label>
                           <textarea id="my-editor" name="detail" class="form-control">{{ old('detail') }}</textarea>

                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Meta Key</label>
                           <textarea name="metakey" class="form-control" rows="2" >{{ old('metakey') }}</textarea>

                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Meta Desc</label>
                           <textarea name="metadesc" class="form-control" rows="2">{{ old('metakey') }}</textarea>

                   </div>
                   <div class="form-group text-center">
                    <label>Trạng Thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="status" id="status">
                        <label class="custom-control-label status" for="status"></label>
                    </div>

                   </div>

               </div>
               <div class="col-md-3 box effect1">

                       {{--  <div class="form-group">
                           <label>Số Lượng Của Sản Phẩm</label>
                           <input name="quantity" class="form-control" type="number" min="0"  value="{{ old('quantity') }}" >
                           @if ($errors->has('quantity'))
                           <span class="text-danger">{{ $errors->first('quantity') }}</span>
                           @endif
                       </div>  --}}
                       <div class="form-group ">
                        <label>Chủ đề bài viết</label>
                        <select name="id_topic" class="form-control">
                         @foreach($topic as $item)

                                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                         @endforeach
                        </select>
                                @if ($errors->has('id_topic'))
                                <span class="text-danger">{{ $errors->first('id_topic') }}</span>
                                @endif
                    </div>

                        <div class="form-group">
                            <label>Chọn Ảnh Đại Diện</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="far fa-images"></i>Chọn Ảnh
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="filepath" readonly value="{{old('filepath')}}" >
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

@endsection

@section('script')
    <script src="{{ asset('js/myJs/toggle.js') }}">

    </script>
    <script src="{{ asset('js/myJs/formartVND.js') }}">
    </script>
    <script>
        var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        language:'vi',
        uiColor: '#14B8C4',
        };
        CKEDITOR.replace('my-editor', options);
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

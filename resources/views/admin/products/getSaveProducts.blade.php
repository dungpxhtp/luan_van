@extends('admin.layoutsite')
@section('title')
    Sản Phẩm
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Loại </li>
            </ol>
    </div>
    @includeIf('admin.products.modules.message')
    <div class="container">
        <form  action="{{ Route('post_index_save') }}" method="post" role="form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
<div class="container-fluid">
       <div class="card">
           <div class="card-header">
               <div class="row">
                   <div class="col-md-6">
                   <strong class="text-danger">
                      Sửa Sản Phẩm
                   </strong>
                   </div>
                   <div class="col-md-6 text-right">
                       <button type="submit" class="btn btn-success" id="save-form" ><i class="far fa-save"></i>Lưu[Sữa]</button>

                       <a href="{{ Route('productindex') }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i>Quay Lại

                       </a>
                   </div>

               </div>

           </div>

       </div>
       <div class="card-body">
           <div class="row">
               <div class="col-md-9 box effect1">
                   <div class="form-group">
                       <label>Tên Đồng Hồ</label>
                       <input name="name" class="form-control" type="text" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif


                   </div>
                <div class="form-group">
                    <label>Mã Đồng Hồ</label>
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
                           <textarea name="metakey" class="form-control" rows="2" >
                            {{ old('metakey') }}
                           </textarea>

                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Meta Desc</label>
                           <textarea name="metadesc" class="form-control" rows="2"  >
                            {{ old('metakey') }}
                           </textarea>

                   </div>
                   <div class="form-group text-center">
                    <label>Trạng Thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="status" id="status"}}>
                        <label class="custom-control-label" for="status"></label>
                    </div>

                   </div>
               </div>
               <div class="col-md-3 box effect1">
                       <div class="form-group ">
                           <label>Đối Tượng </label>
                           <select name="id_gendercategoryproducts" class="form-control">
                            @foreach($genderCate as $idGender)


                                <option value="{{ $idGender->id }}">{{ $idGender->name }}</option>







                            @endforeach
                           </select>

                           @if ($errors->has('id_gendercategoryproducts'))
                           <span class="text-danger">{{ $errors->first('detail') }}</span>
                           @endif

                       </div>
                       <div class="form-group ">
                        <label>Bộ Máy Đồng Hồ</label>
                        <select name="id_productmodel" class="form-control">
                         @foreach($Model as $idModel)


                             <option value="{{ $idModel->id }}">{{ $idModel->name }}</option>







                         @endforeach
                        </select>

                        @if ($errors->has('id_productmodel'))
                        <span class="text-danger">{{ $errors->first('id_productmodel') }}</span>
                        @endif

                    </div>
                    <div class="form-group ">
                        <label>Size Đồng Hồ</label>
                        <select name="id_productssize" class="form-control">
                         @foreach($Size as $idSize)


                             <option value="{{ $idSize->id }}">{{ $idSize->name }}</option>


                         @endforeach
                        </select>


                        @if ($errors->has('id_productssize'))
                        <span class="text-danger">{{ $errors->first('id_productssize') }}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label>Độ Chống Nước</label>
                        <select name="id_productwaterproorf" class="form-control">
                         @foreach($WaterProorf as $idWaterProorf)


                             <option value="{{ $idWaterProorf->id }}">{{ $idWaterProorf->name }}</option>







                         @endforeach
                        </select>

                        @if ($errors->has('id_productwaterproorf'))
                        <span class="text-danger">{{ $errors->first('id_productwaterproorf') }}</span>
                        @endif

                    </div>
                    <div class="form-group ">
                        <label>Mặt Kính Đồng Hồ</label>
                        <select name="id_productglasses" class="form-control">
                         @foreach($Glass as $idGlass)


                             <option value="{{ $idGlass->id }}">{{ $idGlass->name }}</option>







                         @endforeach
                        </select>

                        @if ($errors->has('id_productglasses'))
                        <span class="text-danger">{{ $errors->first('id_productglasses') }}</span>
                        @endif

                    </div>
                    <div class="form-group ">
                        <label>Loại Đồng Hồ</label>
                        <select name="id_categoryproducts" class="form-control">
                         @foreach($categoryproducts as $idcategoryproducts)


                             <option value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>







                         @endforeach
                        </select>
                        @if ($errors->has('id_categoryproducts'))
                        <span class="text-danger">{{ $errors->first('id_categoryproducts') }}</span>
                        @endif

                    </div>

                    <div class="form-group ">
                        <label>Màu Sắc Đồng Hồ</label>
                        <select name="id_productboder" class="form-control">
                         @foreach($Borderscolor as $idBorderscolor)


                             <option value="{{ $idBorderscolor->id }}">{{ $idBorderscolor->name }}</option>






                         @endforeach
                        </select>
                        @if ($errors->has('id_productboder'))
                        <span class="text-danger">{{ $errors->first('id_productboder') }}</span>
                        @endif

                    </div>
                    <div class="form-group ">
                        <label>Loại Đồng Hồ</label>
                        <select name="id_categoryproducts" class="form-control">

                         @foreach($categoryproducts as $idcategoryproducts)


                             <option value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>






                         @endforeach
                        </select>
                        @if ($errors->has('id_brandproducts'))
                        <span class="text-danger">{{ $errors->first('id_brandproducts') }}</span>
                        @endif

                    </div>
                    <div class="form-group ">
                        <label>Hãng Đồng Hồ</label>
                        <select name="id_brandproducts" class="form-control">

                         @foreach($Brands as $idBrands)


                             <option value="{{ $idBrands->id }}">{{ $idBrands->name }}</option>







                         @endforeach
                        </select>

                        @if ($errors->has('id_gendercategoryproducts'))
                        <span class="text-danger">{{ $errors->first('id_gendercategoryproducts') }}</span>
                        @endif

                    </div>
                       <div class="form-group">
                           <label>Số Lượng Của Sản Phẩm</label>
                           <input name="quantity" class="form-control" type="number" min="0"  value="{{ old('quantity') }}">
                           @if ($errors->has('quantity'))
                           <span class="text-danger">{{ $errors->first('quantity') }}</span>
                           @endif
                       </div>
                       <div class="form-group">
                               <label>Giá Bán</label>
                               <input name="price" class="form-control" id="price" type="number" min="10000" value="{{ old('price') }}" >
                               <label class="price-formart"></label>
                               @if ($errors->has('price'))
                               <span class="text-danger">{{ $errors->first('price') }}</span>
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

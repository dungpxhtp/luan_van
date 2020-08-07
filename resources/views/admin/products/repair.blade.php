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
    @includeIf('admin.public.template.breadcurmb', ['breadcrumb' => 'Sửa Sản Phẩm'])
    @includeIf('admin.products.modules.message')
<div class="container">
        <form  action="{{ Route('save_repair',['id_product'=> $products->id ]) }}" method="post" role="form" method="POST" enctype="multipart/form-data">
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
                       <input name="name" class="form-control" type="text" value="{{ old('name',$products->name) }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                   </div>
                <div class="form-group">
                    <label>Mã Đồng Hồ</label>
                    <input name="code" class="form-control" type="text" value="{{ old('name',$products->code) }}">
                        @if ($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
                </div>
                   <div class="form-group">
                           <label>Chi Tiết Đồng Hồ</label>
                           <textarea id="my-editor" name="detail" class="form-control">{{ old('detail',$products->detail) }}</textarea>
                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Meta Key</label>
                           <textarea name="metakey" class="form-control" rows="2" >{{ old('metakey',$products->metakey) }}</textarea>

                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Meta Desc</label>
                           <textarea name="metadesc" class="form-control" rows="2"  >{{ old('metakey',$products->metadesc) }}</textarea>
                   </div>
                   <div class="form-group text-center">
                    <label>Trạng Thái</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="status" id="status" {{ $products->status ==1 ?"Checked":"" }}>
                            <label class="custom-control-label" for="status"></label>
                        </div>
                   </div>
                   <div class="form-group text-center">
                    <label>Serinumber</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="serinumber" id="serinumber" {{ $products->serinumber ==1 ?"Checked":"" }}>
                            <label class="custom-control-label serinumber " for="serinumber"></label>
                        </div>

                   </div>
               </div>
               <div class="col-md-3 box effect1">
                       <div class="form-group ">
                           <label>Đối Tượng </label>
                           <select name="id_gendercategoryproducts" class="form-control">
                            @foreach($genderCate as $idGender)
                                @if ($products->id_gendercategoryproducts==$idGender->id)
                                    <option selected value="{{ $idGender->id }}">{{ $idGender->name }}</option>
                                @else
                                    <option value="{{ $idGender->id }}">{{ $idGender->name }}</option>
                                @endif
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
                                @if ($products->id_productmodel==$idModel->id)
                                    <option selected value="{{ $idModel->id }}">{{ $idModel->name }}</option>
                                @else
                                    <option value="{{ $idModel->id }}">{{ $idModel->name }}</option>
                                @endif
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
                            @if ($products->id_productssize==$idSize->id)
                                <option selected value="{{ $idSize->id }}">{{ $idSize->name }}</option>
                            @else
                                <option value="{{ $idSize->id }}">{{ $idSize->name }}</option>
                            @endif
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
                            @if($products->id_productwaterproorf==$idWaterProorf->id)
                                <option selected value="{{ $idWaterProorf->id }}">{{ $idWaterProorf->name }}</option>
                            @else
                                <option value="{{ $idWaterProorf->id }}">{{ $idWaterProorf->name }}</option>
                            @endif
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
                            @if($products->id_productglasses==$idGlass->id)
                                <option selected value="{{ $idGlass->id }}">{{ $idGlass->name }}</option>
                            @else
                                <option value="{{ $idGlass->id }}">{{ $idGlass->name }}</option>
                            @endif
                         @endforeach
                        </select>
                                @if ($errors->has('id_productglasses'))
                                 <span class="text-danger">{{ $errors->first('id_productglasses') }}</span>
                                @endif
                    </div>
                    {{-- <div class="form-group ">
                        <label>Loại Đồng Hồ</label>
                        <select name="id_categoryproducts" class="form-control">
                         @foreach($categoryproducts as $idcategoryproducts)
                            @if($products->id_categoryproducts==$idcategoryproducts->id)
                                <option selected value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>
                            @else
                                <option value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>
                            @endif
                         @endforeach
                        </select>
                        @if ($errors->has('id_categoryproducts'))
                          <span class="text-danger">{{ $errors->first('id_categoryproducts') }}</span>
                        @endif

                    </div> --}}

                    <div class="form-group ">
                        <label>Màu Sắc Đồng Hồ</label>
                        <select name="id_productboder" class="form-control">
                         @foreach($Borderscolor as $idBorderscolor)
                            @if($products->id_productboder==$idBorderscolor->id)
                                <option selected value="{{ $idBorderscolor->id }}">{{ $idBorderscolor->name }}</option>
                            @else
                                <option value="{{ $idBorderscolor->id }}">{{ $idBorderscolor->name }}</option>
                            @endif
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
                            @if($products->id_categoryproducts==$idcategoryproducts->id)
                                <option selected value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>
                            @else
                                <option value="{{ $idcategoryproducts->id }}">{{ $idcategoryproducts->name }}</option>
                            @endif
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
                                @if($products->id_brandproducts== $idBrands->id)
                                    <option selected value="{{ $idBrands->id }}">{{ $idBrands->name }}</option>
                                @else
                                    <option value="{{ $idBrands->id }}">{{ $idBrands->name }}</option>
                                @endif
                         @endforeach
                        </select>
                                @if ($errors->has('id_gendercategoryproducts'))
                                <span class="text-danger">{{ $errors->first('id_gendercategoryproducts') }}</span>
                                @endif
                    </div>
                       {{--  <div class="form-group">
                           <label>Số Lượng Của Sản Phẩm</label>
                           <input name="quantity" class="form-control" type="number" min="0" required oninvalid="this.setCustomValidity('Kiểm Tra Lại Số Lượng')" onchange="this.setCustomValidity('')"    value="{{ old('quantity',$products->quantity) }}">
                           @if ($errors->has('quantity'))
                           <span class="text-danger">{{ $errors->first('quantity') }}</span>
                           @endif
                       </div>  --}}
                       <div class="form-group">
                               <label>Giá Bán</label>
                               <input name="price" class="form-control" id="price" required type="number" min="10000" value="{{ old('price',$products->price) }}" >
                               <label class="price-formart"></label>
                               @if ($errors->has('price'))
                               <span class="text-danger">{{ $errors->first('price') }}</span>
                               @endif
                       </div>
                       <div class="form-group">
                            <label>Giá Giảm</label>
                            <input name="price_km" class="form-control" id="price_km" required type="number" min="10000" value="{{ old('price',$products->pricesale) }}" >
                            <label class="price-formart-km"></label>

                         </div>
                        <div class="form-group">
                            <label>Chọn Ảnh Đại Diện</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="far fa-images"></i>Chọn Ảnh
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="filepath" readonly value="{{old('filepath',$products->image)}}" >
                              </div>
                              <img id="holder" style="margin-top:15px;max-height:100px;" src="{{$products->image}}" alt="anh-san-pham">
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
    <script src="{{ asset('js/myJS/ckeditor.js') }}">
    </script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('js/myJs/buttonUpload.js') }}">
    </script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
        });
    </script>
@endsection

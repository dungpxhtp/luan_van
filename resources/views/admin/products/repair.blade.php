@extends('admin.layoutsite')
@section('title')
    Sản Phẩm
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Loại </li>
            </ol>
    </div>
    <div class="container">
        <form  action=""  method="post" role="form" enctype="multipart/form-data">
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
                       <button type="submit" class="btn btn-success" ><i class="far fa-save"></i>Lưu[Sữa]</button>

                       <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i>Quay Lại

                       </a>
                   </div>

               </div>

           </div>

       </div>
       <div class="card-body">
           @includeIf('backend.modules.message')
           <div class="row">
               <div class="col-md-9">
                   <div class="form-group">
                       <label>Tên sản Phẩm</label>
                       <input name="name" class="form-control" type="text" value="">



                   </div>
                   <div class="form-group">
                           <label>Chi Tiết sản Phẩm</label>
                          <textarea name="detail" class="form-control" rows="6" id="editor1"  ></textarea>
                   </div>
                   <div class="form-group">
                           <label>Mô Tả Seo</label>
                           <textarea name="metadesc" class="form-control" rows="2" > </textarea>
                   </div>
                   <div class="form-group">
                           <label>Từ Khóa Seo</label>
                           <textarea name="metakey" class="form-control" rows="2"  ></textarea>
                   </div>
               </div>
               <div class="col-md-3">
                       <div class="form-group">
                           <label>Loại Sản Phẩm</label>
                           <select name="catid" class="form-control">
                               <option value="">Chọn Loại Sản Phẩm</option>



                               <option selected value=""></option>

                                 <option value=""></option>




                           </select>

                           <span class="text-danger"></span>

                       </div>
                       <div class="form-group">
                           <label>Số Lượng</label>
                           <input name="soluong" class="form-control" type="number" min="1" value="1" value="">
                       </div>
                       <div class="form-group">
                               <label>Giá Bán</label>
                               <input name="price" class="form-control" type="number" min="10000" value="10000" >
                       </div>
                       <div class="form-group">
                               <label>Giá Khuyến Mãi</label>
                               <input name="pricesales" class="form-control" type="number" min="10000" value="10000">
                       </div>
                       <div class="form-group">
                               <label>Trạng Thái</label>
                               <select name="status" class="form-control">
                                   <option value="1">Xuất Bán</option>
                                   <option value="2">Chưa Xuất Bán</option>
                               </select>
                           </div>
                           <div class
                       <div class="form-group">
                               <label>Hình Đại Diện</label>
                               <input name="img" class="form-control" type="file">
                       </div>
                       <div class="form-group">
                        <label>Hình Liên Quan</label>
                        <input name="img" class="form-control" type="file">
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

@endsection

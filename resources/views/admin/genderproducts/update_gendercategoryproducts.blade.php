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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Cập Đối Tượng  {{ $getData->name }}</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
@includeIf('admin.products.modules.message')

<div class="container">
<form  action="{{ Route('post_update_gendercategoryproducts',['id_gendercategoryproducts'=>$getData->id]) }}" method="post" role="form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                <strong class="text-danger">
                    Đối Tượng
                </strong>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-success" id="save-form" ><i class="far fa-save"></i>Lưu[Sữa]</button>

                    <a href="{{ Route('indexgendercategoryproducts') }}" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i>Quay Lại

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
                    <input name="name" class="form-control" type="text" value="{{ old('name',$getData->name) }}">
                 @if ($errors->has('name'))
                 <span class="text-danger">{{ $errors->first('name') }}</span>
                 @endif


                </div>


                <div class="form-group">
                    <label>Từ Khóa Meta Key</label>
                    <textarea name="metakey" class="form-control" rows="3">{{ old('metakey',$getData->metakey) }}</textarea>
                 @if ($errors->has('metakey'))
                 <span class="text-danger">{{ $errors->first('metakey') }}</span>
                 @endif

                </div>
                <div class="form-group">
                    <label>Từ Khóa Meta Key</label>
                    <textarea name="metadesc" class="form-control" rows="3">{{ old('metakey',$getData->metadesc) }}</textarea>
                 @if ($errors->has('metadesc'))
                 <span class="text-danger">{{ $errors->first('metadesc') }}</span>
                 @endif

                </div>

                <div class="form-group text-center">
                 <label>Trạng Thái</label>
                 <div class="custom-control custom-switch">
                     <input type="checkbox" class="custom-control-input" name="status" id="status" {{ $getData->status ==1 ?"Checked":"" }}>
                     <label class="custom-control-label" for="status"></label>
                 </div>

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
            $("#thongbao").modal('show');
        });
    </script>

@endsection

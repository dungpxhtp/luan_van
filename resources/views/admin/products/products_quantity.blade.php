@extends('admin.layoutsite');
@section('title')
    Quản Lý Số Lượng Sản Phẩm
@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Sản Phẩm</li>
               <li class="breadcrumb-item active">Quản Lý Số Lượng Sản phẩm</li>

            </ol>
    </div>

</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           <div class="table-responsive-sm">
            <table class="table table-striped table-dark" id="table_index">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
           </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

    </script>
@endsection>

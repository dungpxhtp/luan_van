@if (session('message'))
<!-- Modal -->
@php
    $type=session('message');
@endphp
<div  class="modal fade thongbao" id="thongbao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-{{ $type["type"] }}" id="exampleModalCenterTitle">Thông Báo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-{{ $type["type"] }}">{{ $type["msg"] }}</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>

        </div>
      </div>
    </div>
  </div>




@endif

<div class="modal fade" id="delete-confirm-modal-{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Xác Nhận</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa {{ $name }} này không?</p>
                <p class="text-danger">@if($routerName == 'category.destroy') Việc xóa danh mục này sẽ đồng nghĩa với việc xóa toàn bộ danh mục con của nó. @endif</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                <a href="{{route($routerName,['accessory_type'=>$accessoryType ?? "", 'id' => $item->id])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="post-product-modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="post-product-modal-title-{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="post-product-modal-title-{{$item->id}}">Mô tả chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $item->post->content !!}
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

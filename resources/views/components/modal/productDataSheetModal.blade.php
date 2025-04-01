<div class="modal fade" id="data-sheet-product-modal-{{$item->product->id}}" tabindex="-1" role="dialog" aria-labelledby="data-sheet-product-modal-title-{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="data-sheet-product-modal-title-{{$item->product->id}}">DataSheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    {!! $item->data_sheet !!}
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

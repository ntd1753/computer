<div class="modal fade" id="seo-modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="seo-modal-title-{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seo-modal-title-{{$item->id}}">SEO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <table class="table table-bordered table-striped text-center">
                        <tbody class="text-left">
                        <tr>
                            <th>seo_keyword </th>
                            <th>{!!  $item-> seo_keywords !!}</th>
                        </tr>
                        <tr>
                            <th>seo_title </th>
                            <th>{!!  $item-> seo_title !!}</th>
                        </tr>
                        <tr>
                            <th>seo_description</th>
                            <th>{!!  $item  -> seo_description !!}</th>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>





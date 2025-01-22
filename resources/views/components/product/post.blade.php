<div class="card-body">
    <h4 class="card-title">Mô Tả</h4>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="metatitle">seo_title</label>
                <input id="metatitle" name="seo_title" type="text" class="form-control" value="{{$item->seo_title ?? ""}}"
                       placeholder="Metatitle">
            </div>
            <div class="mb-3">
                <label for="metakeywords">seo_keywords</label>
                <input id="metakeywords" name="seo_keywords" type="text" class="form-control" value="{{$item->seo_keywords ?? ""}}"
                       placeholder="Meta Keywords">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mb-3">
                <label for="metadescription">seo_description</label>
                <textarea class="form-control" id="Seo" rows="5" placeholder="Meta Description" name="seo_description">{!! $item->seo_description ?? ""!!}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <label for="metadescription">Nội Dung</label>
            <textarea class="form-control" id="content" rows="5" placeholder="Meta Description" name="content">{!! $item->content ?? ""!!}</textarea>
        </div>

    </div>

</div>

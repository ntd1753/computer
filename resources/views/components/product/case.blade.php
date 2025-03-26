<div class="row">
    <div class="col-12 row">
        <div class="mb-3 col-sm-6">
            <label for="core_type">Loại case</label>
            <input id="core_type" name="case_type" type="text" class="form-control" value="{{$item->case_type ?? ''}}">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="core_series">Chất liệu</label>
            <input id="core_series" name="material" type="text" class="form-control" value="{{$item->material ?? ''}}">
        </div>
    </div>

    <div class="col-sm-12 row">
        <div class="mb-3 col-sm-6">
            <label for="socket">Mainboard size</label>
            <input id="socket" name="mainboad_size" type="text" class="form-control" value="{{ $item->mainboad_size ?? ''}}">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="socket">Màu sắc</label>
            <input id="socket" name="color" type="text" class="form-control" value="{{ $item->color ?? ''}}">
        </div>
    </div>
</div>

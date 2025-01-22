<div class="row">
    <div class="col-12 row">
        <div class="mb-3 col-sm-6">
            <label for="core_type">Core Type</label>
            <input id="core_type" name="core_type" type="text" class="form-control" value="{{$item->core_type ?? ''}}">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="core_series">Core Series</label>
            <input id="core_series" name="core_series" type="text" class="form-control" value="{{$item->core_series ?? ''}}">
        </div>
    </div>

    <div class="col-sm-12 row">
        <div class="mb-3 col-sm-6">
            <label for="socket">Socket</label>
            <input id="socket" name="socket" type="text" class="form-control" value="{{ $item->socket ?? ''}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="ram_type">Loại RAM</label>
            <input id="ram_type" name="ram_type" type="text" class="form-control" value="{{$item->ram_type ?? ""}}"
            >
        </div>
        <div class="mb-3">
            <label for="memory_type">Loại Bộ Nhớ</label>
            <input id="memory_type" name="memory_type" type="text" class="form-control" value="{{$item->memory_type ?? ""}}"
            >
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label for="memory_size">Kích Thước Bộ Nhớ</label>
            <input class="form-control" id="memory_size" name="memory_size" rows="5" value="{{$item->memory_size ?? ""}}">
        </div>
        <div class="mb-3">
            <label for="bus">BUS RAM</label>
            <input class="form-control" id="bus" name="bus" rows="5" value="{{$item->bus ?? ""}}">
        </div>
    </div>
</div>

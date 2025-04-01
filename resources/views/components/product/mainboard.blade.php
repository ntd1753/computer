<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="socket">Socket</label>
            <input id="socket" name="socket" type="text" class="form-control" value="{{ old('socket', $mainBoard->socket ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="chipset">Chipset</label>
            <input id="chipset" name="chipset" type="text" class="form-control" value="{{ old('chipset', $mainBoard->chipset ?? '') }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label for="ramslot">RAM Slot</label>
            <input id="ramslot" name="ram_slot" type="text" class="form-control" value="{{ old('ramslot', $mainBoard->ramslot ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="size">Size</label>
            <input id="size" name="size" type="text" class="form-control" value="{{ old('size', $mainBoard->size ?? '') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="storage_type">Storage Type</label>
            <select id="storage_type" name="storage_type" class="form-control">
                <option value="SSD" {{ old('storage_type', $storage->storage_type ?? '') == 'SSD' ? 'selected' : '' }}>SSD</option>
                <option value="HDD" {{ old('storage_type', $storage->storage_type ?? '') == 'HDD' ? 'selected' : '' }}>HDD</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="size">Size</label>
            <input id="size" name="size" type="text" class="form-control" value="{{ old('size', $storage->size ?? '') }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label for="SSD_type">SSD Type</label>
            <input id="SSD_type" name="SSD_type" type="text" class="form-control" value="{{ old('SSD_type', $storage->SSD_type ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="HDD_SPEED">HDD Speed</label>
            <input id="HDD_SPEED" name="HDD_SPEED" type="text" class="form-control" value="{{ old('HDD_SPEED', $storage->HDD_SPEED ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="HDD_CACHE">HDD Cache</label>
            <input id="HDD_CACHE" name="HDD_CACHE" type="text" class="form-control" value="{{ old('HDD_CACHE', $storage->HDD_CACHE ?? '') }}">
        </div>
    </div>
</div>

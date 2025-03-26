<div class="row">
    <div class="col-sm-12 row">
        <div class="mb-3 col-sm-6">
            <label for="type">Fan Type</label>
            <select id="type" name="fan_type" class="form-control">
                <option value="AirFan" {{ old('fan_type', $fan->type ?? '') == 'AirFan' ? 'selected' : '' }}>AirFan</option>
                <option value="AIOFan" {{ old('fan_type', $fan->type ?? '') == 'AIOFan' ? 'selected' : '' }}>AIOFan</option>
                <option value="CaseFan" {{ old('fan_type', $fan->type ?? '') == 'CaseFan' ? 'selected' : '' }}>CaseFan</option>
            </select>
        </div>
        <div class="mb-3 col-sm-6">
            <label for="CPU_socket">CPU Socket</label>
            <input id="CPU_socket" name="CPU_socket" type="text" class="form-control" value="{{ old('CPU_socket', $fan->CPU_socket ?? '') }}">
        </div>
    </div>

    <div class="col-sm-12 row">
        <div class="mb-3 col-sm-6">
            <label for="height">Height</label>
            <input id="height" name="height" type="text" class="form-control" value="{{ old('height', $fan->height ?? '') }}">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="fan_size">Fan Size</label>
            <input id="fan_size" name="fan_size" type="text" class="form-control" value="{{ old('fan_size', $fan->fan_size ?? '') }}">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="led_type">LED Type</label>
            <input id="led_type" name="led_type" type="text" class="form-control" value="{{ old('led_type', $fan->led_type ?? '') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="power_output">Power Output</label>
            <input id="power_output" name="power_output" type="text" class="form-control" value="{{ old('power_output', $psu->power_output ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="power_standard">Power Standard</label>
            <input id="power_standard" name="power_standard" type="text" class="form-control" value="{{ old('power_standard', $psu->power_standard ?? '') }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label for="connector_type">Connector Type</label>
            <input id="connector_type" name="connector_type" type="text" class="form-control" value="{{ old('connector_type', $psu->connector_type ?? '') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="vga_series">VGA Series</label>
            <input id="vga_series" name="vga_series" type="text" class="form-control" value="{{ old('vga_series', $vga->vga_series ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="memory_type">Memory Type</label>
            <input id="memory_type" name="memory_type" type="text" class="form-control" value="{{ old('memory_type', $vga->memory_type ?? '') }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="mb-3">
            <label for="memory_size">Memory Size</label>
            <input id="memory_size" name="memory_size" type="text" class="form-control" value="{{ old('memory_size', $vga->memory_size ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="inteface">Interface</label>
            <input id="inteface" name="inteface" type="text" class="form-control" value="{{ old('inteface', $vga->inteface ?? '') }}">
        </div>
    </div>
</div>

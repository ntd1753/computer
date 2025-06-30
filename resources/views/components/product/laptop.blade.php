<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="cpu">CPU</label>
        <input id="cpu" name="cpu" type="text" class="form-control" placeholder="Nhập thông tin CPU" value="{{$item->cpu ?? ""}}">
    </div>
    <div class="mb-3 col-sm-6">
        <label for="ram">RAM</label>
        <input id="ram" name="ram" type="text" class="form-control" placeholder="VD: 8GB, 16GB" value="{{$item->ram ?? ""}}">
    </div>
</div>

<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="ram_memory">Loại RAM (Memory)</label>
        <input id="ram_memory" name="ram_memory" type="text" class="form-control" value="{{$item->ram_memory ?? ""}}" placeholder="VD: DDR4, DDR5">
    </div>
    <div class="mb-3 col-sm-6">
        <label for="screen_size">Kích thước màn hình</label>
        <input id="screen_size" name="screen_size" type="text" class="form-control" placeholder="Kích thước : 14, 15, 15.6" value="{{$item->screen_size ?? ""}}">
    </div>

</div>

<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="battery_life">Thời lượng pin</label>
        <input id="battery_life" name="battery_life" type="text" class="form-control" placeholder="" value="{{$item->battery_life ?? ""}}">
    </div>
    <div class="mb-3 col-sm-6">
        <label for="vga">Card đồ họa (VGA)</label>
        <input id="vga" name="vga" type="text" class="form-control" placeholder="VD: GTX 1660, RTX 3060"  value="{{$item->vga ?? ""}}">
    </div>
</div>

<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="hdd_size">Dung lượng HDD</label>
        <input id="hdd_size" name="hdd_size" type="text" class="form-control" placeholder="VD: 1TB, 500GB" value="{{$item->hdd_size ?? ""}}">
    </div>
    <div class="mb-3 col-sm-6">
        <label for="ssd_size">Dung lượng SSD</label>
        <input id="ssd_size" name="ssd_size" type="text" class="form-control" placeholder="VD: 256GB, 512GB" value="{{$item->ssd_size ?? ""}}">

    </div>
</div>


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
        <label for="mainboard">Mainboard</label>
        <input id="mainboard" name="mainboard" type="text" class="form-control" placeholder="Tên hoặc model Mainboard" value="{{$item->mainboard ?? ""}}">
    </div>
</div>

<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="power_supply">Nguồn (Power Supply)</label>
        <input id="power_supply" name="power_supply" type="text" class="form-control" placeholder="VD: 550W, 650W" value="{{$item->power_supply ?? ""}}">
    </div>
    <div class="mb-3 col-sm-6">
        <label for="cpu_fan">Quạt CPU</label>
        <input id="cpu_fan" name="cpu_fan" type="text" class="form-control" placeholder="Tên quạt hoặc model" value="{{$item->cpu_fan ?? ""}}">
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

<div class="col-12 row">
    <div class="mb-3 col-sm-6">
        <label for="vga">Card đồ họa (VGA)</label>
        <input id="vga" name="vga" type="text" class="form-control" placeholder="VD: GTX 1660, RTX 3060"  value="{{$item->vga ?? ""}}">
    </div>
</div>

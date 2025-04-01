<div class="card">
    <div class="card-body">
        <h4 class="card-title">Linh kiện</h4>
        <div class="row">
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">CPU</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn CPU</option>
                        @foreach($cpus as $cpu)
                            <option value="{{$cpu->id}}">{{$cpu->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="name">MainBoard</label>
                    <select class="form-control select2">
                        <option value="null">Chọn MainBoard</option>
                        @foreach($mainboards as $mainboard)
                            <option value="{{$mainboard->id}}">{{$mainboard->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">RAM</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn Ram</option>
                        @foreach($rams as $ram)
                            <option value="{{$ram->id}}">{{$ram->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="name">Nguồn</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn nguồn</option>
                        @foreach($psus as $psu)
                            <option value="{{$psu->id}}">{{$psu->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">vỏ Case</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn vỏ Case</option>
                        @foreach($cases as $case)
                            <option value="{{$case->id}}">{{$case->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="name">SSD</label>
                    <select class="form-control select2">
                        <option value="null">Chọn SSD</option>
                        @foreach($SSDs as $SSD)
                            <option value="{{$SSD->product_id}}">{{$SSD->product_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">VGA</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn VGA</option>
                        @foreach($vgas as $vga)
                            <option value="{{$vga->id}}">{{$vga->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="name">airFan CPU</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn airFans</option>
                        @foreach($airFans as $airFan)
                            <option value="{{$airFan->product_id}}">{{$airFan->product_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">Tản AIO</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn tản AIO</option>
                        @foreach($AIOFans as $AIOFan)
                            <option value="{{$AIOFan->product_id}}">{{$AIOFan->product_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="name"> Chọn quạt tản nhiệt</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn quạt tản nhiệt</option>
                        @foreach($caseFans as $caseFan)
                            <option value="{{$caseFan->product_id}}">{{$caseFan->product_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 row">
                <div class="mb-3 col-sm-6">
                    <label for="name">HDD</label>
                    <select class="form-control select2 ">
                        <option value="null">Chọn HDD</option>
                        @foreach($HDDs as $HDD)
                            <option value="{{$HDD->product_id}}">{{$HDD->product_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
</div>

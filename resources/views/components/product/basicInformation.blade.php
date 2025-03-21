<div class="row">
    <div class="col-12 row">
        <div class="mb-3 col-sm-6">
            <label for="name">Tên Sản Phẩm</label>
            <input id="name" name="name" type="text" class="form-control">
        </div>
        <div class="mb-3 col-sm-6">
            <label for="slug">Loại Sản Phẩm</label>
            <input id="slug" type="text"
                   class="form-control" value="{{strtoupper($accessoryType)}}"
                   disabled>
            <input type="hidden" name="product_type"
                   class="form-control" value="{{strtoupper($accessoryType)}}">
        </div>
    </div>
    <div class="col-12 row">
        <div class="mb-3 col-6">
            <label class="control-label">Danh Mục</label>
            <select class="form-control" name="category_id">
                <option>Chọn Danh Mục</option>
                @include('content.accessory.category_option', ["categories" =>$categories, 'level' => 0])
            </select>
        </div>
        <div class="mb-3 col-6">
    <label class="control-label">Nhãn Hàng</label>

    <select class="form-control" name="brand_id"
    >
        <option>Chọn Nhãn Hàng</option>
        @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
    </select>
</div>
    </div>
    <div class="col-12 row">
        <div class="mb-3 col-sm-6">
            <label for="cost">Giá nhập</label>
            <input id="cost" name="cost" type="text"
                   class="form-control">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="price">Giá Bán</label>
            <input id="price" name="price" type="text" class="form-control"
                   placeholder="Price">
        </div>

    </div>
    <div class="col-12 row">
        <div class="mb-3  col-sm-6">
            <label for="discount-type">Loại Giảm giá</label>
            <select id="discount-type" class="form-control" disabled name="discount_type"
            >
                <option>Chọn Loại Giảm giá</option>
                <option value="1">Giảm Phần Trăm</option>
                <option value="0">Giảm Giá Trực Tiếp</option>
            </select>
        </div>
        <div class="mb-3  col-sm-6 row">
            <div class="col-10">
                <label for="discount-value">Giảm Giá</label>
                <input id="discount-value" name="discount_value" type="text" class="form-control" disabled
                >
            </div>

            <div class="col-2 d-flex align-items-end">
                <div class="form-check form-switch form-switch-lg mb-2" dir="ltr">
                    <input class="form-check-input" type="checkbox" id="discount-checkbox">
                    <label class="form-check-label" for="discount-checkbox"></label>
                </div></div>
        </div>

    </div>
</div>

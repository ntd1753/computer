@foreach($accessories as $item)

    <tr>
        <td>
            {{$item->product->id}}
        </td>
        <td>
            <h5 class="w-30 font-size-14 text-start px-3"><a href="#"
                                                      class="text-dark">{{$item->product->name ?? ""}}</a></h5>
        </td>
        <td>
            <div class="text-truncate font-size-14 text-start px-3">{{$item->product->category->name ?? ""}}</div>
        </td>
        <td>
            <h5 class="text-truncate font-size-14"><a href="#"
                                                      class="text-dark">{{$item->product->brand->name}}</a></h5>
        </td>
        <td>
            @php
                $images = json_decode($item->product->images, true);
            @endphp
            <div class="d-flex justify-content-center">
            @if (!empty($images) && is_array($images))
                @foreach (array_slice($images, 0, 3) as $image)
                     <img src="{{$image ?? "https://www.studytienganh.vn/upload/2021/05/98140.png"}}" alt="" class="avatar-sm">
                @endforeach
                @else
                    <img src="{{$image ?? "https://www.studytienganh.vn/upload/2021/05/98140.png"}}" alt="" class="avatar-sm">
            @endif
            </div>

        </td>
        <td>{{number_format($item->product->cost ?? "")}} VNĐ</td>
        <td>@if ($item->product->discount_type)
                @if($item->product->discount_type == \App\Models\Product::DISCOUNT_PERCENT)
                    {{number_format((1-$item->product->discount_value/100)*$item->product->price)}} VNĐ
                @else
                    {{number_format($item->product->price-$item->product->discount_value)}} VNĐ

                @endif
            @else
                {{number_format($item->product->price ?? "")}} VNĐ
           @endif
        </td>

        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#post-product-modal-{{$item->product->id}}"><i class="bx bx-food-menu fs-3 fw-medium text-primary"></i></a></div>
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#data-sheet-product-modal-{{$item->product->id}}"><i class="bx bx-spreadsheet fs-3 fw-medium text-primary"></i></a></div>
                <div><a href="{{route("accessory.edit",["id"=>$item->id,"accessory_type"=>$accessoryType])}}"><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$item->product->id}}"><i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i></a></div>
            </div>

        </td>
    </tr>
    @include("components.modal.deleteConfirmModal",["routerName"=>"accessory.destroy",'item'=>$item->product, 'name'=>'sản phẩm', "accessory_type"=>$accessoryType])

@endforeach

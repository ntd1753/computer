@foreach($orderItems as $item)
    <tr>
        <td class="!py-4">
            <div class="d-flex align-items-center">
                <div class="">
                    @php
                        $image = json_decode($item->product->images)[0] ?? null;
                    @endphp
                    <img alt="{{ $image }}"
                         class="rounded-lg" style="width: 80px; "
                         src="{{$image}}"
                         title="{{$item->product->name}}">
                </div>
                <a href="#" class="font-medium whitespace-nowrap ms-4">{{$item->product->name}}</a>
            </div>
        </td>
        <td class="text-right">{{number_format($item->price,0,',','.')}}VNĐ</td>
        <td class="text-right">{{$item->quantity}}</td>
        <td class="text-right">{{number_format($item->price*$item->quantity,0,',','.')}}VNĐ</td>
    </tr>
@endforeach

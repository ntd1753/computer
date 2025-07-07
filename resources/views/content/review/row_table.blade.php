@foreach($listItem as $item)

    <tr>
        <td>
            {{$item->id}}
        </td>
        <td>
            <h5 class="w-30 font-size-14 text-start px-3"><a href="#" class="text-dark">{{$item->user->name ?? ""}}</a></h5>
        </td>
        <td>
            <div class="text-truncate font-size-14 text-start px-3">{{$item->product->name ?? ""}}</div>
        </td>
        <td>
            <div class="text-truncate font-size-14 text-start px-3">{{$item->rating . ' sao' ?? ""}}</div>
        </td>
        <td>
            <div class="text-truncate font-size-14 text-start px-3">{{$item->review_content ?? ""}}</div>
        </td>
        <td >
            <span style="border-radius: 5px;" class="text-white px-1 text-base  {{\App\Models\Review::$statusColors[$item->status]}} ">{{\App\Models\Review::$listStatus[$item->status]}}</span>
        </td>
        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
               <div><a href="{{route('review.edit',["id"=>$item->id])}}"><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
            </div>

        </td>
    </tr>
@endforeach

@foreach($listItem as $item)

    <tr>
        <td>
            {{$item->id}}
        </td>
        <td>
            <h5 class="w-30 font-size-14 text-start px-3"><a href="#" class="text-dark">{{$item->key ?? ""}}</a></h5>
        </td>
        <td>
            <div class="text-truncate font-size-14 text-start px-3"> @foreach(json_decode($item->value) as $value)
                    <span>{{ $value }}</span><br>
                @endforeach</div>
        </td>

        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
               <div><a href="{{route('filters.edit',["id"=>$item->id])}}"><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
            </div>

        </td>
    </tr>
@endforeach

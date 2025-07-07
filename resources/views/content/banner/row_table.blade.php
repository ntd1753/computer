@foreach($banners  as $item)

    <tr>
        <td>{{$item->id}}</td>
        <td><img src="{{$item->image}}" class="mx-auto" style="max-width: 200px; "></td>
        <td class="text-[##136ebf]"><a href="{{$item->link}}" class="text-base">link</a></td>
        <td><div  class="font-bold text-white @if($item->status ==1)badge bg-success @else badge bg-danger @endif" style="background: #1dbb02;">
                @if($item->status ==1)
                    Hiển thị
                @else
                    Không hiển thị
                @endif
            </div>
        </td>
        <td>{{$item->position}}</td>
        <td>
            <div class="d-flex justify-content-center">
{{--                <a href="{{route('banner.edit', $item->id)}}" >--}}
{{--                    <i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i>--}}
{{--                </a>--}}
                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$item->id}}">
                    <i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i>
                </a>
            </div>
        </td>
    </tr>

    @include('components.modal.deleteConfirmModal',['item'=>$item, "name" => "banner", "routerName" => "banner.destroy"])
@endforeach

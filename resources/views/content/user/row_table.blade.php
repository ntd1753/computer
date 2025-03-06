@foreach($admins as $item)

    <tr>
        <td>
            {{$item->id}}
        </td>
        <td>
            <h5 class=" font-size-14 text-start px-3 w-40"><a href="#"
                                                      class="text-dark">{{$item->name ?? ""}}</a></h5>
        </td>
        <td class="w-40">
            <div class="font-size-14 text-dark">{!! $item->role->name !!}</div>
        </td>
        <td class="w-40">
            <div class="font-size-14 text-dark">{!! $item->email !!}</div>
        </td>
        <td><img src="{{$item->avatar ?? "https://www.studytienganh.vn/upload/2021/05/98140.png"}}" alt="" class="avatar-sm"></td>
        <td>
            <div class="font-size-14">
                @if($item->status == 1)
                    <span class="badge bg-soft-success text-success">Active</span>
                    @else
                    <span class="badge bg-soft-danger text-danger">Inactive</span>
                @endif
            </div>
        </td>
        <td>
            <div class="d-flex justify-content-center">
                <a href="{{route('user.edit', $item->id)}}" >
                    <i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i>
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$item->id}}">
                    <i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i>
                </a>
            </div>
        </td>
    </tr>
    @include('components.modal.PostModal',['item'=>$item])
    @include('components.modal.deleteConfirmModal',['item'=>$item, "name" => "post", "routerName" => "post.destroy"])
@endforeach

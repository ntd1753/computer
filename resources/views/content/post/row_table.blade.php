@foreach($posts as $item)

    <tr>
        <td>
            {{$item->id}}
        </td>
        <td>
            <h5 class="text-truncate font-size-14 text-start px-3"><a href="#"
                                                      class="text-dark">{{$item->title ?? ""}}</a></h5>
        </td>
        <td>
            <div class="font-size-14" ><p style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                                      class="text-dark">{!! $item->description !!}</p></div>
        </td>
        <td><img src="{{$item->images ?? "https://www.studytienganh.vn/upload/2021/05/98140.png"}}" alt="" class="avatar-sm"></td>


        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#post-product-modal-{{$item->id}}"><i class="bx bx-food-menu fs-3 fw-medium text-primary"></i></a></div>
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#data-sheet-product-modal-{{$item->id}}"><i class="bx bx-spreadsheet fs-3 fw-medium text-primary"></i></a></div>
                <div><a href="{{route("post.edit",["id"=>$item->id])}}"><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$item->id}}"><i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i></a></div>
            </div>
        </td>
    </tr>
    @include('components.modal.PostModal',['item'=>$item])
    @include('components.modal.deleteConfirmModal',['item'=>$item, "name" => "post", "routerName" => "post.destroy"])
@endforeach

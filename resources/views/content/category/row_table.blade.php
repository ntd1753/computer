@foreach($categories as $item)

    <tr>
        <td>
            <h5 class="text-truncate font-size-14"><a href="#"
                                                      class="text-dark">{{$item->id}}</a></h5>
        <td>
            <h5 class="text-truncate font-size-14 text-start px-3"><a href="#"
                                                      class="text-dark">{{str_repeat("----", $level)}} {{$item->name}}</a></h5>
        </td>
        <td>
            <h5 class="text-truncate font-size-14"><a href="#"
                                                      class="text-dark">{{$item->slug}}</a></h5>
        </td>
        <td><img src="{{$item->icon ?? "https://www.studytienganh.vn/upload/2021/05/98140.png"}}" alt="" class="avatar-sm"></td>

        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
                <div><a href="{{route("category.edit",["id"=>$item->id])}}"><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
                <div><a href="#" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$item->id}}"><i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i></a></div>
            </div>

        </td>
    </tr>
    @include("components.modal.deleteConfirmModal",["routerName"=>"category.destroy",'item'=>$item, 'name'=>'danh mục'])
    @if($item->subCategories)
        @include('content.category.row_table', ["categories"=>$item->subCategories, "level"=>$level+1])
    @endif
@endforeach

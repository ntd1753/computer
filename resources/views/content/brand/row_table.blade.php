@foreach($brands as $brand)
    <tr>
        <td>{{$brand->id}}</td>
        <td><img src="{{ URL::asset($brand->logo) ?? " "}}" alt="" class="avatar-sm"></td>
        <td>
            <h5 class="text-truncate font-size-14"><a href="#"
                                                      class="text-dark">{{$brand->name}}</a></h5>
        </td>
        <td >
            <div class="d-flex align-items-center justify-content-center w-100 text-center">
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('EditABrand'), \App\Models\CustomPermission::getValidPermissions()))
                <div><a href="{{route("brand.edit",["id"=>$brand->id])}}" ><i class="bx bx-edit-alt text-warning fs-3 fw-medium"></i></a></div>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('DeleteABrand'), \App\Models\CustomPermission::getValidPermissions()))
                    <div><a href="#" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal-{{$brand->id}}"><i class="bx bx-trash-alt text-danger fs-3 fw-medium"></i></a></div>
                    @endif
            </div>

        </td>
    </tr>
    @include("components.modal.deleteConfirmModal",["routerName"=>"brand.destroy",'item'=>$brand, 'name'=>'nhãn hàng'])
@endforeach

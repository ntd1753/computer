@extends('layouts.master')

@section('title')
    @lang('translation.Projects_List')
@endsection
@section('css')
    <style>
        ul li {
            list-style-type: none;
            /* Loại bỏ dấu chấm đầu dòng */
            padding-left: 5px;
            /* Thụt lề cho các mục con */
        }

        .hidden {
            display: none;
        }
    </style>

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quản Lí Vai trò người dùng
        @endslot
        @slot('title')
            Danh sách Vai trò người dùng
        @endslot
    @endcomponent
    <div class="card p-3">
        {!! Form::open(['name' => 'frm_search', 'class' => 'frm_search', 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-0">
                            <label for="search" class="form-label">Tên vai trò</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" id="search" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="w-100 d-flex justify-content-center mt-4">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i> <span>Tìm kiếm</span></button>
                    </div>
                </div>
        {!! Form::close() !!}


    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            @if(in_array(\App\Models\CustomPermission::getPermissionByKey('AddARole'), \App\Models\CustomPermission::getValidPermissions()))
                <button type="button"
                        data-bs-toggle="modal" data-bs-target="#createModal" id="addNewButton"
                        class="btn btn-primary waves-effect waves-light my-3"><i class="bx bx-plus"></i>Thêm Vai trò</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table align-middle table-borderless brand-table text-center w-100 result_table">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center px-3">ID</th>
                            <th scope="col" class="text-center px-3">Code</th>
                            <th scope="col" class="px-3">Tên</th>
                            <th scope="col" style="width: 100px">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLongTitle">{{__('label.add_new_role')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {!! Form::open(['url' => route('role.store'), 'method' => 'post', 'name' => 'createForm']) !!}
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>{{__('label.code')}}<br> <span class="text-danger">{{__('label.required')}}</span></label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::text('code', '', ['class' => 'form-control', 'required' => 'required','oninput' => 'this.value = this.value.replace(/\s+/g, "");']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>{{__('label.role_name')}}<br> <span class="text-danger">{{__('label.required')}}</span></label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::text('name', '',
                                    ['class' => 'form-control',
                                     'required' => 'required',
                                       ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <label>
                                {!! Form::checkbox('is_active', 1, false, ['class' => 'form-check-input']) !!}
                                {{__('label.active')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary createBtn">{{__('label.create')}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('label.cancel')}}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLongTitle">{{__('label.edit_new_role')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {!! Form::open(['url' => route('role.update'), 'method' => 'post', 'name' => 'editForm']) !!}
                {{ csrf_field() }}
                <div class="modal-body">
                    {!! Form::hidden('id', '', ['id' => 'hiddenId']) !!}
                    <div class="row">
                        <div class="col">
                            <label>{{__('label.code')}}<br> <span class="text-danger">{{__('label.required')}}</span></label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::text('code', '',
                                                    ['class' => 'form-control',
                                                     'id' => 'code', 'required' => 'required',
                                                       in_array(\App\Models\CustomPermission::getPermissionByKey('EditARole'),
                                                        \App\Models\CustomPermission::getValidPermissions()) ?  '' : 'disabled'
                                                     ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>{{__('label.role_name')}}<br> <span class="text-danger">{{__('label.required')}}</span></label>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::text('name', '',
                                                ['class' => 'form-control',
                                                'id' => 'name',
                                                'required' => 'required',
                                                in_array(\App\Models\CustomPermission::getPermissionByKey('EditARole'),
                                                        \App\Models\CustomPermission::getValidPermissions()) ?  '' : 'disabled'
                                                        ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <label>
                                {!! Form::checkbox('is_active', 1, false,
                                ['class' => 'form-check-input',
                                'id' => 'isActive',
                                in_array(\App\Models\CustomPermission::getPermissionByKey('EditARole'),
                                                        \App\Models\CustomPermission::getValidPermissions()) ?  '' : 'disabled'
                                                        ]) !!}
                                {{__('label.active')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if(in_array(\App\Models\CustomPermission::getPermissionByKey('EditARole'),\App\Models\CustomPermission::getValidPermissions()))
                        <button type="button" class="btn btn-primary updateBtn">{{__('label.update')}}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('label.cancel')}}</button>
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Permission Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalLongTitle">{{__('label.assign_permission')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {!! Form::open(['url' => route('role.assign_permissions'), 'method' => 'post', 'name' => 'permissionForm']) !!}
                {!! Form::hidden('id', '', ['id' => 'hiddenId']) !!}
                <div class="modal-body" id="myModalContent">
                </div>
                <div class="modal-footer">
                    @if(in_array(\App\Models\CustomPermission::getPermissionByKey('EditARole'),\App\Models\CustomPermission::getValidPermissions()))
                        <button type="button" class="btn btn-primary assignBtn">{{__('label.update')}}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('label.cancel')}}</button>
                    @endif

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {

            function resetModal() {
                var form = document.querySelector('form[name="createForm"]');
                form.reset();
                $('.error.invalid-feedback').remove();
                $('input').removeClass('is-invalid');
            }

            $('#addNewButton').click(function() {
                resetModal();
            });

            $('.createBtn').click(function (e) {
                var formData = $('form[name="createForm"]').serialize();
                var formUrl = document.forms['createForm'].action;

                $.ajax({
                    url: formUrl,
                    method: 'POST',
                    data: formData,
                    beforeSend: function () {
                        showPreload();
                    },
                    complete: function () {
                        hidePreload();
                    },
                    success: function (res) {
                        if (res.success) {
                            $('.frm_search').submit();
                            showSuccessMessage(res.message);
                            $('#createModal').modal('hide');
                            resetModal();
                        } else {
                            showErrorMessage(res.messenge);
                        }
                    },
                    error: function (xhr) {
                        showErrorValidate(xhr);
                    }
                });
            });

            $('.assignBtn').click(function (e) {
                var formData = $('form[name="permissionForm"]').serialize();
                var formUrl = document.forms['permissionForm'].action;

                $.ajax({
                    url: formUrl,
                    method: 'POST',
                    data: formData,
                    beforeSend: function () {
                        showPreload();
                    },
                    complete: function () {
                        hidePreload();
                    },
                    success: function (res) {
                        if (res.success) {
                            $('.frm_search').submit();
                            showSuccessMessage(res.message);
                            $('#permissionModal').modal('hide');
                        } else {
                            showErrorMessage(res.messenge);
                            $('#permissionModal').modal('hide');
                        }
                    },
                    error: function (xhr) {
                        showErrorMessage(xhr);
                        $('#permissionModal').modal('hide');
                    }
                });
            });

            $('.updateBtn').click(function (e) {
                var formData = $('form[name="editForm"]').serialize();
                var formUrl = document.forms['editForm'].action;

                $.ajax({
                    url: formUrl,
                    method: 'POST',
                    data: formData,
                    beforeSend: function () {
                        showPreload();
                    },
                    complete: function () {
                        hidePreload();
                    },
                    success: function (res) {
                        if (res.success) {
                            $('.frm_search').submit();
                            showSuccessMessage(res.message);
                            $('#editModal').modal('hide');
                        } else {
                            showErrorMessage(res.message);
                        }
                    },
                    error: function (xhr) {
                        showErrorValidate(xhr);
                    }
                });
            });

            let columns = [
                { data: 'DT_RowIndex', sortable: false },
                { data: 'code', sortable: true },
                { data: 'name', sortable: true },
                { data: 'is_active', sortable: true },
                { data: 'action', sortable: false },
            ];

            let table = $('.result_table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                ajax: {
                    url: '{{ route('role.search') }}',
                    type: 'get',
                    data: function (d) {
                        d.form = $('.frm_search').serializeArray();
                    }
                },
                columns: columns,
                order: [],
                columnDefs: []
            });

            $('.frm_search').submit(function (e) {
                e.preventDefault();
                table.draw();
            });


            $('.form-control').change(function () {
                $('.frm_search').submit();
            });


            table.on('draw', function () {
                $('.edit-button').click(function () {
                    resetModal();
                    var roleId = $(this).data('id');
                    var code = $(this).data('code');
                    var name = $(this).data('name');
                    var isActive = $(this).data('is_active');

                    $('#editModal #code').val(code);
                    $('#editModal #name').val(name);
                    $('#editModal #hiddenId').val(roleId);

                    if (isActive) {
                        $('#editModal #isActive').prop('checked', true);  // Check the checkbox
                    } else {
                        $('#editModal #isActive').prop('checked', false); // Uncheck the checkbox
                    }
                });

                //assign permissions
                $('.permission-button').click(function () {

                    var id = $(this).data('id');
                    $('#permissionModal #hiddenId').val(id);
                    var url = "{{ route('role.permissions') }}";
                    const modalContent = document.getElementById('myModalContent');
                    modalContent.innerHTML = '';
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            if (response.length === 0) {
                                html = `<p class="text-danger text-center">{{__('label.empty_permission')}}</p>`;
                                modalContent.innerHTML = html;
                            } else {
                                treeHtml = createTreeModalBody(response);
                                modalContent.innerHTML = treeHtml;
                                assignToggleEvent();
                                assignCheckboxEvent();
                            }
                        },
                        error: function (xhr) {
                            showErrorValidate(xhr);
                        }
                    });
                });

                //create tree permission
                function createTreeModalBody(data) {
                    let html = '<ul class="child-list">';
                    data.forEach(item => {
                        const hasChildren = item.children && item.children.length > 0;

                        html += `<li>
                <div class="toggle">
                    ${hasChildren ? '<span class="toggle-icon"><i class="fa fa-caret-right mr-1"></i></span>' : ''}
                    <span>
                        <input type="checkbox" name="permission_lists[]" value="${item.id}" ${item.check_permission ? 'checked' : ''} onclick="event.stopPropagation()" class="parent-checkbox">
                    </span>
                    &nbsp;&nbsp;
                    ${item.name}
                </div>`;

                        if (hasChildren) {
                            // add hidden for ul chidren
                            html += `<ul class="child-list hidden">` + createTreeModalBody(item.children) + `</ul>`;
                        }
                        html += '</li>';
                    });
                    html += '</ul>';
                    return html;
                }

                function assignToggleEvent() {
                    // Remove any existing click event handlers from elements with the class 'toggle'
                    $('.toggle').off('click').on('click', function (event) {
                        // Call the toggleChild function when a toggle element is clicked
                        toggleChild(event);
                    });
                }


                function toggleChild(event) {
                    // Get the parent element and the child list
                    const childList = event.currentTarget.nextElementSibling; // Use nextElementSibling to get the <ul> (child list)
                    if (childList) {
                        // Toggle the 'hidden' class on the child list to show/hide it
                        childList.classList.toggle('hidden');
                        // Update the toggle icon
                        const toggleIcon = event.currentTarget.querySelector('.toggle-icon');
                        if (toggleIcon) {
                            // Change the icon based on whether the child list is hidden or visible
                            toggleIcon.innerHTML = childList.classList.contains('hidden') ? '<i class="fa fa-caret-right mr-1"></i>' : '<i class="fa fa-caret-down mr-1" aria-hidden="true"></i>'; // Down arrow or up arrow
                        }
                    }
                    event.stopPropagation(); // Prevent the event from bubbling up to parent elements
                }

                function assignCheckboxEvent() {
                    // Assign change event to all parent checkboxes
                    $('.parent-checkbox').off('change').on('change', function () {
                        // Call handleCheckboxChange when a checkbox state changes
                        handleCheckboxChange($(this));
                    });
                }

                function handleCheckboxChange($checkbox) {
                    // Find the child list of the current checkbox
                    const $childList = $checkbox.closest('li').find('ul.child-list').first();
                    if ($childList.length) {
                        // Update all child checkboxes based on the state of the parent checkbox
                        const isChecked = $checkbox.is(':checked'); // Get the checked state of the parent checkbox
                        $childList.find('input[type="checkbox"]').each(function () {
                            // Set each child checkbox to the same checked state as the parent checkbox
                            $(this).prop('checked', isChecked);
                        });
                    }
                }

            });

        });


    </script>

@endsection

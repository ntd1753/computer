<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">{{__('label.menu')}}</li>

                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">{{__('label.dashboard')}}</span>
                    </a>
                </li>
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('UserRoleAndPermissionList'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('role.index')}}" key="t-level-1-1">
                            <i class="bx bx-lock-alt"></i>
                            <span key="t-dashboards">Vai trò người dùng </span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('UserManagement'), \App\Models\CustomPermission::getValidPermissions()))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">Quản lí người dùng </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        <li>
                            <a href="{{route('user.index')}}"
                               key="t-level-1-2"><i class="bx bx-user"></i>Nhân viên</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" key="t-level-1-1">
                                <i class="bx bx-user"></i>Khách hàng
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('BrandManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('brand.index')}}" class="waves-effect">
                            <i class="dripicons-bold"></i>
                            <span key="t-dashboards">Quản lí nhãn hàng</span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('CategoryManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="bx bx-menu"></i>
                            <span key="t-multi-level">Quản lí danh mục</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{route('category.index',['model_type'=>\App\Models\Category::TYPE_PRODUCT])}}"
                                   key="t-level-1-2">Quản lí danh mục sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{route('category.index',['model_type'=>\App\Models\Category::TYPE_BLOG])}}" class=" waves-effect"
                                   key="t-level-1-2">Quản lí danh mục blog</a>
                            </li>


                        </ul>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('ProductManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="bx bx-share-alt"></i>
                            <span key="t-multi-level">Quản lí sản phẩm</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="javascript: void(0);" class="has-arrow"
                                   key="t-level-1-2"><i class="bx bxs-save"></i>LINH KIỆN</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_CPU])}}" key="t-level-1-1">CPU</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_RAM])}}" key="t-level-1-1">RAM</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_STORAGE])}}" key="t-level-1-1">STORAGE</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_PSU])}}" key="t-level-1-1">PSU</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_CASE])}}" key="t-level-1-1">CASE</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_MAINBOARD])}}" key="t-level-1-1">MainBoard</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_FAN])}}" key="t-level-1-1">FAN</a></li>
                                    <li><a href="{{route('accessory.index',["accessory_type"=>\App\Models\Accessory::TYPE_VGA])}}" key="t-level-1-1">VGA</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('laptop.index')}}" key="t-level-1-1">
                                    <i class="bx bx-desktop"></i>Laptop
                                </a>
                            </li>
                            <li>
                                <a href="{{route('prebuiltPc.index')}}" key="t-level-1-1">
                                    <i class="bx bx-desktop"></i>PC built sẵn
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('PostManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('post.index')}}" class="waves-effect">
                            <i class="bx bx-book-content"></i>
                            <span key="t-dashboards">Quản lí bài viết</span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('OrderManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('order.index')}}" class="waves-effect">
                            <i class="bx bx-cart-alt"></i>
                            <span key="t-dashboards">Quản lí Đơn hàng</span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('ReviewManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('review.index')}}" class="waves-effect">
                            <i class="bx bx-star"></i>
                            <span key="t-dashboards">Quản lí Đánh giá sản phẩm</span>
                        </a>
                    </li>
                @endif

            @if(in_array(\App\Models\CustomPermission::getPermissionByKey('BannerManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('banner.index')}}" class="waves-effect">
                            <i class="bx bx-image-add"></i>
                            <span key="t-dashboards">Quản lí banner</span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('Setting'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('config.edit')}}" class="waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-dashboards">Cấu hình website</span>
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Models\CustomPermission::getPermissionByKey('FilterManagement'), \App\Models\CustomPermission::getValidPermissions()))
                    <li>
                        <a href="{{route('filters.index')}}" class="waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-dashboards">Quản lí bộ lọc</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

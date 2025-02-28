<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">Quản lí người dùng </span>

                    </a>
                </li>
                <li>
                    <a href="{{route('brand.index')}}" class="waves-effect">
                        <i class="dripicons-bold"></i>
                        <span key="t-dashboards">Quản lí nhãn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('category.index')}}" class="waves-effect">
                        <i class="bx bx-menu"></i>
                        <span key="t-dashboards">Quản lí danh mục</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                               key="t-level-1-2"><i class="bx bxs-save"></i>Nhân viên</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" key="t-level-1-1">
                                <i class="bx bx-desktop"></i>Khách hàng
                            </a>
                        </li>

                    </ul>
                </li>
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
                            <a href="javascript: void(0);" key="t-level-1-1">
                                <i class="bx bx-desktop"></i>PC
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('post.index')}}" class="waves-effect">
                        <i class="bx bx-book-content
"></i>
                        <span key="t-dashboards">Quản lí bài viết</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

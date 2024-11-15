<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="waves-effect @if (Route::is('admin.dashboard')) active @endif">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.chat') }}"
                        class="waves-effect @if (Route::is('admin.chat')) active @endif">
                        <i class="bx bx-chat"></i>
                        <span>Chat</span>
                    </a>
                </li>

                @can('browse-category')
                    <li>
                        <a href="{{ route('admin.category.index') }}"
                            class="waves-effect @if (Route::is('admin.category.index')) active @endif">
                            <i class="bx bx-box"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                @endcan

                @can('browse-user')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user"></i>
                            <span>Users</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('browse-user')
                                <li class="@if (Route::is('admin.user.index')) mm-active @endif"><a
                                        href="{{ route('admin.user.index') }}"
                                        class="@if (Route::is('admin.user.index')) active @endif">User List</a></li>
                            @endcan
                            @can('add-user')
                                <li class="@if (Route::is('admin.user.create')) mm-active @endif"><a
                                        href="{{ route('admin.user.create') }}"
                                        class="@if (Route::is('admin.user.create')) active @endif">Add New User</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('browse-module')
                    <li>
                        <a href="{{ route('admin.module.index') }}"
                            class="waves-effect @if (Route::is('admin.module.index')) active @endif">
                            <i class="bx bx-cube"></i>
                            <span>Modules</span>
                        </a>
                    </li>
                @endcan

                @can('browse-permission')
                    <li>
                        <a href="{{ route('admin.permission.index') }}"
                            class="waves-effect @if (Route::is('admin.permission.index')) active @endif">
                            <i class="bx bx-shield-quarter"></i>
                            <span>Permissions</span>
                        </a>
                    </li>
                @endcan

                @can('browse-role')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-group"></i>
                            <span>Roles</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('browse-role')
                                <li class="@if (Route::is('admin.role.index')) mm-active @endif"><a
                                        href="{{ route('admin.role.index') }}"
                                        class="@if (Route::is('admin.role.index')) active @endif">Role List</a></li>
                            @endcan
                            @can('add-role')
                                <li class="@if (Route::is('admin.role.create')) mm-active @endif"><a
                                        href="{{ route('admin.role.create') }}"
                                        class="@if (Route::is('admin.role.create')) active @endif">Add New Role</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if (Auth::user()->haspermission('general-setting') || Auth::user()->haspermission('email-configuration'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('general-setting')
                                <li class="@if (Route::is('admin.general_setting_page')) mm-active @endif"><a
                                        href="{{ route('admin.general_setting_page', ['stage' => 'site']) }}"
                                        class="@if (Route::is('admin.general_setting_page')) active @endif">General Setting</a></li>
                            @endcan
                            @can('email-configuration')
                                <li class="@if (Route::is('admin.email_configuration_page')) mm-active @endif"><a
                                        href="{{ route('admin.email_configuration_page') }}"
                                        class="@if (Route::is('admin.email_configuration_page')) active @endif">Email Configuration</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @can('browse-database-backup')
                    <li>
                        <a href="{{ route('admin.backup.index') }}"
                            class="waves-effect  @if (Route::is('admin.backup.index')) active @endif">
                            <i class="bx bx-data"></i>
                            <span>Database Backup</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</div>

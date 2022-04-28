<div class="app-sidebar">
    <div class="logo">
        <a href="{{route('dashboard')}}" class="logo-icon"><span
                class="logo-text" style="visibility: visible;opacity: 1;">{{config('app.name')}}</span></a>
        <div class="sidebar-user-switcher user-activity-online">
        </div>
    </div>

    <div class="app-menu">
        <ul class="accordion-menu">

            @can('dashboard')
                <li class="@if(Route::is('dashboard'))active-page @endif">
                    <a href="{{route('dashboard')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                </li>
            @endcan

            @can('view permission')
                <li class="@if(Route::is('role.*'))active-page @endif">
                    <a href="{{route('role.index')}}" class="active"><i class="material-icons-two-tone">shield</i>Roles</a>
                </li>
            @endcan

            @can('view permission')
                <li class="@if(Route::is('permission.*'))active-page @endif">
                    <a href="{{route('permission.index')}}" class="active"><i
                            class="material-icons-two-tone">shield</i>Permissions</a>
                </li>
            @endcan

            @can('view user')
                <li class="@if(Route::is('user.*')) active-page @endif">
                    <a href="{{route('user.index')}}"
                       class="@if(Route::is('user.index')) active @endif">
                        <i class="material-icons-two-tone">person</i>Users
                    </a>
                </li>
            @endcan

            @can('view salon')
                <li class="@if(Route::is('salon.*')) active-page @endif">
                    <a href="{{route('salon.index')}}"
                       class="@if(Route::is('salon.index')) active @endif">
                        <i class="material-icons-two-tone">view_sidebar</i>Salons
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</div>

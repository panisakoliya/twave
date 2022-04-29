<div class="app-sidebar">
    <div class="logo">
        <a href="{{route('dashboard')}}" class="logo-icon"><span
                class="logo-text" style="visibility: visible;opacity: 1;">{{config('app.name')}}</span></a>
        <div class="sidebar-user-switcher user-activity-online">
        </div>
    </div>

    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="@if(Route::is('dashboard'))active-page @endif">
                <a href="{{route('dashboard')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li class="@if(Route::is('user.*')) active-page @endif">
                <a href="{{route('user.index')}}"
                   class="@if(Route::is('user.index')) active @endif">
                    <i class="material-icons-two-tone">person</i>Users
                </a>
            </li>
            <li class="@if(Route::is('category.*')) active-page @endif">
                <a href="{{route('category.index')}}"
                   class="@if(Route::is('category.index')) active @endif">
                    <i class="material-icons-two-tone">segment</i>Categories
                </a>
            </li>
            <li class="@if(Route::is('product.*')) active-page @endif">
                <a href="{{route('product.index')}}"
                   class="@if(Route::is('product.index')) active @endif">
                    <i class="material-icons-two-tone">extension</i>Products
                </a>
            </li>
            <li class="@if(Route::is('hero.*')) active-page @endif">
                <a href="{{route('hero.index')}}"
                   class="@if(Route::is('hero.index')) active @endif">
                    <i class="material-icons-two-tone">summarize</i>Heros
                </a>
            </li>
        </ul>
    </div>
</div>

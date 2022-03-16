<ul class="nav nav-pills">
    <li class="nav-item"><a class="nav-link {{(request()->routeIs('generalDevProfile')) ? 'active' : 'none' }}" href="{{route('generalDevProfile')}}">General Info</a></li>
    <li class="nav-item"><a class="nav-link {{(request()->routeIs('accountDevSettingProfile')) ? 'active' : 'none' }}" href="{{route('accountDevSettingProfile')}}">Account Setting</a></li>
</ul>
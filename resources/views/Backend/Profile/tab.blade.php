<ul class="nav nav-pills">
    <li class="nav-item"><a class="nav-link {{(request()->routeIs('generalProfile')) ? 'active' : 'none' }}" href="{{route('generalProfile')}}">General Info</a></li>
    <li class="nav-item"><a class="nav-link {{(request()->routeIs('accountSettingProfile')) ? 'active' : 'none' }}" href="{{route('accountSettingProfile')}}">Account Setting</a></li>
</ul>
<ul {!! $options !!} class="navbar-nav me-auto">
    @foreach ($menu_nodes as $key => $row)
        <li class="nav-item {{ $row->css_class }} ">
            <a class="nav-link @if ($row->url == Request::url()) active @endif" href="{{ $row->url }}" target="{{ $row->target }}">
                <i class='{{ trim($row->icon_font) }}'></i> <span>{{ $row->name }}</span>
            </a>
            @if ($row->has_child)
                {!! Menu::generateMenu([
                    'slug' => $menu->slug,
                    'parent_id' => $row->id
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>

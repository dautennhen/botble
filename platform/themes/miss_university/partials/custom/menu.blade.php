@php
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $repo = new \Theme\Missuniversity\Repositories\ThisinhRepo();
    $thisinh = $repo->checkIfMemberRegistered();
@endphp
<ul {!! $options !!} class="navbar-nav me-auto">
    @foreach ($menu_nodes as $key => $row)
    {{-- Anh Lập ơi, Anh Phúc kêu đóng tạm thời, tại nó đăng ký cực quá --}}
        {{-- @php
            $uriSegments = explode("/", $row->url, PHP_URL_PATH);
            $slug = array_pop($uriSegments);
            // dd($row->name);
            if( ($slug == 'dang-ki-du-thi') && $thisinh)
            {
                continue;
            }
                
        @endphp --}}
        <li class="nav-item {{ $row->css_class }} ">
            <a class="nav-link @if ($row->url == Request::url()) active @endif" href="{{ $row->url }}" target="{{ $row->target }}">
                <i class='{{ trim($row->icon_font) }}'></i> <span>{{  strcasecmp($row->name,'Đăng kí')==0&&$thisinh?'Hồ sơ của tôi':$row->name }}</span>
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

<?php
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $slug = $uriSegments[1];
?>
@if ($slug === 'danh-sach-thi-sinh-vong-2')
    {!! Theme::partial('pages/danh-sach-thi-sinh-vong-2') !!}
@elseif ($slug === 'ho-so-du-thi')
    {!! Theme::partial('pages/ho-so-du-thi') !!}
@elseif ($slug === 'tim-kiem-thi-sinh')
    {!! Theme::partial('pages/tim-kiem-thi-sinh') !!}
@elseif ($slug === 'danh-sach-thi-sinh-vong-1')
    {!! Theme::partial('pages/danh-sach-thi-sinh-vong-1') !!}
@elseif ($slug === 'dang-ki-du-thi')
    {!! Theme::partial('pages/dang-ki-du-thi') !!}
@elseif ($slug === 'chi-tiet-thi-sinh')
    {!! Theme::partial('pages/chi-tiet-thi-sinh') !!}
@elseif ($slug === 'danh-sach-thi-sinh-truong')
    {!! Theme::partial('pages/danh-sach-thi-sinh-truong') !!}
@elseif ($slug === 'danh-sach-thi-sinh')
    {!! Theme::partial('pages/danh-sach-thi-sinh') !!}
@elseif ($slug === 'tin-tuc')
    {!! Theme::partial('pages/tin-tuc') !!}
@elseif ($slug === 'the-le')
    {!! Theme::partial('pages/the-le') !!}
@elseif ($slug === 'trang-chu' || $slug === '')
    {!! Theme::partial('pages/trang_chu') !!}
@elseif ($slug === 'vote')
    {!! Theme::partial('pages/vote') !!}
@elseif ($slug === 'list-thisinh')
    {!! Theme::partial('pages/list_thisinh') !!}
@elseif ($slug === 'dang-ki-tham-du')
    {!! Theme::partial('pages/dangki_thamdu') !!}
@elseif ($slug === 'dang-ki-tham-du-2')
    {!! Theme::partial('pages/dangki_thamdu_2') !!}
@elseif ($slug === 'lien-he')
    {!! Theme::partial('pages/lieen-he') !!}
@elseif ($slug === 'profile-thisinh')
    {!! Theme::partial('pages/profile_thisinh') !!}
@elseif ($slug === 'thu-thach')
    {!! Theme::partial('pages/thu_thach') !!}
@else
    {!! Theme::content() !!}
@endif

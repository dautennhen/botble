<div class="header-banners owl-carousel owl-theme">
    @for($i = 0; $i < 3; $i++)
        <div class="banner-item {{ $custom_size ?? '' }}">
            <img class="banner-item" src="{{Theme::asset()->url('dist/images/home/00_Home_03.jpg')}}">
        </div>
    @endfor
</div>

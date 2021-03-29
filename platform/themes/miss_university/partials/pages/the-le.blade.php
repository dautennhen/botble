{{-- {!! Theme::partial('pages/header-blog') !!} --}}
<div class="container">
    <div class="exam-register" style="border:none;">
        <div class="heading">
            <img src="{{Theme::asset()->url('dist/images/missuni_logo_full.png')}}" style="width: 220px" class="logo" alt="">
        </div>
        <div class="body">
            {{-- <h1 class="title text-center">Thể lệ</h1> --}}
            {{-- <div class="exam-register-form"> --}}

                {!!Theme::content()!!}

            {{-- </div> --}}
        </div>
    </div>
</div>


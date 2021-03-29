{!! Theme::partial('banner') !!}
@php
$limit = 10;
$thisinh = get_RandomThiSinh($limit);
$posts = get_latest_posts($limit);
$repo = new \Theme\Missuniversity\Repositories\ThisinhRepo();
$thisinhthamgia = $repo->checkIfMemberRegistered();
@endphp

<section>
    <div class="join-now">
        <a class="join-now__btn" href="{{ route('dang-ki-du-thi') }}">{{$thisinhthamgia?"HỒ SƠ CỦA TÔI":"THAM GIA NGAY"}}</a>
    </div>
    <div class="adviser">
        <div class="container text-center">
        <h3 class="adviser-title">GIÁM KHẢO CHƯƠNG TRÌNH</h3>
        <img class="adviser-img" src="{{Theme::asset()->url('dist/images/home/giam-khao.jpg')}}">
        </div>
    </div>
    <div class="guest">
        <div class="text-center">
            <h3 class="adviser-title">GÓP MẶT CỦA NGÔI SAO</h3>
            <img class="adviser-img" src="{{Theme::asset()->url('dist/images/khach-moi.jpg')}}">
        </div>
    </div>
    <div class="unit container">
        <h3 class="adviser-title">ĐỒNG HÀNH CÙNG CHƯƠNG TRÌNH</h3>
        <div class="unit-logo owl-unit owl-carousel owl-theme">
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_shopee.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_vohoangyen.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_matviet.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_onyx.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_gumac.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_getfit.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_nhakhoakim.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_diyassky.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_hoahau.png')}}">
            </div>
            {{-- <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_htv.png')}}">
            </div> --}}
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_knn.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_mcv.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_mkm.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_netlove.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_nop.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_phuctea.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_slender.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_sony.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_thegioigiaitri.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_tswool.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_vuonhoatuoi.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_yeah1.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_z.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_donghanh_dot2/logo_zoom.png')}}">
            </div>


        </div>
    </div>

    @if (count($thisinh)>0)
    <div class="newbie container">
        <h3 class="adviser-title">ỨNG VIÊN MỚI</h3>
        <div class="row justify-content-center">
            @foreach ($thisinh as $ts)
                <div class="col-6 col-md-4 col-xl-20p">
                    <div class="embed-responsive embed-responsive-1by1">
                    <img src="{{ RvMedia::getImageUrl($ts->avatar, 'list', false, RvMedia::getDefaultImage()) }}" class="embed-responsive-item" alt="{{ $ts->ho.' '. $ts->ten }}">
                    </div>
                    <div class="newbie-body">
                        <div class="newbie-title">
                            <a href="{{ route('chitiet-thisinh', $ts->id) }}">
                                {{$ts->ho.' '. $ts->ten}}
                            </a>
                        </div>
                        <div class="newbie-info">
                            <div class="newbie-number">SBD: {{$ts->so_bao_danh}}</div>
                            <div class="dot"></div>
                            <div class="newbie-year">{{$ts->namhocs->ten_nam_hoc}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
        <a href="{{ route('danhsach-thisinh') }}" class="btn-see-all">XEM TẤT CẢ</a>
        </div>
    </div>
    @endif
    <div class="join-banner d-flex flex-column align-items-center">
        <div class="layer-1"></div>
        <div class="layer-2"></div>
        <img class="background" src="{{Theme::asset()->url('dist/images/home/00_Home_36.jpg')}}">
        <div class="content d-flex flex-column align-items-center">
            <div class="description">HÃY CÙNG CHẠM ĐỈNH VINH QUANG VỚI CHƯƠNG TRÌNH</div>
            <img class="logo" src="{{Theme::asset()->url('dist/images/missuni_logo_full.png')}}">
        </div>
    </div>

    <div class="join-now bg-wh">
        <a class="join-now__btn" href="{{ route('dang-ki-du-thi') }}">{{$thisinhthamgia?"HỒ SƠ CỦA TÔI":"THAM GIA NGAY"}}</a>
    </div>
    <div class="activity">
        <div class="container">
        <h3 class="adviser-title">HOẠT ĐỘNG CỦA CHƯƠNG TRÌNH</h3>
            <div class="activity-program">
            <div class="slider">
            @foreach($posts as $post)
                    <div class="activity-item">
                    <div class="activity-card">
                        <a href="{{ $post->url }}">
                        <img class="activity-img" src="{{ RvMedia::getImageUrl($post->image, 'list', false, RvMedia::getDefaultImage()) }}" class="embed-responsive-item" alt="{{ $post->name }}">
                        </a>
                        <div class="activity-body pt-4">
                            <div class="activity-info">
                                <div class="description">
                                    <a href="{{ $post->url }}">
                                        {{ $post->name }}
                                    </a>
                                </div>
                                <div class="time">
                                    <span>{{ date("m.d.Y", strtotime($post->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            @endforeach
            </div>
                <button type="button" class="activity-prev"><i class="fa fas fa-chevron-left"></i></button>
                <button type="button" class="activity-next"><i class="fa fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    <div class="unit container">
        <h3 class="adviser-title">BÁO CHÍ NÓI VỀ CHÚNG TÔI</h3>
        <div class="unit-logo owl-unit owl-carousel owl-theme">
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_tuoitre.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_thanhnien.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_yannews.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_zing.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_yeah1.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_ione.png')}}">
            </div>
            <div class="logo" >
                <img src="{{Theme::asset()->url('dist/images/home/logo_doitac/logo_ngoisao.png')}}">
            </div>
        </div>
    </div>
    <div class="university">
        <div class="container-fluid">
        <h3 class="adviser-title">KHÁM PHÁ CÁC CƠ SỞ HỌC TẬP</h3>
        <div class="owl-university row justify-content-center">
            <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-20p">
                <div class="university-card">
                    <div class="university-logo d-flex justify-content-center align-items-center">
                        <img src="{{Theme::asset()->url('dist/images/hoa-sen_(1)_2.png')}}">
                    </div>
                    <div class="university-img">
                        <img src="{{Theme::asset()->url('dist/images/image_38.png')}}">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <a class="btn-see-all mt-7" href="https://www.hoasen.edu.vn/" target="_blank">
                            XEM THÊM
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-20p">
                <div class="university-card">
                    <div class="university-logo d-flex justify-content-center align-items-center">
                        <img src="{{Theme::asset()->url('images/logo_5.png')}}">
                    </div>
                    <div class="university-img">
                        <img src="{{Theme::asset()->url('images/image_39.png')}}">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <a class="btn-see-all mt-7" href="https://hiu.vn/" target="_blank">
                            XEM THÊM
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-20p">
                <div class="university-card">
                    <div class="university-logo d-flex justify-content-center align-items-center">
                        <img src="{{Theme::asset()->url('images/BVU_LOGO_FINAL-02_3.png')}}">
                    </div>
                    <div class="university-img">
                        <img src="{{Theme::asset()->url('dist/images/home/phoicanh/phoicanh_brvt.png')}}">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <a class="btn-see-all mt-7" href="https://bvu.edu.vn/" target="_blank">
                            XEM THÊM
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-20p">
                <div class="university-card">
                    <div class="university-logo d-flex justify-content-center align-items-center">
                        <img src="{{Theme::asset()->url('dist/images/home/GiaDinh_logo.png')}}">
                    </div>
                    <div class="university-img">
                        <img src="{{Theme::asset()->url('dist/images/home/phoicanh/phoicanh_giadinh.png')}}">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <a class="btn-see-all mt-7" href="https://giadinh.edu.vn/" target="_blank">
                            XEM THÊM
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-20p">
                <div class="university-card">
                    <div class="university-logo d-flex justify-content-center align-items-center">
                        <img src="{{Theme::asset()->url('dist/images/home/miendong_logo.png')}}">
                    </div>
                    <div class="university-img">
                        <img src="{{Theme::asset()->url('dist/images/home/MUT_thumbnail.jpg')}}">
                    </div>
                    <div class="d-flex justify-content-center align-center">
                        <a class="btn-see-all mt-7" href="http://www.mut.edu.vn/" target="_blank">
                            XEM THÊM
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

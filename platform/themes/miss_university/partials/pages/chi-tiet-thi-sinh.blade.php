{{-- {!! Theme::partial('pages/header-profile') !!} --}}
@php
if (isset($_GET["id"])) {
    $ts = get_ThiSinhById($_GET["id"]);
    if ($ts) {
        switch (theme_option('round_number')) {
        case 1:
            $enable = $ts->vong_loai;
            break;
        case 2:
            $enable = $ts->vong_top_200;
            break;
        case 3:
            $enable = $ts->vong_top_40;
            break;
        case 4:
            $enable = $ts->vong_top_35;
            break;
        default:
            $enable = $ts->vong_loai;
            break;
        }
    }

    $id_thisinh=$_GET["id"];
    // Session::put('ss_id_thisinh', $id_thisinh);
}
$voteds = getVotedThisinh();
@endphp
@if ($ts)
<div class="header-banner">
    <div class="banner-item {{ $custom_size ?? '' }}">
        {{-- 2 ảnh toàn thân của thí sinh dùng làm slider --}}
        @if ($ts->avatar_toan_than_1)
        <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_1) }}" alt="{{ $ts->full_name }}">
        @else
        <img src="{{Theme::asset()->url('dist/images/home/00_Home_03.jpg')}}">
        @endif
        {{-- <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_2, 'featured', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
        --}}
    </div>
    <div class="school-logo">
        <img src="{{ RvMedia::getImageUrl($ts->truongs->logo_truong, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->truongs->ten_truong }}">
    </div>
    <div class="candidate-name">
        {{ $ts->full_name }}
    </div>
    <div class="candidate-sbd">
        SBD:<strong>{{ $ts->so_bao_danh }}</strong>
    </div>


@if ($enable == '1')
    <div class="profile-vote-wrap">
        {{-- Nút bình chọn (copy bên danh-sach-thi-sinh.blade.php) --}}
        <?php if(!in_array($ts->id, $voteds)) {?>
        <button class="btn_vote" data-vote="{{ $ts->id }}">
            <img src="{{Theme::asset()->url('dist/images/vote-btn-lg.png')}}" alt="">
        </button>
        <?php } else { ?>
            <a>
                <img src='{{Theme::asset()->url('dist/images/binhchonprofile.png')}}'>
            </a>
        <?php  } ?>
    </div>
@endif
</div>
<section class="profile">
    <div class="container">


        <div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="profile__summary">
                    <div class="profile__summary--art position-relative">
                        <img src="{{ RvMedia::getImageUrl($ts->avatar, 'profile', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                        <div class="position-absolute vote-button">
                            <span>Lượt bình chọn: </span>
                            <span class="font-weight-bold so-chon">{{ $ts->luot_bau_chon }}</span>
                        </div>
                    </div>
                    <div class="profile__summary--name text-center text-lg-left">
                        {{ $ts->full_name }}
                    </div>
                    <div class="profile__summary--info d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="info-sbd">
                            SBD: <span class="font-weight-bold">{{ $ts->so_bao_danh }}</span>
                        </div>
                        <div class="info-dot"></div>
                        <div class="info-tag">
                            {{ $ts->namhocs->ten_nam_hoc }}
                        </div>
                        <div class="info-dot"></div>
                        <div class="info-sbd">
                            Lượt xem: <span class="font-weight-bold">{{ $ts->luot_xem_profile }}</span>
                        </div>
                    </div>
                    <div class="profile__summary--button font-weight-bold text-center text-lg-left">
                        {{-- <button class="btn-social">
                            <i class="fab fa-facebook-square"></i>
                            Like
                        </button>
                        <button class="btn-social">
                            Share
                        </button> --}}

                        <div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button" data-size="small"></div>
                        @if ($enable == '1')
                            <?php if(!in_array($ts->id, $voteds)) {?>
                            <button class="btn_vote mini_btn_vote" data-vote="{{ $ts->id }}">
                                <img src="{{Theme::asset()->url('dist/images/elimination/binhchon.png')}}" alt="">
                            </button>
                            <?php } else { ?>
                                <a class="mini_btn_vote">
                                    <img src='{{Theme::asset()->url('dist/images/elimination/binhchonlist.png')}}'>
                                </a>
                            <?php  } ?>

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-8">
                <div class="profile__contain">
                    <div class="profile__contain--detail d-flex align-items-center">
                        <div class="d-flex flex-column align-items-center align-items-lg-start">
                            <div class="detail-name">Tuổi</div>
                            <div class="detail-description">
                                {{ date('Y') - date("Y", strtotime($ts->ngay_sinh)) }}
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center align-items-lg-start">
                            <div class="detail-name">Chiều cao</div>
                            <div class="detail-description">{{ $ts->chieu_cao }}</div>
                        </div>
                        <div class="d-flex flex-column align-items-center align-items-lg-start">
                            <div class="detail-name">Cân nặng</div>
                            <div class="detail-description">{{ $ts->can_nang }}</div>
                        </div>
                        <div class="d-flex flex-column align-items-center align-items-lg-start">
                            <div class="detail-name">Số đo 3 vòng</div>
                            <div class="detail-description">{{ $ts->so_do_ba_vong }}</div>
                        </div>
                    </div>
                    <div class="profile__contain--description">
                        {!! clean($ts->mo_ta_ly_lich, 'youtube') !!}
                    </div>
                    <div class="profile__contain--gallery">
                        <div class="row">
                            <div class="col-12 col-lg-11">
                                <div class="gallery-head text-uppercase font-weight-bold">video</div>
                                <div class="">
                                    <div class="embed-responsive embed-responsive-16by9 mb30 w-100">
                                        <?php
                                        try {
                                            $ts->video=str_replace('https://youtu.be/', 'https://www.youtube.com/watch?v=', $ts->video);

                                            $file = 'https://www.youtube.com/oembed?url='.$ts->video;

                                            // dd($file);
                                            $headers = get_headers($file);
                                            if (!strpos($headers[0], '200')) {
                                                echo "Để hồ sơ dự thi hợp lệ, thí sinh vui lòng liên hệ Ban Tổ Chức tại Trang Liên Hệ để cập nhật video giới thiệu bản thân gấp.";
                                                $auto_play=$ts->video=null;
                                            }
                                            else{
                                                $auto_play=str_replace('watch?v=', 'embed/', $ts->video);
                                                $auto_play=$auto_play.'?autoplay=1;';
                                            }

                                        } catch (\Throwable $th) {
                                            return "Nội dung bị lỗi";
                                        }

                                        //  dd($auto_play);
                                        ?>
                                        <iframe class="embed-responsive-item" allowfullscreen frameborder="0" height="100" width="200" src="{{$auto_play}}"allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                      {{-- <iframe src="https://www.youtube.com/embed/pV1jC37ELmQ?rel=0&amp;showinfo=0?ecver=2" width="640" height="360"></iframe> --}}
                                      {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/3G3BflStNdI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile__contain--gallery">
                        <div class="row">
                            <div class="col-12 col-lg-11">
                                <div class="gallery-head text-uppercase font-weight-bold">hình ảnh</div>
                                <div class="d-flex flex-wrap gallery-img">
                                    {{-- @for($i = 1; $i <= 5; $i++)
                                        <div>
                                            <img src="{{Theme::asset()->url('images/avatar.png')}}" />
                                        </div>
                                    @endfor --}}
                                    @if ($ts->avatar_toan_than_1)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->avatar_toan_than_1) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_1, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->avatar_toan_than_2)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->avatar_toan_than_2) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_2, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->anh_1)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->anh_1) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->anh_1, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->anh_2)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->anh_2) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->anh_2, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->anh_3)
                                    <a data-lightbox="profile-image-gallery"href="{{ RvMedia::getImageUrl($ts->anh_3) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->anh_3, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->anh_4)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->anh_4) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->anh_4, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif
                                    @if ($ts->anh_5)
                                    <a data-lightbox="profile-image-gallery" href="{{ RvMedia::getImageUrl($ts->anh_5) }}">
                                        <img src="{{ RvMedia::getImageUrl($ts->anh_5, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile__contain--comment">
                        <div class="row">
                            <div class="col-12 col-lg-11">
                                <div class="comment-divider">
                                </div>
                                @if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes')
                                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, Theme::partial('comments')) !!}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="voting-modal" data-backdrop="true" tabindex="-1" aria-labelledby="voting-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <img src="{{Theme::asset()->url('dist/images/modal-header.jpg')}}">
                <div class="modal-body">
                    <h3 class="text-center">BẠN ĐÃ BÌNH CHỌN XONG, XIN CÁM ƠN</h3>
                    <div class="profile__summary">
                        <div class="profile__summary--art position-relative">
                            <img src="{{ RvMedia::getImageUrl($ts->avatar, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                            <button class="position-absolute vote-button">
                                <span>Lượt bình chọn: </span>
                                <span class="font-weight-bold so-chon">{{ $ts->luot_bau_chon }}</span>
                            </button>
                        </div>
                        <div class="profile__summary--name text-center text-lg-left">
                            {{ $ts->full_name }}
                        </div>
                        <div class="profile__summary--info d-flex align-items-center justify-content-center justify-content-lg-start">
                            <div class="info-sbd">
                                SBD: <span class="font-weight-bold">{{ $ts->so_bao_danh }}</span>
                            </div>
                            <div class="info-dot"></div>
                            <div class="info-tag">
                                {{ $ts->namhocs->ten_nam_hoc }}
                            </div>
                        </div>
                        <div class="profile__summary--button font-weight-bold text-center">
                            <button class="close float-none" data-vote="{{ $ts->id }}">
                                <img src="{{Theme::asset()->url('dist/images/close.png')}}" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    var sochon="{{$ts->luot_bau_chon}}";
    $(document).ready(function(){
        var id = '{{$id_thisinh}}';

            sendData('member/do-vote-dis', {thisinh_id:id}, 'POST', function(response){
            if(response.mess=='!!')
            {
                // $('.btn_vote').html("<img src='{{Theme::asset()->url('dist/images/binhchonprofile.png')}}'>")
                return $('.btn_vote').attr('disabled','disabled');
            }
        })
        $('.btn_vote').on('click', function(){
            if($(this).is('.disabled'))
                return
            $(this).addClass('disabled')
            var id = $(this).data('vote')
            console.log("asdfasdf");
            sendData('member/do-vote', {thisinh_id:id}, 'POST', function(response){
                if(response.voted && response.session==-1) {
                    $('.so-chon').text(parseInt(sochon)+1);
                    $('.btn_vote').attr('disabled','disabled')
                    $('.btn_vote').html("<img src='{{Theme::asset()->url('dist/images/binhchonprofile.png')}}'>")
                    $('.mini_btn_vote').html("<img src='{{Theme::asset()->url('dist/images/elimination/binhchonlist.png')}}'>")
                    $('#voting-modal').modal({})
                    return
                }
                if(response.votedover)
                    return alert('Bạn đã vote đủ lượt')
                if(response.mess=='##')
                    return alert('Lỗi mạng, thử lại sau')
                window.location.href = "login"
            })
        })
        $(".close").click(function () {
            $("#voting-modal").modal("hide");
        });
    })
</script>
@endpush

@else
<div class="header-banner">
    <div class="banner-item {{ $custom_size ?? '' }}">
        <img src="{{Theme::asset()->url('dist/images/home/00_Home_03.jpg')}}">
    </div>
    <div class="candidate-name">
        Không tìm thấy thí sinh
    </div>
</div>
@endif

@if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes' || (theme_option('facebook_chat_enabled', 'yes') == 'yes' && theme_option('facebook_page_id')))
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v7.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    @if (theme_option('facebook_chat_enabled', 'yes') == 'yes' && theme_option('facebook_page_id'))
        <div class="fb-customerchat"
             attribution="install_email"
             page_id="{{ theme_option('facebook_page_id') }}"
             theme_color="{{ theme_option('primary_color', '#ff2b4a') }}">
        </div>
    @endif
@endif

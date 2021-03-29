@php
$truong = get_ListTruong();
$thiSinhPerPage = 20;// số lượng thí sinh trong 1 trang
if (isset($_GET["id"])) {
    $thisinh = get_ThiSinhByTruong($_GET["id"], $thiSinhPerPage);
} else {
    $thisinh = get_ListThiSinh($thiSinhPerPage);
}
$voteds = getVotedThisinh();
@endphp

{{-- <section class="header-banner">
    <img class="banner-item" src="{{Theme::asset()->url('dist/images/imgpsh_fullsize_anim.jpg')}}">
</section> --}}

<section class="elimination-round">
    <div class="container-fluid">
        <div class="row justify-content-center owl-elimination-round">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-auto mb-5 mb-md-0">
                    <div class="elimination-round__item">
                        {{-- 1: vòng loại | 2: top200 | 3: top40 | 4: final  --}}
                        <a class="{{ $i === intval(theme_option('round_number')) ? 'active' : '' }}">
                            <img class="elimination-round__item-img"
                                src="{{Theme::asset()->url('dist/images/round_img/round_'.$i.'_inactive.png')}}" alt="">
                            <img class="elimination-round__item-img elimination-round__item-img--active"
                                src="{{Theme::asset()->url('dist/images/round_img/round_'.$i.'_active.png')}}" alt="">
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="container">
        <hr class="elimination-round__hr">
        <div class="note">*Chọn logo trường để xem danh sách thí sinh của mỗi trường hoặc tìm thí sinh <a href="#">tại đây</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-stretch no-gutters">
            {{--
            @foreach ($truong as $tr)
            <div class="col-auto">
                <div class="elimination-round__logo">
                    <a class="@if (isset($_GET["id"]) && $_GET["id"] == $tr->id) active @endif logoTruong" id="{{ $tr->id }}">
                        <img src="{{ RvMedia::getImageUrl($tr->logo_truong) }}" alt="{{ $tr->ten_truong }}">
                    </a>
                </div>
            </div>
            @endforeach
            --}}
            @for($i = 1; $i <= 5; $i++)
                <div class="col-auto">
                    <div class="elimination-round__logo">
                        <a>
                            <img class="elimination-round__logo-img logoTruong" id="{{ $i }}"
                            @if (isset($_GET["id"]) && $_GET["id"] == $i)
                                src="{{Theme::asset()->url('dist/images/school_logo/sLogo_'.$i.'_active.png')}}"
                            @else
                                src="{{Theme::asset()->url('dist/images/school_logo/sLogo_'.$i.'_inactive.png')}}"
                            @endif
                                alt="">
                            <img class="elimination-round__logo-img elimination-round__logo-img--active logoTruong" src="{{Theme::asset()->url('dist/images/school_logo/sLogo_'.$i.'_active.png')}}" alt="" id="{{ $i }}">

                            {{-- @if (isset($_GET["id"]) && $_GET["id"] == $i)
                            @endif --}}
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    @if (count($thisinh)>0)
    <div class="container">
        <div class="row">
            @foreach ($thisinh as $ts)
            {{-- @if ($ts->vong_loai=='1') --}}
            <div class="col-6 col-md-4 col-lg-3 col-xl-20p candidate profile{{$ts->id}}">
                <div class="candidate-img embed-responsive embed-responsive-1by1">
                    <img src="{{ RvMedia::getImageUrl($ts->avatar, 'list', false, RvMedia::getDefaultImage()) }}" class="embed-responsive-item" alt="{{ $ts->full_name }}">
                </div>
                <div class="candidate-content">
                    <div class="name">
                        <a href="{{ route('chitiet-thisinh', $ts->id) }}">
                        {{$ts->full_name}}</a>
                    </div>
                    <div class="sbd">SBD: <span class="sbd_">{{$ts->so_bao_danh}}</span> <span class="dot"></span> <span class="nam-hoc">{{$ts->namhocs->ten_nam_hoc}}</span></div>
                    <?php if(!in_array($ts->id, $voteds)) {?>
                        <button class="btn_vote ts-id{{$ts->id}}" data-vote="{{ $ts->id }}">
                            <img class="img-dis" src="{{Theme::asset()->url('dist/images/elimination/binhchon.png')}}" alt="" />
                        </button>
                    <?php } else { ?>
                        <button class="btn_vote dis-img">
                            <img class="img-dis" src="{{Theme::asset()->url('dist/images/elimination/binhchonlist.png')}}" alt="" />
                        </button>
                    <?php } ?>
                </div>
            </div>
            {{-- @endif --}}
            @endforeach
        </div>
        <div class="page-pagination text-center">
            {!! $thisinh->withQueryString()->links() !!}
        </div>
    </div><!--end container-->
    <div class="modal fade" id="voting-modal" data-backdrop="true" tabindex="-1" aria-labelledby="voting-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <img src="{{Theme::asset()->url('dist/images/modal-header.jpg')}}">
                <div class="modal-body">
                    <h3 class="text-center">BẠN ĐÃ BÌNH CHỌN XONG, XIN CÁM ƠN</h3>
                    <div class="profile__summary">
                        {{-- tạm thời tắt do chưa lấy đúng id thí sinh đã bình chọn --}}
                        <div class="profile__summary--art position-relative">
                            <img class="hinh-avatar" src="{{ RvMedia::getImageUrl($ts->avatar, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $ts->full_name }}">
                        </div>
                        <div class="profile__summary--name text-center text-lg-left">
                            {{ $ts->full_name }}
                        </div>
                        <div class="profile__summary--info d-flex align-items-center justify-content-center justify-content-lg-start">
                            <div class="info-sbd">
                                SBD: <span class="font-weight-bold sbd">{{ $ts->so_bao_danh }}</span>
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
    @endif
</section>

@push('scripts')
    <script>
    $(document).ready(function(){
        $( ".logoTruong" ).click(function() {
            var id = $(this).attr("id")
            window.location.href = window.location.href.replace( /[\?#].*|$/, "?id=" + id);
        });
        var srcImg=$('.img-dis').attr('src');
        // console.log(srcImg);
        srcImg=srcImg.replace(srcImg,"img_disabled");
        if(srcImg=="img_disabled")
        {
            $('.dis-img').attr('disabled','disabled');
        }

        $('.btn_vote').on('click', function(){
            if($(this).is('.disabled'))
                return
            var id = $(this).data('vote')
            sendData('member/do-vote', {thisinh_id:id}, 'POST', function(response){
                if(response.voted && response.session==-1) {
                    // $('.btn_vote').addClass('dis-btn'+id)
                    $('.ts-id'+id).html(" <img src='{{Theme::asset()->url('dist/images/binhchonlist.png')}}' />");
                    $('.ts-id'+id).attr('disabled','disabled')

                    $('#voting-modal').find('.profile__summary--name').html( $('.profile'+id).find('.name').text() )
                    $('#voting-modal').find('.sbd').html( $('.profile'+id).find('.sbd_').text() )
                    $('#voting-modal').find('.info-tag').html( $('.profile'+id).find('.nam-hoc').text() )
                    $src=$('.profile'+id).find('.embed-responsive-item').attr('src');
                    $('#voting-modal').find('.hinh-avatar').attr( 'src', $src)
                    $('#voting-modal').modal();

                    id_dis=id;
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
    });
    window.addEventListener( "pageshow", function ( event ) {
    var historyTraversal = event.persisted ||
                            ( typeof window.performance != "undefined" &&
                                window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
        // Handle page restore.
        window.location.reload(true);
    }
    });

    </script>
@endpush

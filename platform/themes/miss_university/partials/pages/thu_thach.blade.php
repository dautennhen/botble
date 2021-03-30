@php
$team = get_ThachThuc();
// dd($team[0]->huan_luyen_vien);
// dd($team->pluck('huan_luyen_vien')[0]);

if (isset($_GET["id"])) {
    $logoTruong = $team->pluck('image')[$_GET["id"] - 1];
    $hlv = $team->pluck('huan_luyen_vien')[$_GET["id"] - 1];
    $avatarHLV = $team->pluck('avatar_hlv')[$_GET["id"] - 1];
    // lấy 8 thí sinh của team 'id'
    for ($i = 1; $i <= 8 ; $i++) {
        $thisinh[$i] = get_ThiSinhById($team->pluck('ts'.$i)[$_GET["id"] - 1]);
    }
    // dd($thisinh[2]);

    $videos = get_HoatDongByTeam($_GET["id"]);
    // dd($videos->pluck('url'));
} else {
    $logoTruong = $team[0]->image;
    $hlv = $team[0]->huan_luyen_vien;
    $avatarHLV = $team[0]->avatar_hlv;
    // mặc định lấy 8 thí sinh của team đầu
    for ($i = 1; $i <= 8 ; $i++) {
        $thisinh[$i] = get_ThiSinhById($team->pluck('ts'.$i)[0]);
    }
    // dd($thisinh[1]);

    $videos = get_HoatDongByTeam(1);
}

@endphp
<section class="elimination-round elimination-round-challenge">
    <div class="container-fluid real-challenge">
        <div class="row elimination-round-challenge_title text-center">
            <div class="col-lg-12 col-auto m-auto">
                <span class="font-weight-bold text-uppercase">thử thách thực tế</span>
            </div>
        </div>
        <div class="row justify-content-center owl-elimination-round">
            @for($i = 1; $i <= 5; $i++)
                <div class="col-auto mb-5 mb-lg-0">
                    <div class="elimination-round__item">
                        @if (isset($_GET["id"]) && $_GET["id"] == $i)
                        <a class="active" href="/thu-thach?id={{ $i }}">
                        @elseif (!isset($_GET["id"]) && $i===1)
                        <a class="active" href="/thu-thach?id={{ $i }}">
                        @else
                        <a class="" href="/thu-thach?id={{ $i }}">
                        @endif
                            <img class="elimination-round__item-img"
                                 src="{{Theme::asset()->url('dist/images/challenge/Team/team_'.$i.'_inactive.png')}}" alt="">
                            <img class="elimination-round__item-img elimination-round__item-img--active"
                                 src="{{Theme::asset()->url('dist/images/challenge/Team/team_'.$i.'_active.png')}}" alt="">
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="container elimination-round-challenge_member">
        <div class="row">
            <div class="col-lg-3 mt-lg-0 mb-3">
                <div class="elimination-round-challenge_trainer">
                    <div class="section-title">huấn luyện viên</div>
                    <div class="text-center mt-4">
                        {{-- <img class="elimination-round-challenge_img"
                             src="{{Theme::asset()->url('dist/images/challenge/challenge-trainer.png')}}" alt=""> --}}
                        <img class="elimination-round-challenge_img"
                        src="{{ RvMedia::getImageUrl($avatarHLV, 'list', false, RvMedia::getDefaultImage()) }}" alt="">
                        <p class="font-weight-bold text-uppercase">{{ $hlv }}</p>
                        {{-- <img class="elimination-round-challenge_trainer_logo"
                             src="{{Theme::asset()->url('dist/images/challenge/logo-hoa-sen-university.png')}}" alt="aaaaaaa"> --}}
                        <img class="elimination-round-challenge_trainer_logo"
                        src="{{ RvMedia::getImageUrl($logoTruong, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-5 mt-lg-0">
                <div class="elimination-round-challenge_trainee">
                    <div class="container">
                        <div class="row">
                            <div class="col section-title mb-4">thành viên nhóm</div>
                        </div>
                        <div class="row">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-2">
                                    <div class="elimination-round-challenge_trainee_card">
                                        @if ($thisinh[$i])
                                        <img class="elimination-round-challenge_img"
                                             src="{{RvMedia::getImageUrl($thisinh[$i]->avatar, 'list', false, RvMedia::getDefaultImage())}}" alt="">
                                        <div class="trainee-name pt-3">
                                            <a href="/chi-tiet-thi-sinh?id={{ $thisinh[$i]->id }}">
                                                {{ $thisinh[$i]->full_name }}
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center pt-1">
                                            <span class="trainee-id">SBD: {{ $thisinh[$i]->so_bao_danh }}</span>
                                            <i class="fa fa-circle mr-3" aria-hidden="true"></i>
                                            <span>{{ $thisinh[$i]->namhocs->ten_nam_hoc }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="elimination-round-challenge__teamwork">
                    <div class="container">
                        <div class="row">
                            <div class="col section-title mb-4">hoạt động của nhóm</div>
                        </div>
                        <div class="row">
                            {{-- @for($i = 1; $i <= 6; $i++)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/EvyDWmlnNlA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endfor --}}
                            @foreach ($videos as $v)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    {{-- <div class="embed-responsive embed-responsive-16by9 mb-3">
                                        <iframe width="560" height="315" src="{{ $v->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div> --}}
                                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                                        @php
                                        $v->url = str_replace('https://youtu.be/', 'https://www.youtube.com/watch?v=', $v->url);
                                        @endphp
                                        <iframe class="embed-responsive-item" allowfullscreen frameborder="0" height="315" width="560" src="{{str_replace('watch?v=', 'embed/', $v->url)}}" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

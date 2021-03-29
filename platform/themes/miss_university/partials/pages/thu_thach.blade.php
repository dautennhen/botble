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
                        <a class="{{ $i === 1 ? 'active' : '' }}">
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
                        <img class="elimination-round-challenge_img"
                             src="{{Theme::asset()->url('dist/images/challenge/challenge-trainer.png')}}" alt="">
                        <p class="font-weight-bold text-uppercase">võ hoàng yến</p>
                        <img class="elimination-round-challenge_trainer_logo"
                             src="{{Theme::asset()->url('dist/images/challenge/logo-hoa-sen-university.png')}}" alt="aaaaaaa">
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
                                        <img class="elimination-round-challenge_img"
                                             src="{{Theme::asset()->url('dist/images/challenge/challenge-trainer.png')}}" alt="">
                                        <div class="trainee-name pt-3">Vũ Quỳnh Trang</div>
                                        <div class="d-flex justify-content-start align-items-center pt-1">
                                            <span class="trainee-id">SBD: 063</span>
                                            <i class="fa fa-circle mr-3" aria-hidden="true"></i>
                                            <span>Năm nhất</span>
                                        </div>
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
                            @for($i = 1; $i <= 6; $i++)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/EvyDWmlnNlA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

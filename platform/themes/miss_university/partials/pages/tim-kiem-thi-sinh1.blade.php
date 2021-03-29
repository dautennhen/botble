<form action="" method="get" >
    <input type="text" name="search_value" />
    <input type="submit" value="search" />
</form>

@php
    $thisinh = searchThisinh();
    $voteds = getVotedThisinh();
@endphp

<div class="container">
    <div class="row">
        @foreach ($thisinh as $ts)
        <div class="col-6 col-md-4 col-lg-3 col-xl-20p candidate">
            <div class="candidate-img embed-responsive embed-responsive-1by1">
                <img src="{{ RvMedia::getImageUrl($ts->avatar, 'thumb', false, RvMedia::getDefaultImage()) }}" class="embed-responsive-item" alt="{{ $ts->full_name }}">
            </div>
            <div class="candidate-content">
                <div class="name">
                    <a href="{{ route('chitiet-thisinh', $ts->id) }}">
                    {{$ts->full_name}}</a>
                </div>
                <div class="sbd">SBD: {{$ts->so_bao_danh}} <span class="dot"></span> {{$ts->namhocs->ten_nam_hoc}}</div>
                <?php if(!in_array($ts->id, $voteds)) {?>
                    <a class="btn_vote" data-vote="{{ $ts->id }}">
                        <img src="{{asset('themes/miss_university/images/elimination/binhchon.png')}}" alt="">
                    </a>
                <?php } ?>
            </div>
        </div>
        @endforeach
    </div>
    <div class="page-pagination text-center">
        {!! $thisinh->withQueryString()->links() !!}
    </div>
</div><!--end container-->
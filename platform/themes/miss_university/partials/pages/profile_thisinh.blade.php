{{-- @if (is_plugin_active('miss')) --}}
<h4>Profile thí sinh</h4>
@php
if (isset($_GET["id"])) {
    $ts = get_ThiSinhById($_GET["id"]);
    $id_thisinh=$_GET["id"];
    // $photo = $ts->photos->first();
}
// dd($ts->votes->count());
@endphp
<table class="table" border="1">

    <tr>
        <td>Ảnh cover (2 ảnh toàn thân)</td>
        <td>
            <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_1, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
            <img src="{{ RvMedia::getImageUrl($ts->avatar_toan_than_2, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
        </td>
    </tr>
    <tr>
        <td>Logo trường</td>
        <td><img src="{{ RvMedia::getImageUrl($ts->truongs->logo_truong, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->truongs->ten_truong }}"></td>
    </tr>
    <tr>
        <td width='300px'>Ảnh chân dung</td>
        <td><img src="{{ RvMedia::getImageUrl($ts->avatar, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}"></td>
    </tr>
    <tr>
        <td>SBD</td>
        <td>{{ $ts->so_bao_danh }}</td>
    </tr>
    <tr>
        <td>Họ tên</td>
        <td>{{ $ts->full_name }}</td>
    </tr>
    <tr>
        <td>Nút bình chọn</td>
        <td>
            <button class="btn_vote" data-vote="{{ $ts->id }}">
                Bình chọn nè
            </button>
        </td>
    </tr>
    <tr>
        <td>Lượt bình chọn <br> (count từ bảng voteall)</td>
        <td>{{ $ts->votes->count() }}</td>
    </tr>
    <tr>
        <td>Lượt bình chọn <br> (get field luot_bau_chon của bảng thisinhs)</td>
        <td>{{ $ts->luot_bau_chon }}</td>
    </tr>
    <tr>
        <td>Năm</td>
        <td>{{ $ts->namhocs->ten_nam_hoc }}</td>
    </tr>
    <tr>
        <td>Tuổi</td>
        <td>{{ date('Y') - date("Y", strtotime($ts->ngay_sinh)) }}</td>
    </tr>
    <tr>
        <td>Chiều cao</td>
        <td>{{ $ts->chieu_cao }}</td>
    </tr>
    <tr>
        <td>Số đo ba vòng</td>
        <td>{{ $ts->so_do_ba_vong }}</td>
    </tr>
    <tr>
        <td>Quê quán</td>
        <td>{{ $ts->que_quan }}</td>
    </tr>
    <tr>
        <td>Lý lịch <br> (chưa xử lý data của CKEditor)</td>
        <td>
            {!! clean($ts->mo_ta_ly_lich, 'youtube') !!}

        </td>
    </tr>
    <tr>
        <td>Video</td>
        <td>
            <div class="embed-responsive embed-responsive-16by9 mb30">
                <iframe class="embed-responsive-item" allowfullscreen frameborder="0" height="100" width="200" src="{{ str_replace('watch?v=', 'embed/', $ts->video) }}"></iframe>
            </div>
        </td>
    </tr>
    <tr>
        <td>Hình ảnh <br> (lấy 5 field ảnh từ thisinhs)</td>
        <td>
            {{-- <img src="{{ RvMedia::getImageUrl($photo->image, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}"> --}}
            <img src="{{ RvMedia::getImageUrl($ts->anh_1, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
            <img src="{{ RvMedia::getImageUrl($ts->anh_2, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
            <img src="{{ RvMedia::getImageUrl($ts->anh_3, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
            <img src="{{ RvMedia::getImageUrl($ts->anh_4, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
            <img src="{{ RvMedia::getImageUrl($ts->anh_5, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
        </td>
    </tr>
    <tr>
        <td>Facebook Like Share</td>
        <td>
            <div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
        </td>
    </tr>
    <tr>
        <td>Facebook Comment</td>
        <td>
            @if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes')
                <br />
                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, Theme::partial('comments')) !!}
            @endif
        </td>
    </tr>
</table>
{{-- @endif --}}
@push('scripts')
<script type="text/javascript">
    var id = '{{$id_thisinh}}';
    $(document).ready(function(){
        $.fn.sendData('member/do-vote-dis', {thisinh_id:id}, 'POST', function(response){
            if(response.mess=='!!')
                return $('.btn_vote').attr('disabled','disabled');
        })

        $('.btn_vote').on('click', function(){
            if($(this).is('.disabled'))
                return
            $(this).addClass('disabled')
            var id = $(this).data('vote')
            $.fn.sendData('member/do-vote', {thisinh_id:id}, 'POST', function(response){
                if(response.voted && response.session==-1) {
                    $('.btn_vote').attr('disabled','disabled')
                    return alert('Bạn đã bình chọn cho thí sinh này')
                }
                if(response.votedover)
                    return alert('Bạn đạ vote đủ lượt')
                if(response.mess=='##')
                    return alert('Lỗi mạng, thử lại sau')
                window.location.href = "login"
            })
        })
    })
</script>
@endpush

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

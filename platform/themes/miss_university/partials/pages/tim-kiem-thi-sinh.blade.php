<style>
    .center-block {
        margin: auto;
        display: block;
        background: #fff;
        display: flex;
        border: 1px solid #dfe1e5;
        box-shadow: none;
        border-radius: 24px;
        z-index: 3;
        height: 44px;
        margin: 0 auto;
        width: 482px;
        text-align: center;

    }
    .center-sub{
        margin: auto;
        display: block;

        margin-top: 18px;
        margin-bottom: 20px;
        background-color: #f8f9fa;
        border: 1px solid #f8f9fa;
        border-radius: 4px;

        line-height: 27px;
        height: 36px;
        min-width: 54px;
        text-align: center;
        cursor: pointer;
        user-select: none;
        padding: 0 16px;
    }
    .center-imgs{
        margin: auto;
        display: block;
        margin-bottom: 20px;

    }
    ::-webkit-input-placeholder {
    text-align: center;
    }

    :-moz-placeholder { /* Firefox 18- */
    text-align: center;
    }

    ::-moz-placeholder {  /* Firefox 19+ */
    text-align: center;
    }

    :-ms-input-placeholder {
    text-align: center;
    }
    .pagination{

        margin-left: 50px;
        /* display: block; */
    }
    .btn_vote{
        margin-top: 10px;
        margin-bottom: 30px;
    }

</style>
<?php 
    $search_value = empty($_REQUEST['search_value']) ? '' : $_REQUEST['search_value'];
?>
<img class="center-imgs" src="{{ Theme::asset()->url('images/miss_logo.png') }}" class="img-fluid footer-logo">
<form action="" method="get" >
    <input class="center-block" type="text" name="search_value" value="<?php echo $search_value; ?>" placeholder="Nhập họ tên hoặc SBD thí sinh cần tìm..." />
    <input class="center-sub" type="submit" value="Tìm kiếm" />
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
                <div class="sbd">SBD: {{$ts->so_bao_danh}} -  <span class="dot"></span> {{$ts->namhocs->ten_nam_hoc}}</div>
                    <a href="{{ route('chitiet-thisinh', $ts->id) }}" class="btn_vote" data-vote="{{ $ts->id }}">
                        <img src="{{asset('themes/miss_university/images/elimination/chitiet.png')}}" alt="">
                    </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="page-pagination text-center-page">
        {!! $thisinh->withQueryString()->links() !!}
    </div>

</div>
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
                    $('.ts-id'+id).html(" <img src='{{Theme::asset()->url('dist/images/binhchonlist.png')}}'>");
                    $('.ts-id'+id).attr('disabled','disabled')
                    $('#voting-modal').modal({})
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

    </script>
</div><!--end container-->

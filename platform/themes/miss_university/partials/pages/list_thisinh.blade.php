<?php
//  echo Theme\Missuniversity\Repositories\ThiSinh::listThiSinh();
?>

{{-- @if (is_plugin_active('miss')) --}}
<h4>Danh sách thí sinh</h4>
@php
$truong = get_ListTruong();
$thiSinhPerPage = 5;
if (isset($_GET["id"])) {
    $thisinh = get_ThiSinhByTruong($_GET["id"], $thiSinhPerPage);
} else {
    $thisinh = get_ListThiSinh($thiSinhPerPage);
}
$voteds = getVotedThisinh();
@endphp

<div class="row">
    @foreach ($truong as $tr)
    <div class="col-xs-2">
        <img src="{{ RvMedia::getImageUrl($tr->logo_truong, 'thumb', false, RvMedia::getDefaultImage()) }}" class="logoTruong" id="{{ $tr->id }}" alt="{{ $tr->ten_truong }}">
    </div>
    @endforeach
</div>

<div class="row">
    <div class="">
        @foreach ($thisinh->chunk(5) as $chunk)
        <div class="row">
            @foreach ($chunk as $ts)
            <div class="col-md-2">
                <div class="card">
                    <img src="{{ RvMedia::getImageUrl($ts->avatar, 'thumb', false, RvMedia::getDefaultImage()) }}" class="card-img-top" alt="{{ $ts->full_name }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('profile-thisinh', $ts->id) }}">
                                {{$ts->full_name}}
                            </a>
                        </h5>
                        <p class="card-text">
                            <div>SBD:{{$ts->so_bao_danh}}</div>
                            <div>{{$ts->namhocs->ten_nam_hoc}}</div>
                            <div>{{$ts->truongs->ten_truong}}</div>
                        </p>
                        <?php if(!in_array($ts->id, $voteds)) {?>
                            <button class="btn btn-primary btn_vote" data-vote="{{ $ts->id }}">Bình chọn</button>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
<div class="page-pagination text-center">
    {!! $thisinh->withQueryString()->links() !!}
</div>

{{-- @endif --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $( ".logoTruong" ).click(function() {
        var id = $(this).attr("id")
        // var ten = $(this).attr("alt")
        // alert('Id: '+ id +' - Tên: ' + ten);
        window.location.href = window.location.href.replace( /[\?#].*|$/, "?id=" + id);
    });

    //nút bình chọn
    function sendData(url, data, method, callback) {
            return $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: url,
                data: data,
                type: method,
                beforeSend: function () {},
                success: function (response) {
                    callback(response)
                }
            })
        }

        $('.btn_vote').on('click', function(){
            var id = $(this).data('vote');
            sendData('member/do-vote', {thisinh_id:id}, 'POST', function(response){
                if(response.voted && response.session==-1)
                    return alert('Bạn đã bình chọn cho thí sinh này');
                else
                    // return redirect(route('dashboard.index'));route('login');
                    window.location.href = "login";

            })
        })
});
</script>

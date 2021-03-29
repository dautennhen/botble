
<span class="btn_vote" data-vote="1">
    Bình chọn
</span>
 |
<span class="btn_vote" data-vote="2">
    Bình chọn
</span>
@if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes')
    <br />
    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, Theme::partial('comments')) !!}
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
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
                if(response.voted)
                    return alert('Bạn đã voted');

   })
        })
    })
</script>

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

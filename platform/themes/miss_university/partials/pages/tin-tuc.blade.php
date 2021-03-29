{!! Theme::partial('pages/header-blog') !!}


{!! do_shortcode('[featured-posts][/featured-posts]') !!}
{!! do_shortcode('[recent-posts title="Tin tức mới nhất"][/recent-posts]') !!}
{!! do_shortcode('[featured-categories-posts title="Hoạt động"][/featured-categories-posts]') !!}




<?php echo Theme::asset()->container('footer-blog')->scripts(); ?>
<?php
$renderer = Debugbar::getJavascriptRenderer();
echo $renderer->renderHead();
echo $renderer->render();
?>

<div id="back2top"><i class="fas fa-angle-up"></i></div>

<!-- JS Library-->


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

</body>
</html>


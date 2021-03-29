<footer>
    <div class="container">
        <div class="row justify-content-center justify-content-lg-end">
{{--            <div class="col-12 col-md-2">--}}
{{--            </div>--}}
            <div class="col-auto col-sm-auto">
                <img src="{{ Theme::asset()->url('dist/images/missuni_logo_full.png') }}" class="img-fluid footer-logo">
            </div>
            <div class="col-auto offset-md-1 col-sm col-md-6">
                <div class="row">
                    <div class="col-6 col-sm-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/danh-sach-thi-sinh">Thí sinh</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Thử thách</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/tin-tuc">Tin tức</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dang-ki-du-thi">Đăng ký</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/the-le">Thể lệ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/lien-he">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="social-title">Theo dõi chúng tôi trên </div>
                        <div class="d-flex social-link">
                            <div>
                                <a target="_blank" href="https://www.facebook.com/missuniversityvn"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="copy-right">© 2021 - Bản quyền thuộc về Tập đoàn Giáo dục Nguyễn Hoàng.</div>
            </div>
        </div>
    </div>
</footer>
<?php echo Theme::asset()->container('core-scripts')->scripts(); ?>
<?php //echo Theme::asset()->container('footer-blog')->scripts(); ?>
<?php
// $renderer = Debugbar::getJavascriptRenderer();
// echo $renderer->renderHead();
// echo $renderer->render();
?>

<div id="back2top"><i class="fas fa-angle-up"></i></div>

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


<div class="fullscreen_loading" style="display:none">
    <div class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

{!! Theme::footer() !!}
@stack('scripts')
</body>
</html>

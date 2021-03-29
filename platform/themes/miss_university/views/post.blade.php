{!! Theme::partial('pages/header-blog') !!}

<section class="section pt-50 pb-100">
<div class="container">
<div class="row">
<div class="col-lg-9">
<div class="page-content">

@php Theme::set('section-name', $post->name) @endphp
<article class="post post--single">
    <header class="post__header">
        <h3 class="post__title">{{ $post->name }}</h3>
        <div class="post__meta">
            @if (!$post->categories->isEmpty())
                <span class="post-category"><i class="ion-cube"></i>
                    <a href="{{ $post->categories->first()->url }}">{{ $post->categories->first()->name }}</a>
                </span>
            @endif
            <span class="post__created-at"><i class="ion-clock"></i>{{ $post->created_at->format('M d, Y') }}</span>
            @if ($post->author->username)
                <span class="post__author"><i class="ion-android-person"></i><span>{{ $post->author->getFullName() }}</span></span>
            @endif

            @if (!$post->tags->isEmpty())
                <span class="post__tags"><i class="ion-pricetags"></i>
                    @foreach ($post->tags as $tag)
                        <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                    @endforeach
                </span>
            @endif
        </div>
    </header>
    <div class="post__content">
        @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($post)))
            {!! render_object_gallery($galleries, ($post->categories()->first() ? $post->categories()->first()->name : __('Uncategorized'))) !!}
        @endif
        {!! clean($post->content, 'youtube') !!}
        <div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
    </div>
    <footer class="post__footer footer_blog">
        <div class="row">
            @foreach (get_related_posts($post->id, 2) as $relatedItem)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="post__relate-group @if ($loop->last) post__relate-group--right @endif">
                        <h4 class="relate__title">@if ($loop->first) {{ __('Previous Post') }} @else {{ __('Next Post') }} @endif</h4>
                        <article class="post post--related">
                            <div class="post__thumbnail"><a href="{{ $relatedItem->url }}" class="post__overlay"></a>
                                <img src="{{ RvMedia::getImageUrl($relatedItem->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $relatedItem->name }}">
                            </div>
                            <header class="post__header">
                                <p><a href="{{ $relatedItem->url }}" class="post__title"> {{ $relatedItem->name }}</a></p>
                                <div class="post__meta"><span class="post__created-at">{{ $post->created_at->format('M d, Y') }}</span></div>
                            </header>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </footer>
    @if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes')
        <br />
        {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, Theme::partial('comments')) !!}
    @endif
</article>
</div>
</div>
</div>
</div>
</section>

{!!Theme::asset()->container('footer-blog')->scripts()!!}
<div id="back2top"><i class="fa fa-angle-up"></i></div>

<!-- JS Library-->
{!! Theme::footer() !!}

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


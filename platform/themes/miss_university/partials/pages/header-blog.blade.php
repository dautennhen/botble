<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <?php echo Theme::asset()->container('core-styles-blog')->styles(); ?>


        <style>
            .header-menu li {
                display: inline-block
            }
            :root {
                --color-1st: {{ theme_option('primary_color', '#bead8e') }};
                {{----primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;--}}
            }
        </style>

        <section class="header-banner">
            <img src="{{asset('themes/miss_university/dist/images/imgpsh_fullsize_anim.jpg')}}" alt="" class="img-fluid">
        </section>
        <?php echo Theme::asset()->container('header')->styles(); ?>
    </head>
    <body>
        <header class="header">
            <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark justify-content-between align-items-start">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {!!
                    Menu::renderMenuLocation('header-menu', [
                        'options' => [],
                        'theme'   => true,
                        'view'    =>'custom/menu'
                    ])
                !!}
            </div>
            <div class="right-region">
                @if (is_plugin_active('member'))
                    @if (auth('member')->check())
                        <a rel="nofollow" class="btn btn-link">
                            <i class="fa fa-user"></i> <span class="d-none d-md-inline-block">{{ auth('member')->user()->getFullName() }}</span>
                        </a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" rel="nofollow" class="btn btn-link">
                            <i class="fa fa-sign-out"></i><span class="d-none d-md-inline-block"> {{ __('Logout') }}</span>
                        </a>
                    @else
                        <a href="{{ route('public.member.login') }}" rel="nofollow" class="btn btn-link">
                            <i class="fa fa-sign-in"></i> <span class="d-none d-md-inline-block">{{ __('Login') }}</span>
                        </a>
                    @endif
                    @if (auth('member')->check())
                        <form id="logout-form" action="{{ route('public.member.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                @endif
            </div>
        </nav>
    </div>
        </header>

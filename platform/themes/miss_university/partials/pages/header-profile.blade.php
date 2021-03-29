<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <?php echo Theme::asset()->container('core-styles')->styles(); ?>

        @php
        if (isset($_GET["id"])) {
            $ts = get_ThiSinhById($_GET["id"]);
        }
        \SeoHelper::openGraph()
            ->setUrl(Request::fullUrl())
            ->setType('website')
            ->setSiteName('Miss University 2021')
            ->setTitle('SBD: '. $ts->so_bao_danh . ' - ' .$ts->full_name)
            ->setDescription('Trường: ' . $ts->truongs->ten_truong.' - '.$ts->namhocs->ten_nam_hoc)
            ->setImage(RvMedia::getImageUrl($ts->avatar_toan_than_1));
        @endphp



        <style>
            .header-menu li {
                display: inline-block
            }
            :root {
                --color-1st: {{ theme_option('primary_color', '#bead8e') }};
                --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
            }
        </style>

        {!! Theme::header() !!}
        <?php echo Theme::asset()->container('header')->styles(); ?>
    </head>
    <body>
        <header class="header">
            <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            </nav>
            </div>
        </header>

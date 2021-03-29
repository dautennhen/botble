<?php

use Botble\Miss\Repositories\Interfaces\ThisinhInterface;
use Botble\Miss\Repositories\Interfaces\TruongInterface;

if (!function_exists('get_ListThiSinh')) {
    function get_ListThiSinh($perPage)
    {
        switch (theme_option('round_number')) {
            case 1:
                return app(ThisinhInterface::class)->getAllThiSinh($perPage);
                break;
            case 2:
                return app(ThisinhInterface::class)->getAllThiSinh200($perPage);
                break;
            case 3:
                return app(ThisinhInterface::class)->getAllThiSinh40($perPage);
                break;
            case 4:
                return app(ThisinhInterface::class)->getAllThiSinh35($perPage);
                break;

            default:
            return app(ThisinhInterface::class)->getAllThiSinh($perPage);
                break;
        }
    }
}
if (!function_exists('get_RandomThiSinh')) {
    function get_RandomThiSinh($limit)
    {
        switch (theme_option('round_number')) {
            case 1:
                return app(ThisinhInterface::class)->getRandomThiSinh($limit);
                break;
            case 2:
                return app(ThisinhInterface::class)->getRandomThiSinh200($limit);
                break;
            case 3:
                return app(ThisinhInterface::class)->getRandomThiSinh40($limit);
                break;
            case 4:
                return app(ThisinhInterface::class)->getRandomThiSinh35($limit);
                break;

            default:
                return app(ThisinhInterface::class)->getRandomThiSinh($limit);
                break;
        }
    }
}
if (!function_exists('get_ThiSinhByTruong')) {
    function get_ThiSinhByTruong($id_truong, $perPage)
    {
        switch (theme_option('round_number')) {
            case 1:
                return app(ThisinhInterface::class)->getByTruong($id_truong, $perPage);
                break;
            case 2:
                return app(ThisinhInterface::class)->getByTruong200($id_truong, $perPage);
                break;
            case 3:
                return app(ThisinhInterface::class)->getByTruong40($id_truong, $perPage);
                break;
            case 4:
                return app(ThisinhInterface::class)->getByTruong35($id_truong, $perPage);
                break;

            default:
                return app(ThisinhInterface::class)->getByTruong($id_truong, $perPage);
                break;
        }
    }
}
if (!function_exists('get_ThiSinhById')) {
    function get_ThiSinhById($id)
    {
        return app(ThisinhInterface::class)->getById($id);
    }
}
if (!function_exists('get_ListTruong')) {
    function get_ListTruong()
    {
        return app(TruongInterface::class)->getTruong();
    }
}

if (!function_exists('getVotedThisinh')) {
    function getVotedThisinh()
    {
        return app(ThisinhInterface::class)->getVotedThisinh();
    }
}

if (!function_exists('searchThisinh')) {
    function searchThisinh()
    {
        return app(ThisinhInterface::class)->search();
    }
}

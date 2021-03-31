<?php

namespace Botble\Miss\Providers;

use Botble\Miss\Models\Miss;
use Illuminate\Support\ServiceProvider;
use Botble\Miss\Repositories\Caches\MissCacheDecorator;
use Botble\Miss\Repositories\Eloquent\MissRepository;
use Botble\Miss\Repositories\Interfaces\MissInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Miss\Models\Photo;
use Botble\Miss\Models\Thisinh;
use Illuminate\Routing\Events\RouteMatched;

class MissServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(MissInterface::class, function () {
            return new MissCacheDecorator(new MissRepository(new Miss));
        });

        $this->app->bind(\Botble\Miss\Repositories\Interfaces\TruongInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\TruongCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\TruongRepository(new \Botble\Miss\Models\Truong)
            );
        });

        $this->app->bind(\Botble\Miss\Repositories\Interfaces\NamhocInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\NamhocCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\NamhocRepository(new \Botble\Miss\Models\Namhoc)
            );
        });

        $this->app->bind(\Botble\Miss\Repositories\Interfaces\ThisinhInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\ThisinhCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\ThisinhRepository(new \Botble\Miss\Models\Thisinh)
            );
        });
        $this->app->bind(\Botble\Miss\Repositories\Interfaces\PhotoInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\PhotoCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\PhotoRepository(new \Botble\Miss\Models\Photo)
            );
        });
        $this->app->bind(\Botble\Miss\Repositories\Interfaces\ThachthucInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\ThachthucCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\ThachthucRepository(new \Botble\Miss\Models\Thachthuc)
            );
        });
        $this->app->bind(\Botble\Miss\Repositories\Interfaces\Ts1000Interface::class, function () {
            return new \Botble\Miss\Repositories\Caches\Ts1000CacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\Ts1000Repository(new \Botble\Miss\Models\Ts1000)
            );
        });
        $this->app->bind(\Botble\Miss\Repositories\Interfaces\HoatdongInterface::class, function () {
            return new \Botble\Miss\Repositories\Caches\HoatdongCacheDecorator(
                new \Botble\Miss\Repositories\Eloquent\HoatdongRepository(new \Botble\Miss\Models\Hoatdong)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        // \Gallery::registerModule([Photo::class]);
        // \Gallery::registerModule([Thisinh::class]);

        $this->setNamespace('plugins/miss')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Miss::class]);
                \Language::registerModule([\Botble\Miss\Models\Truong::class]);
                \Language::registerModule([\Botble\Miss\Models\Namhoc::class]);
                // \Language::registerModule([\Botble\Miss\Models\Thisinh::class]);
                \Language::registerModule([\Botble\Miss\Models\Photo::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-miss',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/miss::miss.name',
                'icon'        => 'fa fa-list',
                'url'         => route('miss.index'),
                'permissions' => ['miss.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-truong',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::truong.name',
                'icon'        => null,
                'url'         => route('truong.index'),
                'permissions' => ['truong.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-namhoc',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::namhoc.name',
                'icon'        => null,
                'url'         => route('namhoc.index'),
                'permissions' => ['namhoc.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-thisinh',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::thisinh.name',
                'icon'        => null,
                'url'         => route('thisinh.index'),
                'permissions' => ['thisinh.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-photo',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::photo.name',
                'icon'        => null,
                'url'         => route('photo.index'),
                'permissions' => ['photo.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-ts1000',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::ts1000.name',
                'icon'        => null,
                'url'         => route('ts1000.index'),
                'permissions' => ['ts1000.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-thachthuc',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::thachthuc.name',
                'icon'        => null,
                'url'         => route('thachthuc.index'),
                'permissions' => ['thachthuc.index'],
            ]);
            
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-hoatdong',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-miss',
                'name'        => 'plugins/miss::hoatdong.name',
                'icon'        => null,
                'url'         => route('hoatdong.index'),
                'permissions' => ['hoatdong.index'],
            ]);
        });
    }
}

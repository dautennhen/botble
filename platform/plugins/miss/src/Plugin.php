<?php

namespace Botble\Miss;

use Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('misses');
        Schema::dropIfExists('truongs');
        Schema::dropIfExists('namhocs');
        Schema::dropIfExists('thisinhs');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('thachthucs');
    }
}

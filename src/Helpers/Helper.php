<?php

namespace Mostafaznv\ReadMore\Helpers;

use Illuminate\Support\Facades\File;

class Helper
{
    /**
     * Return Original config file.
     *
     * @param null $key
     * @return array|mixed
     */
    public static function originalConfig($key = null)
    {
        $path = null;

        if (is_file(base_path('vendor/mostafaznv/readmore/config/config.php')))
            $path = base_path('vendor/mostafaznv/readmore/config/config.php');
        else if (is_file(base_path('packages/mostafaznv/readmore/config/config.php')))
            $path = base_path('packages/mostafaznv/readmore/config/config.php');

        if ($path) {
            $config = File::getRequire(base_path('packages/mostafaznv/readmore/config/config.php'));
            if ($key and isset($config[$key]))
                return $config[$key];
            return $config;
        }
        return [];
    }
}
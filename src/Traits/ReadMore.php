<?php

namespace Mostafaznv\ReadMore\Traits;

use Exception;
use Mostafaznv\ReadMore\ReadMore as ReadMoreBase;

trait ReadMore
{
    /**
     * Boot ReadMore trait.
     *
     * @throws Exception
     */
    public static function bootReadMore()
    {
        if (!isset(self::$readMore) or !isset(self::$readMore['from']) or !isset(self::$readMore['to'])) {
            throw new Exception('Undefined public static $readMore');
        }


        static::saving(function($model) {
            $from = self::$readMore['from'];
            $to = self::$readMore['to'];


            $readMore = new ReadMoreBase();
            $summary = $readMore->generate($model->{$from});

            $model->{$to} = $summary;
        });
    }
}
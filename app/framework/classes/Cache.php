<?php
namespace app\framework\classes;

class Cache
{
    private const CACHE_PREFIX = 'cache_';
    private const CACHE_TIME = '+5 minutes';

    public static function cachePath(string $cacheName, string $content = ''):string
    {
        $path = dirname(__FILE__,2);
        $cacheName = self::CACHE_PREFIX.$cacheName;
        return "{$path}/resources/storage/cache/{$cacheName}.txt";
    }

    public static function get(string $cacheName, callable $callback, int $cacheValidation)
    {
        $cachePath = self::cachePath($cacheName);

        if(!file_exists($cachePath) || strtotime("+ {$cacheValidation} minutes", filemtime($cachePath)) < strtotime('now')){
            file_put_contents($cachePath,json_encode($callback()));
            return $callback();
        }

        return (array)json_decode(file_get_contents($cachePath));
    }

}

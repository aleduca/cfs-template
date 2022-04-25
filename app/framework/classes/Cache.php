<?php
namespace app\framework\classes;

class Cache
{
    private const CACHE_PREFIX = 'cache_';

    public static function cachePath(string $cacheName, string $content = ''):string
    {
        $path = dirname(__FILE__, 2);
        $cacheName = self::CACHE_PREFIX.$cacheName;

        /**
         * Maybe because of the .gitignore file,
         * but the storage and cache folders are not sent to github, so I created them here.
         */
        if (!is_dir("{$path}/resources/storage/cache")) {
            mkdir("{$path}/resources/storage/cache/", 0777, true);
        }
        return "{$path}/resources/storage/cache/{$cacheName}.txt";
    }

    public static function get(string $cacheName, callable $callback, int $cacheTimeExpiration = 5)
    {
        $cachePath = self::cachePath($cacheName);

        if (!file_exists($cachePath) || strtotime("+ {$cacheTimeExpiration} minutes", filemtime($cachePath)) < strtotime('now')) {
            file_put_contents($cachePath, json_encode($callback()));
            return $callback();
        }

        return (array)json_decode(file_get_contents($cachePath));
    }
}

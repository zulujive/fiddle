<?php

class main
{
    public static function ip()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }
    
    public static function store_ip()
    {
        $ip = self::ip();

        $cacheDir = __DIR__ . '/../../../storage/data/cache/rlcache/';
        $cacheFile = $cacheDir . md5($ip);

        if (!file_exists($cacheFile))
        {
            $data = file_get_contents($cacheFile);
            
            $requestData = [
                'ip' => $ip;
                'time' => null;
                'count' => null;
            ];
        }
    }
}
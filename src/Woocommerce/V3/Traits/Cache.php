<?php

namespace C14r\Woocommerce\V3\Traits;

trait Cache
{
    public function cache(?int $seconds = null): object|array
    {
        $seconds = is_null($seconds) ? config('woocommerce.cache.ttl', 300) : $seconds;
        $key = $this->getCacheKey();

        if(Cache::has($key))
        {
            return Cache::get($key);
        }

        $data = $this->get();

        Cache::put($key, $data, $seconds);

        return $data;
    }

    public function cacheAll(?int $seconds = null, int $per_page = 100): object|array
    {
        $seconds = is_null($seconds) ? config('woocommerce.cache.ttl', 300) : $seconds;
        $key = $this->getCacheKey();

        if(Cache::has($key))
        {
            return Cache::get($key);
        }

        $data = $this->all($per_page);

        Cache::put($key, $data, $seconds);

        return $data;
    }

    /**
     * Generates a cache-key from the current url
     * 
     * @return string
     */
    private function getCacheKey(): string
    {
        $prefix = config('woocommerce.cache.prefix', 'c14r_woo_');

        return $prefix.md5($this->buildUrl());
    }
}
<?php

namespace C14r\Woocommerce\V3\Traits;

/**
 * Trait Cache
 *
 * Provides methods for caching API responses.
 */
trait Cache
{
    /**
     * Caches the API response.
     *
     * @param int|null $seconds The cache duration in seconds.
     *
     * @return object|array The cached data.
     */
    public function cache(?int $seconds = null): object|array
    {
        $seconds = is_null($seconds) ? config('woocommerce.cache.ttl', 300) : $seconds;
        $key = $this->getCacheKey();

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $data = $this->get();

        Cache::put($key, $data, $seconds);

        return $data;
    }

    /**
     * Caches all items.
     *
     * @param int|null $seconds The cache duration in seconds.
     * @param int $per_page The number of items per page.
     *
     * @return object|array The cached data.
     */
    public function cacheAll(?int $seconds = null, int $per_page = 100): object|array
    {
        $seconds = is_null($seconds) ? config('woocommerce.cache.ttl', 300) : $seconds;
        $key = $this->getCacheKey();

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $data = $this->all($per_page);

        Cache::put($key, $data, $seconds);

        return $data;
    }

    /**
     * Generates a cache key based on the current URL.
     *
     * @return string The cache key.
     */
    private function getCacheKey(): string
    {
        $prefix = config('woocommerce.cache.prefix', 'c14r_woo_');

        return $prefix . md5($this->buildUrl());
    }
}

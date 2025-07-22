<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheTrait
{
    /**
     * Clear all frontend caches
     */
    public function clearFrontendCaches()
    {
        $cacheKeys = [
            'hero_data',
            'hero_professions',
            'services',
            'portfolios',
            'portfolio_categories',
            'education',
            'experiences',
            'skills',
            'socials',
            'certificates',
            'about',
            'blogs',
            'pricing_plans',
            'services_page'
        ];
        

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        // Clear paginated caches (blogs, portfolios)
        $this->clearPaginatedCaches();
    }

    /**
     * Clear paginated caches
     */
    public function clearPaginatedCaches()
    {
        // Clear blog-related caches
        $this->clearCacheByPattern('blogs_index_*');
        $this->clearCacheByPattern('blog_show_*');

        // Clear portfolio-related caches
        $this->clearCacheByPattern('portfolios_index_*');
    }

    /**
     * Clear cache by pattern (for Redis and Memcached)
     */
    public function clearCacheByPattern($pattern)
    {
        if (Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
            $redis = Cache::getStore()->getRedis();
            $keys = $redis->keys('*' . str_replace('*', '*', $pattern) . '*');
            foreach ($keys as $key) {
                $redis->del($key);
            }
        } elseif (Cache::getStore() instanceof \Illuminate\Cache\MemcachedStore) {
            // For Memcached, we need to clear all and let it rebuild
            Cache::flush();
        }
    }

    /**
     * Clear specific model caches
     */
    public function clearModelCaches($model)
    {
        switch ($model) {
            case 'blog':
                Cache::forget('blogs');
                $this->clearCacheByPattern('blogs_index_*');
                $this->clearCacheByPattern('blog_show_*');
                break;
            case 'portfolio':
                Cache::forget('portfolios');
                Cache::forget('portfolio_categories');
                $this->clearCacheByPattern('portfolios_index_*');
                break;
            case 'service':
                Cache::forget('services');
                Cache::forget('services_page');
                break;
            case 'hero':
                Cache::forget('hero_data');
                Cache::forget('hero_professions');
                break;
            case 'about':
                Cache::forget('about');
                break;
            case 'education':
                Cache::forget('education');
                break;
            case 'experience':
                Cache::forget('experiences');
                break;
            case 'skill':
                Cache::forget('skills');
                break;
            case 'certificate':
                Cache::forget('certificates');
                break;
            case 'pricing':
                Cache::forget('pricing_plans');
                break;
            case 'social':
                Cache::forget('socials');
                break;
        }
    }
} 
<?php

namespace App\Http\Middleware;

use App\Filters\FilterManager;
use App\Filters\PropertyFilter;
use Illuminate\Http\Request;

class Filter
{
    public function handle(Request $request, \Closure $next)
    {

        $routeName = null;

        try {
            $routeName = request()->route()->getName();
        } catch (\Throwable $exception) {

        }

        // На странице каталога подключаем фильтры
        if ($routeName == 'catalog') {
            app(FilterManager::class)->registerFilters([
                new PropertyFilter()
            ]);
        }

        return $next($request);

    }
}
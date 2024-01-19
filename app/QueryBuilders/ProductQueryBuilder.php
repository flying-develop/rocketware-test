<?php

namespace App\QueryBuilders;

use App\Filters\FilterManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Pipeline;

class ProductQueryBuilder extends Builder
{

    public function filtered()
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(app(FilterManager::class)->items())
            ->thenReturn();
    }

}
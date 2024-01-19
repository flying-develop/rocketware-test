<?php

namespace App\Filters;

use App\Traits\Makeable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PropertyFilter
{
    public function __invoke(Builder $query, $next)
    {

        $properties = request('properties', []);
        $query->when($properties, function (Builder $mainQuery) use ($properties) {
            foreach ($properties as $property => $values) {
                if ($values) {
                    $mainQuery->whereHas('properties', function (Builder $propertyQuery) use ($property, $values) {
                        $propertyQuery->where('property_id', $property);
                        $propertyQuery->whereIn('value', is_array($values) ? $values : [$values]);
                    });
                }
            }
        });

        return $next($query);
    }

}
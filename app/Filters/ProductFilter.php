<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    protected static function filterCostFrom(string $requestField, Builder $query)
    {
        return $query->where('cost', '>', $requestField);
    }

    protected static function filterCostTo(string $requestField, Builder $query)
    {
        return $query->where('cost', '<', $requestField);
    }

    protected static function filterManufacture(string $requestField, Builder $query)
    {
        return $query->where('manufacture', 'like', "%{$requestField}%");
    }

    public static function setFieldsFilters(): array
    {
        return ['costFrom' => 'filterCostFrom', 'costTo' => 'filterCostTo', 'manufacture' => 'filterManufacture'];
    }
}

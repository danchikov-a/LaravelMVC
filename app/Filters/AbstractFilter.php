<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

abstract class AbstractFilter
{
    final public static function filter(string $model, Request $request): Collection
    {
        $fieldsFilters = call_user_func([get_called_class(), 'setFieldsFilters']);
        $model = new $model();
        $query = $model::query();

        foreach ($fieldsFilters as $field => $filter) {
            if ($request->filled($field)) {
                $query = call_user_func([get_called_class(), $filter], $request->{$field}, $query);
            }
        }

        return $query->get();
    }

    abstract public static function setFieldsFilters();
}

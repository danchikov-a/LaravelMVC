<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SortManager
{
    private const FIELD_PARAM = 0;
    private const SORT_TYPE_PARAM = 1;
    private const AMOUNT_OF_WORDS_IN_PARAM = 2;

    public static function sort(Collection $collection, Request $request): Collection
    {
        if ($request->filled('sort')) {
            $fieldAndSortType = explode("_", $request->sort);

            if (count($fieldAndSortType) == self::AMOUNT_OF_WORDS_IN_PARAM) {
                $field = $fieldAndSortType[self::FIELD_PARAM];
                $sortType = $fieldAndSortType[self::SORT_TYPE_PARAM];

                return match ($sortType) {
                    'asc' => $collection->sortBy($field),
                    'desc' => $collection->sortByDesc($field),
                    default => $collection,
                };
            }

            return $collection;
        }

        return $collection;
    }
}

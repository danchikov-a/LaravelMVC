<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Collection;

class SortManager
{
    private const FIELD_PARAM = 0;
    private const SORT_TYPE_PARAM = 1;
    private const AMOUNT_OF_WORDS_IN_PARAM = 2;

    public static function sort(Collection $collection, ?string $sortParam): Collection
    {
        if ($sortParam != null) {
            $fieldAndSortType = explode("_", $sortParam);

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

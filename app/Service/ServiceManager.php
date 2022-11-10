<?php

namespace App\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceManager
{
    public static function save(array $input): void
    {
        $product = Service::create($input);

        $product->save();
    }

    public static function destroy(int $id): void
    {
        Service::destroy($id);
    }

    public static function update(int $id, array $input): void
    {
        Service::where('id', $id)->update($input);
    }

    public static function getAll(): Collection
    {
        return Service::all();
    }
}

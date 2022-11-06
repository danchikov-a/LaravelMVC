<?php

namespace App\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function save(array $input): void
    {
        $product = Service::create($input);

        $product->save();
    }

    public function destroy(int $id): void
    {
        Service::destroy($id);
    }

    public function update(int $id, array $input): void
    {
        Service::where('id', $id)->update($input);
    }

    public function getAll(): Collection
    {
        return Service::all();
    }
}

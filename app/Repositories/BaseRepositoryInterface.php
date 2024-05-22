<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 */
interface BaseRepositoryInterface
{
    public function create(array $attributes);

    public function find(int $id);

    public function update(int $id, array $attributes);

    public function findOneBy(string $key, $value): ?Model;
}

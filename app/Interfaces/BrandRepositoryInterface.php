<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;

interface BrandRepositoryInterface
{
    public function getAll(array $filters): ?LengthAwarePaginator;

    public function save(array $data): ?Brand;

    public function getById(int $id): ?Brand;

    public function update(array $data,int $id): ?Brand;

    public function delete(int $id): ?object;
}

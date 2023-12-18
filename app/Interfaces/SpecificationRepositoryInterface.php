<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Specification;
use Illuminate\Pagination\LengthAwarePaginator;

interface SpecificationRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator;

    public function save(array $data): ?Specification;

    public function getById(int $id): ?Specification;

    public function update(array $data,int $id): ?Specification;

    public function delete(int $id): ?object;
}

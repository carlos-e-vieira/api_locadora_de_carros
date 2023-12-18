<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Car;
use Illuminate\Pagination\LengthAwarePaginator;

interface CarRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator;

    public function save(array $data): ?Car;

    public function getById(int $id): ?Car;

    public function update(array $data,int $id): ?Car;

    public function delete(int $id): ?object;
}

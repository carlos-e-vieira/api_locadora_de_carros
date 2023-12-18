<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

interface CustomerRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator;

    public function save(array $data): ?Customer;

    public function getById(int $id): ?Customer;

    public function update(array $data,int $id): ?Customer;

    public function delete(int $id): ?object;
}

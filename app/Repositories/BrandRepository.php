<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository extends AbstractRepository
{
    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    protected function applyFilters($query, array $filters)
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? ''
        ];

        if (!empty($filtersQuery['name'])) {
            $query->where('name', 'LIKE', '%' . $filtersQuery['name'] . '%');
        }
    }
}

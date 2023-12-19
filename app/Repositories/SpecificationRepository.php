<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Specification;

class SpecificationRepository extends AbstractRepository
{
    public function __construct(Specification $specification)
    {
        parent::__construct($specification);
    }

    protected function applyFilters($query, array $filters)
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? '',
            'doors' => $filters['doors'] ?? '',
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%'],
                ['doors', 'LIKE', '%' . $filtersQuery['doors'] . '%'],
            ]);
        }
    }
}

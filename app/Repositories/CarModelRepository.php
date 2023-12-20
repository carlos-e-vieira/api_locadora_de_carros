<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CarModel;

class CarModelRepository extends AbstractRepository
{
    public function __construct(CarModel $carModel)
    {
        parent::__construct($carModel);
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

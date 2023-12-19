<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Car;

class CarRepository extends AbstractRepository
{
    public function __construct(Car $car)
    {
        parent::__construct($car);
    }

    protected function applyFilters($query, array $filters)
    {
        $filtersQuery = [
            'plate' => $filters['plate'] ?? ''
        ];

        if (!empty($filtersQuery['plate'])) {
            $query->where('plate', 'LIKE', '%' . $filtersQuery['name'] . '%');
        }
    }
}

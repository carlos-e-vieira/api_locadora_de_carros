<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends AbstractRepository
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    protected function applyFilters($query, array $filters)
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? '',
            'cpf' => $filters['cpf'] ?? '',
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%'],
                ['cpf', 'LIKE', '%' . $filtersQuery['cpf'] . '%'],
            ]);
        }
    }
}

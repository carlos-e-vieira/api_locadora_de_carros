<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class CustomerRepository implements CustomerRepositoryInterface
{
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAll(array $filters): ?LengthAwarePaginator
    {
        $query = $this->customer::query();

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
    
        $customers = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return $customers;
    }

    public function save(array $data): ?Customer
    {
        try {
            $customer = $this->customer->create($data);

            return $customer;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar os dados do cliente: ' . $e->getMessage());

            return null;
        }
    }

    public function getById(int $id): ?Customer
    {
        try {
            return $this->customer->find($id);
        } catch (\Exception $e) {
            Log::error('Erro ao encontrar os dados do cliente: ' . $e->getMessage());

            return null;
        }
    }

    public function update(array $data,int $id): ?Customer
    {
        try {
            $this->customer->findOrFail($id)->update($data);

            return $this->getById($id);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar os dados do cliente: ' . $e->getMessage());

            return null;
        }
    }

    public function delete(int $id): ?object
    {
        try {
            $this->customer->findOrFail($id)->delete();

            return (object) 'Registro deletado com sucesso';
        } catch (\Exception $e) {
            Log::error('Erro ao deletar os dados do cliente: ' . $e->getMessage());

            return null;
        }
    }
}

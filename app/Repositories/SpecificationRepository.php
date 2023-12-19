<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\SpecificationRepositoryInterface;
use App\Models\Specification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class SpecificationRepository implements SpecificationRepositoryInterface
{
    private Specification $specification;

    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function getAll(array $filters): ?LengthAwarePaginator
    {
        $query = $this->specification::query();

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
    
        $specifications = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return $specifications;
    }

    public function save(array $data): ?Specification
    {
        try {
            $specification = $this->specification->create($data);

            return $specification;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar os dados da especificação: ' . $e->getMessage());

            return null;
        }
    }

    public function getById(int $id): ?Specification
    {
        try {
            return $this->specification->find($id);
        } catch (\Exception $e) {
            Log::error('Erro ao encontrar os dados da especificação: ' . $e->getMessage());

            return null;
        }
    }

    public function update(array $data,int $id): ?Specification
    {
        try {
            $this->specification->findOrFail($id)->update($data);

            return $this->getById($id);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar os dados da especificação: ' . $e->getMessage());

            return null;
        }
    }

    public function delete(int $id): ?object
    {
        try {
            $this->specification->findOrFail($id)->delete();

            return (object) 'Registro deletado com sucesso';
        } catch (\Exception $e) {
            Log::error('Erro ao deletar os dados da especificação: ' . $e->getMessage());

            return null;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BrandRepository implements BrandRepositoryInterface
{
    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function getAll(array $filters): ?LengthAwarePaginator
    {
        $query = $this->brand::query();

        $filtersQuery = [
            'name' => $filters['name'] ?? ''
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%']
            ]);
        }
    
        $brands = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return $brands;
    }

    public function save(array $data): ?Brand
    {
        try {
            $brand = $this->brand->create($data);

            return $brand;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar os dados da marca: ' . $e->getMessage());

            return null;
        }
    }

    public function getById(int $id): ?Brand
    {
        try {
            return $this->brand->find($id);
        } catch (\Exception $e) {
            Log::error('Erro ao encontrar os dados da marca: ' . $e->getMessage());

            return null;
        }
    }

    public function update(array $data,int $id): ?Brand
    {
        try {
            $this->brand->findOrFail($id)->update($data);

            return $this->getById($id);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar os dados da marca: ' . $e->getMessage());

            return null;
        }
    }

    public function delete(int $id): ?object
    {
        try {
            $this->brand->findOrFail($id)->delete();

            return (object) 'Registro deletado com sucesso';
        } catch (\Exception $e) {
            Log::error('Erro ao deletar os dados da marca: ' . $e->getMessage());

            return null;
        }
    }
}

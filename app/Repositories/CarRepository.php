<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class CarRepository implements CarRepositoryInterface
{
    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function getAll(array $filters): LengthAwarePaginator
    {
        $query = $this->car::query();

        $filtersQuery = [
            'plate' => $filters['plate'] ?? ''
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['plate', 'LIKE', '%' . $filtersQuery['plate'] . '%']
            ]);
        }
    
        $cars = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return $cars;
    }

    public function save(array $data): ?Car
    {
        try {
            $car = $this->car->create($data);

            return $car;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar os dados do veiculo: ' . $e->getMessage());

            return null;
        }
    }

    public function getById(int $id): ?Car
    {
        try {
            return $this->car->find($id);
        } catch (\Exception $e) {
            Log::error('Erro ao encontrar os dados do veiculo: ' . $e->getMessage());

            return null;
        }
    }

    public function update(array $data,int $id): ?Car
    {
        try {
            $this->car->findOrFail($id)->update($data);

            return $this->getById($id);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar os dados do veiculo: ' . $e->getMessage());

            return null;
        }
    }

    public function delete(int $id): ?object
    {
        try {
            $this->car->findOrFail($id)->delete();

            return (object) 'Registro deletado com sucesso';
        } catch (\Exception $e) {
            Log::error('Erro ao deletar os dados do veiculo: ' . $e->getMessage());

            return null;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CarRepositoryInterface;
use App\Repositories\CarRepository;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepositoryInterface $carRepositoryInterface)
    {
        $this->carRepository = $carRepositoryInterface;
    }

    public function getAllCarsPaginated(array $filters): ?object
    {
        return $this->handleResult($this->carRepository->getAll($filters));
    }

    public function saveCar(array $data): ?object
    {
        return $this->handleResult($this->carRepository->save($data));
    }

    public function getCarById(int $id): ?object
    {
        return $this->handleResult($this->carRepository->getById($id));
    }

    public function updateCar(array $data, int $id): ?object
    {        
        return $this->handleResult($$this->carRepository->update($data, $id));
    }

    public function deleteCar(int $id): ?object
    {
        return $this->handleResult($this->carRepository->delete($id));
    }

    private function handleResult(?object $result): ?object
    {
        return !$result ? null : $result;
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\CarExceptions;
use App\Interfaces\CarRepositoryInterface;

class CarService
{
    private CarRepositoryInterface $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getAllCarsPaginated(array $filters): object
    {
        $cars = $this->carRepository->getAll($filters);

        $this->checkEmpty($cars, 'Erro ao listar todos os registros de carros');

        return $cars;
    }

    public function saveCar(array $data): object
    {
        $car = $this->carRepository->save($data);

        $this->checkEmpty($car, 'Erro ao cadastrar os dados do carro');

        return $car;
    }

    public function getCarById(int $id): object
    {
        $car = $this->carRepository->getById($id);

        $this->checkEmpty($car, 'Erro ao listar os dados do carro');

        return $car;
    }

    public function updateCar(array $data, int $id): object
    {        
        $car = $this->carRepository->update($data, $id);

        $this->checkEmpty($car, 'Erro ao atualizar os dados do carro');

        return $car;
    }

    public function deleteCar(int $id): object
    {
        $message = $this->carRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados do carro');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new CarExceptions($errorMessage);
        }
    }
}

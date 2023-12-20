<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\CarModelExceptions;
use App\Repositories\CarModelRepository;

class CarModelService
{
    private CarModelRepository $carModelRepository;

    public function __construct(CarModelRepository $carModelRepository)
    {
        $this->carModelRepository = $carModelRepository;
    }

    public function getAllCarModelsPaginated(array $filters): object
    {
        $carModels = $this->carModelRepository->getAll($filters);

        $this->checkEmpty($carModels, 'Erro ao listar todos os registros de modelos');

        return $carModels;
    }

    public function saveCarModel(array $data): object
    {
        $carModel = $this->carModelRepository->save($data);

        $this->checkEmpty($carModel, 'Erro ao cadastrar os dados do modelo');

        return $carModel;
    }

    public function getCarModelById(int $id): object
    {
        $carModel = $this->carModelRepository->getById($id);

        $this->checkEmpty($carModel, 'Erro ao listar os dados do modelo');

        return $carModel;
    }

    public function updateCarModel(array $data, int $id): object
    {        
        $carModel = $this->carModelRepository->update($data, $id);

        $this->checkEmpty($carModel, 'Erro ao atualizar os dados do modelo');

        return $carModel;
    }

    public function deleteCarModel(int $id): object
    {
        $message = $this->carModelRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados do modelo');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new CarModelExceptions($errorMessage);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SpecificationExceptions;
use App\Interfaces\SpecificationRepositoryInterface;

class SpecificationService
{
    private SpecificationRepositoryInterface $specificationRepository;

    public function __construct(SpecificationRepositoryInterface $specificationRepository)
    {
        $this->specificationRepository = $specificationRepository;
    }

    public function getAllSpecificationsPaginated(array $filters): object
    {
        $specifications = $this->specificationRepository->getAll($filters);

        $this->checkEmpty($specifications, 'Erro ao listar todos os registros de especificações');

        return $specifications;
    }

    public function saveSpecification(array $data): object
    {
        $specification = $this->specificationRepository->save($data);

        $this->checkEmpty($specification, 'Erro ao cadastrar os dados da especificação');

        return $specification;
    }

    public function getSpecificationById(int $id): object
    {
        $specification = $this->specificationRepository->getById($id);

        $this->checkEmpty($specification, 'Erro ao listar os dados da especificação');

        return $specification;
    }

    public function updateSpecification(array $data, int $id): object
    {        
        $specification = $this->specificationRepository->update($data, $id);

        $this->checkEmpty($specification, 'Erro ao atualizar os dados da especificação');

        return $specification;
    }

    public function deleteSpecification(int $id): object
    {
        $message = $this->specificationRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados da especificação');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new SpecificationExceptions($errorMessage);
        }
    }
}

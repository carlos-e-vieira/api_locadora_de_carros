<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\SpecificationRepositoryInterface;
use App\Repositories\SpecificationRepository;

class SpecificationService
{
    private SpecificationRepository $specificationRepository;

    public function __construct(SpecificationRepositoryInterface $specificationRepositoryInterface)
    {
        $this->specificationRepository = $specificationRepositoryInterface;
    }

    public function getAllSpecificationsPaginated(array $filters): ?object
    {
        return $this->handleResult($this->specificationRepository->getAll($filters));
    }

    public function saveSpecification(array $data): ?object
    {
        return $this->handleResult($this->specificationRepository->save($data));
    }

    public function getSpecificationById(int $id): ?object
    {
        return $this->handleResult($this->specificationRepository->getById($id));
    }

    public function updateSpecification(array $data, int $id): ?object
    {        
        return $this->handleResult($$this->specificationRepository->update($data, $id));
    }

    public function deleteSpecification(int $id): ?object
    {
        return $this->handleResult($this->specificationRepository->delete($id));
    }

    private function handleResult(?object $result): ?object
    {
        return !$result ? null : $result;
    }
}

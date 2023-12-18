<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\BrandRepositoryInterface;
use App\Repositories\BrandRepository;

class BrandService
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepositoryInterface)
    {
        $this->brandRepository = $brandRepositoryInterface;
    }

    public function getAllBrandsPaginated(array $filters): ?object
    {
        return $this->handleResult($this->brandRepository->getAll($filters));
    }

    public function saveBrand(array $data): ?object
    {
        return $this->handleResult($this->brandRepository->save($data));
    }

    public function getBrandById(int $id): ?object
    {
        return $this->handleResult($this->brandRepository->getById($id));
    }

    public function updateBrand(array $data, int $id): ?object
    {        
        return $this->handleResult($$this->brandRepository->update($data, $id));
    }

    public function deleteBrand(int $id): ?object
    {
        return $this->handleResult($this->brandRepository->delete($id));
    }

    private function handleResult(?object $result): ?object
    {
        return !$result ? null : $result;
    }
}

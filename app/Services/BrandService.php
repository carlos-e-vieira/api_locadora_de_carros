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
        $brands = $this->brandRepository->getAll($filters);

        return $this->handleResult($brands);
    }

    public function saveBrand(array $data): ?object
    {
        $brand = $this->brandRepository->save($data);

        return $this->handleResult($brand);
    }

    public function getBrandById(int $id): ?object
    {
        $brand = $this->brandRepository->getById($id);

        return $this->handleResult($brand);
    }

    public function updateBrand(array $data, int $id): ?object
    {
        $brand = $this->brandRepository->update($data, $id);
        
        if ($brand === false) {
            return null;
        }

        return $this->getBrandById($id);
    }

    public function deleteBrand(int $id): bool
    {
        $brandDeleted = $this->brandRepository->delete($id);

        if ($brandDeleted === false) {
            return false;
        }

        return true;
    }

    private function handleResult(?object $result): ?object
    {
        if (!$result) {
            return null;
        }

        return $result;
    }
}

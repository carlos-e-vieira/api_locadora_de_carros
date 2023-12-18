<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\BrandExceptions;
use App\Interfaces\BrandRepositoryInterface;
use App\Repositories\BrandRepository;

class BrandService
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepositoryInterface)
    {
        $this->brandRepository = $brandRepositoryInterface;
    }

    public function getAllBrandsPaginated(array $filters): object
    {
        $brands = $this->brandRepository->getAll($filters);

        if ($brands === null) {
            throw new BrandExceptions(__FUNCTION__);
        }

        return $brands;
    }

    public function saveBrand(array $data): object
    {
        $brand = $this->brandRepository->save($data);

        if ($brand === null) {
            throw new BrandExceptions(__FUNCTION__);
        }

        return $brand;
    }

    public function getBrandById(int $id): object
    {
        $brand = $this->brandRepository->getById($id);

        if ($brand === null) {
            throw new BrandExceptions(__FUNCTION__);
        }

        return $brand;
    }

    public function updateBrand(array $data, int $id): object
    {        
        $brand = $this->brandRepository->update($data, $id);

        if ($brand === null) {
            throw new BrandExceptions(__FUNCTION__);
        }

        return $brand;
    }

    public function deleteBrand(int $id): object
    {
        $message = $this->brandRepository->delete($id);

        if ($message === null) {
            throw new BrandExceptions(__FUNCTION__);
        }

        return $message;
    }
}

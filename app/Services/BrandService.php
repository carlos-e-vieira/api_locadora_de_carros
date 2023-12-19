<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\BrandExceptions;
use App\Repositories\BrandRepository;

class BrandService
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAllBrandsPaginated(array $filters): object
    {
        $brands = $this->brandRepository->getAll($filters);

        $this->checkEmpty($brands, 'Erro ao listar todos os registros de marcas');

        return $brands;
    }

    public function saveBrand(array $data): object
    {
        $brand = $this->brandRepository->save($data);

        $this->checkEmpty($brand, 'Erro ao cadastrar os dados da marca');

        return $brand;
    }

    public function getBrandById(int $id): object
    {
        $brand = $this->brandRepository->getById($id);

        $this->checkEmpty($brand, 'Erro ao listar os dados da marca');

        return $brand;
    }

    public function updateBrand(array $data, int $id): object
    {        
        $brand = $this->brandRepository->update($data, $id);

        $this->checkEmpty($brand, 'Erro ao atualizar os dados da marca');

        return $brand;
    }

    public function deleteBrand(int $id): object
    {
        $message = $this->brandRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados da marca');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new BrandExceptions($errorMessage);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->customerRepository = $customerRepositoryInterface;
    }

    public function getAllCustomersPaginated(array $filters): ?object
    {
        return $this->handleResult($this->customerRepository->getAll($filters));
    }

    public function saveCustomer(array $data): ?object
    {
        return $this->handleResult($this->customerRepository->save($data));
    }

    public function getCustomerById(int $id): ?object
    {
        return $this->handleResult($this->customerRepository->getById($id));
    }

    public function updateCustomer(array $data, int $id): ?object
    {        
        return $this->handleResult($$this->customerRepository->update($data, $id));
    }

    public function deleteCustomer(int $id): ?object
    {
        return $this->handleResult($this->customerRepository->delete($id));
    }

    private function handleResult(?object $result): ?object
    {
        return !$result ? null : $result;
    }
}

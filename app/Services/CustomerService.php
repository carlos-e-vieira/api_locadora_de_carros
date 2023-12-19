<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\CustomerExceptions;
use App\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomersPaginated(array $filters): object
    {
        $customers = $this->customerRepository->getAll($filters);

        $this->checkEmpty($customers, 'Erro ao listar todos os registros de clientes');

        return $customers;
    }

    public function saveCustomer(array $data): object
    {
        $customer = $this->customerRepository->save($data);

        $this->checkEmpty($customer, 'Erro ao cadastrar os dados do cliente');

        return $customer;
    }

    public function getCustomerById(int $id): object
    {
        $customer = $this->customerRepository->getById($id);

        $this->checkEmpty($customer, 'Erro ao listar os dados do cliente');

        return $customer;
    }

    public function updateCustomer(array $data, int $id): object
    {        
        $customer = $this->customerRepository->update($data, $id);

        $this->checkEmpty($customer, 'Erro ao atualizar os dados do cliente');

        return $customer;
    }

    public function deleteCustomer(int $id): object
    {
        $message = $this->customerRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados do cliente');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new CustomerExceptions($errorMessage);
        }
    }
}

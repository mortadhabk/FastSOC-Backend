<?php

namespace App\Repositories;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * Get all customers.
     *
     * @return array
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Get a customer by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * Store a new customer.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Customer::create($data);
    }

    /**
     * Update a customer.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(array $data ,$id)
    {
        return Customer::whereId($id)->update($data);
    }

    /**
     * Delete a customer.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        Customer::destroy($id);
    }
}

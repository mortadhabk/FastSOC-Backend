<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{


    /**
     * Get all Order.
     *
     * @return array
     */
    public function index()
    {
        return Order::with(['customer', 'offer', 'vendors'])->get();
    }


    /**
     * Store a new Order.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Order::create($data);
    }


    /**
     * Delete a customer.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        Order::destroy($id);
    }
    
}

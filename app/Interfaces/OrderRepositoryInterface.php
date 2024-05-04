<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    
    public function index();
    public function store(array $data);
    public function delete($id);

}

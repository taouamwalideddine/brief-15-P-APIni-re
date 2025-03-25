<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function updateStatus(int $id, string $status);
    public function delete(int $id);
    public function getOrderItems(int $orderId);
}

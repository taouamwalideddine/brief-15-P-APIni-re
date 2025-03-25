<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function updateStatus(int $id, string $status);
    public function delete(int $id);
}

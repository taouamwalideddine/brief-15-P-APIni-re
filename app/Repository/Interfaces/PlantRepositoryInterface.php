<?php

namespace App\Repositories\Interfaces;

interface PlantRepositoryInterface
{
    public function getAll();
    public function getBySlug(string $slug);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

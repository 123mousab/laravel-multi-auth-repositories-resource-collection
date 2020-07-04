<?php


namespace App\Repositories;

interface CusotmerRepositoryInterface
{
    public function all();

    public function findById($customerId);

    public function update($customerId);

    public function delete($customerId);
}

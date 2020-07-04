<?php

namespace App\Repositories;


use App\Customer;
use App\Http\Resources\CustomeResorce;
use function PHPSTORM_META\map;

class  CusotmerRepository implements CusotmerRepositoryInterface
{
    public function all()
    {
        return $customers = CustomeResorce::collection(Customer::query()
            ->orderBy('name')
            ->where('active', 0)
            ->first())->map->serializeForList();
    }

    public function findById($customerId)
    {
        return Customer::query()
            ->where('id', $customerId)
            ->where('active', 1)
            ->firstOrFail()
            ->format();
    }

    public function update($customerId)
    {
        $customer = Customer::query()
            ->where('id', $customerId)
            ->firstOrFail();
        $customer->update(request()->only('name'));

        return $customer->query()
            ->where('id', $customerId)
            ->firstOrFail()
            ->format();
    }

    public function delete($customerId)
    {
        Customer::query()
            ->where('id', $customerId)
            ->delete();
    }
}

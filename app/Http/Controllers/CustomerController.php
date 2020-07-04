<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Repositories\CusotmerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @var $cusotmerRepository
     */
    private $cusotmerRepository;

    public function __construct(CusotmerRepositoryInterface $cusotmerRepository)
    {
        $this->cusotmerRepository = $cusotmerRepository;
    }

    public function index()
    {
        $customers = $this->cusotmerRepository->all();
        return $customers;
    }

    public function show($customerId)
    {
        $customer = $this->cusotmerRepository->findById($customerId);
        return $customer;
    }

    public function update($customerId)
    {
        $customer = $this->cusotmerRepository->update($customerId);
        return $customer;
    }

    public function delete($customerId)
    {
        $this->cusotmerRepository->delete($customerId);
        return 'Success Delete';
    }
}

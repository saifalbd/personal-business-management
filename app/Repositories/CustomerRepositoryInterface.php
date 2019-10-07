<?php


namespace App\Repositories;

use App\Model\Customer;
use App\Model\Order;
use stdClass;

interface CustomerRepositoryInterface
{

    public function makeCustomer(array $arg);

    public function toJson();
    public function toArray();
    public function initCustomer($name,$phone);


}
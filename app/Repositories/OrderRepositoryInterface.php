<?php


namespace App\Repositories;


use App\Model\Order;

interface OrderRepositoryInterface
{
    public function updateOrder(array $resource,Order $order);
    public function make(array $orderValues, array $payValues = []);


}

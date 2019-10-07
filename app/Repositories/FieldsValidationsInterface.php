<?php


namespace App\Repositories;


interface FieldsValidationsInterface
{

    public function getName(array $arg);
    public function getPhone(array $arg);
    public function getNumber(array $arg);
    public function getCity(array $arg,bool $prevent=false);
    public function getComment(array $arg,bool $prevent=false);
    public function getTariffId(array $arg);
    public function getAmount(array $arg);
    public function getType(array $arg);
    public function getProfit(array $arg,bool $prevent=false);
    public function getBill(array $arg,bool $prevent=false);
    public function getOrder(array $arg);
    public function getCustomer(array $arg);

}
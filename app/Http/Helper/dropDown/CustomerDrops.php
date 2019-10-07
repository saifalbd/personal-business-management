<?php


namespace App\Http\Helper\dropDown;


use App\Http\Helper\dropDown\interfaces\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;


class CustomerDrops implements Customer
{
    protected static $select = ['id','name','phone'];


    private static function query():Builder{
        return \App\Model\Customer::select(self::$select);
    }
    public static function all(): Collection
    {
        return self::query()->get();
    }


}
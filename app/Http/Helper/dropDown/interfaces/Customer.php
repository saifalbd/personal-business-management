<?php


namespace App\Http\Helper\dropDown\interfaces;


use Illuminate\Database\Eloquent\Collection;

interface Customer
{

    public static function all():Collection;
}
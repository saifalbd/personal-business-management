<?php


namespace App\Http\Helper\dropDown\interfaces;


use Illuminate\Database\Eloquent\Collection;

interface Common
{
    public static function all():Collection;
    public static function active():Collection;
    public static function inActive():Collection;
}
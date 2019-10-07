<?php


namespace App\Http\Helper\dropDown;


use App\Model\Tariff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TariffDrops
{

    protected static $select = ['id', 'name'];

    /**
     * @return mixed
     */
    private static function query(): Builder
    {

        return Tariff::select(self::$select);
    }

    /**
     * @return Collection
     */
    public static function all(): Collection
    {
        return self::query()->get();
    }

    /**
     * @return Collection
     * if rate are exists
     */
    public static function active(): Collection
    {
        return self::query()->has('rates')->get();
    }


    /**
     * @return Collection
     *  if rate are no exists
     */
    public static function inActive(): Collection
    {
        return self::query()->doesntHave('rates')->get();

    }


}
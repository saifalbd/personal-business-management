<?php


namespace App\Repositories;


use App\Model\Tariff;

interface TariffRepositoryInterface
{

    public function forSelect();
    public function remove(int $id);


    public function model(Tariff $tariff);

    /**
     * @return bool
     */
    public function canRates():bool ;

    /**
     * @param int $id
     * @return bool
     */
    public function hasTariff(int $id):bool ;

    public function getDefault():Tariff;
}
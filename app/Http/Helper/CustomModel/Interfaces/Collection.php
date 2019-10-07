<?php


namespace App\Http\Helper\CustomModel\Interfaces;


interface Collection
{

    /**
     * @param \App\Http\Helper\CustomModel\Model $model
     * @return \App\Http\Helper\CustomModel\Collection
     */
    public static function make(\App\Http\Helper\CustomModel\Model $model):\App\Http\Helper\CustomModel\Collection;

    /**
     * @param \App\Http\Helper\CustomModel\Model $model
     * @return \App\Http\Helper\CustomModel\Collection
     */
    public function add(\App\Http\Helper\CustomModel\Model $model):\App\Http\Helper\CustomModel\Collection;

    public function collection();
    /**
     * @return array
     */
    public function toArray():array ;

    /**
     * @return string
     */
    public function __toString():string;

    /**
     * @return mixed
     */
    public function __debugInfo();
}
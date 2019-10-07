<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ReportRepositoryInterface
{
    public function setInit(array $info);
    public function orderReport();
    public function creditReport();
    public function debitReport();
    public function customerReport();
    public function customerReportMixer(Collection $collection);
    public function validInfo(string $propery);
    public function addVendor();
    public function addFromDate();
    public function addToDate();
    public function  addSerialTo();
    public function  addSerialFrom();
    public function get();



}
<?php


namespace App\Traits;


trait CustomerRole
{
    protected $roleKeys = [
        'reseller'=>1,
    ];

    public function getCanResellerAttribute(){

        return $this->role == $this->roleKeys['reseller'];
    }
}
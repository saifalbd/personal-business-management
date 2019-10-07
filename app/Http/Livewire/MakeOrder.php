<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MakeOrder extends Component
{

    public $type;
    public $number;
    public $confirmNumber;
    public $amount;
    public $confirmAmount;
    public $name;
    public $phone;
    public $bill;
    public $comment;
    public function render()
    {
        return view('livewire.make-order');
    }
    public function confirm()
    {
         $this->name = 'amamr';
    }
}

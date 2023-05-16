<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIconComponent extends Component
{

    protected $listeners = ['refreshComponent'=>'$refresh']; //[] obtiene los datos y los envia a la vista

    public function render()
    {
        return view('livewire.cart-icon-component');
    }
}

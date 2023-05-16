<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderSearchComponent extends Component
{

    public $q;

    public function mount(){ //mount() señaliza un componente y hace ajustes y config 


        $this->fill(request()->only('q'));
    }

    public function render()
    {
        return view('livewire.header-search-component');
    }
}

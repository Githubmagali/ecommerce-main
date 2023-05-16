<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{

    public function increaseQuantity($rowId){ //funcion para aumentar la cantidad del producto del carrito
        $product = Cart::instance('cart')->get($rowId); 
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
    $this->emitTo('cart-icon-component', 'refreshComponent'); //el metodo emitTo recibe como parámetro aquel dato que queramos hacer llegar al padre.
//$this hace referencia al objeto, que contiene el método donde se invoca.
    }

    public function decreaseQuantity($rowId){ //disminuye la cantidad del carrito
        $product = Cart::instance('cart')->get($rowId); //$rowId identifica una FILA de una tabla de una forma exclusivs
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function destroy($id){

        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component', 'refreshComponent');
        session()->flash('success_message', 'Item has been removed!');
    }
    public function clearAll(){
        Cart::instance('cart')->destroy();
    }


    public function render() //renderiz(genera una imagen) una vista y devuelve su contenido como una cadena.
    {
        return view('livewire.cart-component');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{

    public $slug;
    public function mount($slug) //mount es como el __construct inyecta parametros y dependencias para crear un objeto
    {
        $this->slug = $slug;
    }

    public function store($product_id,$product_name,$product_price) //se actualiza un registro en especifico que proviene del método create y normalmente redirige al index
    {
         Cart::add($product_id,$product_name,1, $product_price)->associate('App\Models\Product');
         session()->flash('success_message', 'Item added in cart');
       return redirect()->route('shop.cart');
    }
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $rproducts = Product::where ('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();// randomOrder aleatorio
        $nproducts = Product::latest()->take(4)->get(); //latest el ultimo registro
        return view('livewire.details-component', ['product'=>$product, 'rproducts'=>$rproducts, 'nproducts'=>$nproducts ]); //[] obtiene los datos y los envia a la vista
    }
}

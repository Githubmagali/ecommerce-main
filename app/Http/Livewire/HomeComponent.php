<?php

namespace App\Http\Livewire;


use Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeSlider;

class HomeComponent extends Component
{                 //store actualiza un registro 
    public function store($product_id,$product_name,$product_price){

        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item added in Cart'); //Un mensaje flash se utiliza para comunicar al usuario
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }
    public function render()
    {


        $slides = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $fproducts = Product::where('featured',1)->inRandomOrder()->get()->take(8);
        $pcategories = Category::where('is_popular',1)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component', ['slides' => $slides, 'lproducts'=>$lproducts,'fproducts'=>$fproducts, 'pcategories'=>$pcategories]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Homeslider;
use App\Models\HomeCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Cart;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = Homeslider::where('status',1)->get();
        $latest_products = Product::orderBy('created_at','DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',' ,$category->sel_categories);
        $categories = Category::whereIn('id', $cats)->get();
        $number_of_products = $category->number_of_products;
        $sale_products = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8); 
        $sale = Sale::find(1);
        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);

        }
        return view('livewire.home-component',['sliders'=>$sliders, 'latest_products'=>$latest_products, 'categories'=>$categories, 'number_of_products'=>$number_of_products,'sale_products'=>$sale_products,'sale'=>$sale])->layout('layouts.base');
    }
}

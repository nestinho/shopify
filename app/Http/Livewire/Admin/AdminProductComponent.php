<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public $searchTerm;

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if($product->image)
        {
            //deleting image product on local stotage
            unlink('assets/images/products'.'/'.$product->image);
        }
        if($product->images)
        {
            //deleting image product gallery on local stotage
            $images = explode(",",$product->images);
            foreach($images as $image)
            {
                if($image)
                {
                    unlink('assets/images/products'.'/'.$image);
                }   
            }
        }
        $product->delete();
        session()->flash('message','Product has been deleted successfully!');
    }

    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $products = Product::where('name','LIKE',$search)
                            ->orWhere('stock_status','LIKE',$search)
                            ->orWhere('regular_price','LIKE',$search)
                            ->orWhere('sale_price','LIKE',$search)
                            ->orderBy('id','DESC')
                            ->paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}

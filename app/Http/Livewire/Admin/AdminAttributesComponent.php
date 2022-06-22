<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminAttributesComponent extends Component
{

    public function deleteAttribute($attribute_id)
    {
        $product_attribute = ProductAttribute::find($attribute_id);
        $product_attribute->delete();
        session()->flash('delete_success_message','Attribute has been deleted successfully!');
    }

    public function render()
    {
        $product_attributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attributes-component',['product_attributes'=>$product_attributes])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminAddAttributeComponent extends Component
{
    public $name;
    public $attribute_id;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required'
        ]);
    }

    public function storeAttribute()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $product_attribute = new ProductAttribute();
        $product_attribute->name = $this->name;
        $product_attribute->save();
        session()->flash('message','New Attribute has been added successfully!');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-add-attribute-component')->layout('layouts.base');
    }
}

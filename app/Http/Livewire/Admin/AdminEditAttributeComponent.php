<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminEditAttributeComponent extends Component
{
    public $name;
    public $attribute_id;


    public function mount($attribute_id)
    {
        $product_attribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $product_attribute->id;
        $this->name = $product_attribute->name;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required'
        ]);
    }

    public function updateAttribute()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $product_attribute = ProductAttribute::find($this->attribute_id);
        $product_attribute->name = $this->name;
        $product_attribute->save();
        session()->flash('message','Attribute has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-attribute-component')->layout('layouts.base');
    }
}

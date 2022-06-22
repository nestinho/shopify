<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;
    public $category_id;
   
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => ' | unique : categories'
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
           'name' => 'required',
           'slug' => 'required | unique : categories'
        ]);

        if($this->category_id)
        {
            $sub_category = new Subcategory();
            $sub_category->name = $this->name;
            $sub_category->slug = $this->slug;
            $sub_category->category_id = $this->category_id;
            $sub_category->save();
        }

        else 
        {
            $category = New Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }
             
        session()->flash('message','New Category has been added successfully!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;
use livewire\WithPagination;

class AdminContactComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $contacts = Contact::paginate(12);
        return view('livewire.admin.admin-contact-component',['contacts'=>$contacts])->layout('layouts.base');
    }
}
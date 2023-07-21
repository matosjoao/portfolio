<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function store()
    {
        Contact::create($this->validateContact());

        return back()->with('success', 'Contacto criado com sucesso!');
    }

    public function update(Contact $contact)
    {



        
        return back()->with('success', 'Contacto atualizado com sucesso!');
    }

    public function destroy(Contact $contact)
    {
        $skill->contact();

        return back()->with('success', 'Contacto eliminado com sucesso!');
    }

    protected function validateContact(?Contact $contact = null): array
    {
        $contact ??= new Contact();

        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'icon_name' => 'required',
        ]);
    }
}

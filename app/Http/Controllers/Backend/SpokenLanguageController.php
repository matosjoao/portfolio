<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpokenLanguage;
use Illuminate\Support\Str;

class SpokenLanguageController extends Controller
{
    public function index()
    {
        return view('admin.spokenLanguage.index', [
            'spokenLanguages' => SpokenLanguage::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function store()
    {
        SpokenLanguage::create(array_merge($this->validateSpokenLanguage(), [
            'slug' => Str::slug(request('language'))
        ]));

        return back()->with('success', 'Língua criada com sucesso!');
    }
    
    public function update(SpokenLanguage $spokenLanguage)
    {
        $attributes = $this->validateSpokenLanguage($spokenLanguage);

        $spokenLanguage->update($attributes);

        return redirect('/admin/spokenLanguage')->with('success', 'Língua atualizada com sucesso!');
    }

    public function destroy(SpokenLanguage $spokenLanguage)
    {
        $spokenLanguage->delete();

        return back()->with('success', 'Língua eliminada com sucesso!');
    }

    protected function validateSpokenLanguage(?SpokenLanguage $spokenLanguage = null): array
    {
        $spokenLanguage ??= new SpokenLanguage();

        return request()->validate([
            'language' => 'required',
            'value' => 'required',
        ]);
    }
}

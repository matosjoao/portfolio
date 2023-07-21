<?php

namespace App\Http\Controllers\Backend;

use App\Models\Formation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    public function index()
    {
        return view('admin.formation.index', [
            'formations' => Formation::orderBy('start_datetime', 'desc')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.formation.create');
    }

    public function store()
    {
        Formation::create(array_merge($this->validateFormation(), [
            'slug' => Str::slug(request('title')),
            'is_current' => request('is_current') === 'on' ? 1 : 0 
        ]));

        return back()->with('success', 'Formação criada com sucesso!');
    }
    
    public function edit(Formation $formation)
    {
        return view('admin.formation.edit', ['formation' => $formation]);
    }
    
    public function update(Formation $formation)
    {
        $attributes = $this->validateFormation($formation);
        $attributes['is_current'] = request('is_current') === 'on' ? 1 : 0 ;

        $formation->update($attributes);

        return redirect('/admin/formation')->with('success', 'Formação atualizada com sucesso!');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();

        return back()->with('success', 'Formação eliminada com sucesso!');
    }

    protected function validateFormation(?Formation $formation = null): array
    {
        $formation ??= new Formation();

        return request()->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'max:255',
            'start_datetime' => 'required|date',
            'finish_datetime' => 'required_if:has_login,off|date|nullable',
            'is_current' => 'required_if:finish_datetime,=,null' 
        ],[
            'is_current.required_if' => 'Campo currente obrigatório quando não preenche a data de fim!',
        ]);
    }
}

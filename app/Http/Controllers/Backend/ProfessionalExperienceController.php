<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfessionalExperience;
use Illuminate\Support\Str;

class ProfessionalExperienceController extends Controller
{
    public function index()
    {
        return view('admin.professional_experience.index', [
            'professional_experiences' => ProfessionalExperience::orderBy('start_datetime', 'desc')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.professional_experience.create');
    }

    public function store()
    {
        ProfessionalExperience::create(array_merge($this->validateProfessionalExperience(), [
            'slug' => Str::slug(request('title')),
            'is_current' => request('is_current') === 'on' ? 1 : 0 
        ]));

        return back()->with('success', 'Experiência Profissional criada com sucesso!');
    }
    
    public function edit(ProfessionalExperience $experience)
    {
        return view('admin.professional_experience.edit', ['experience' => $experience]);
    }
    
    public function update(ProfessionalExperience $experience)
    {
        $attributes = $this->validateProfessionalExperience($experience);
        $attributes['is_current'] = request('is_current') === 'on' ? 1 : 0 ;

        $experience->update($attributes);

        return redirect('/admin/experience')->with('success', 'Experiência Profissional atualizada com sucesso!');
    }

    public function destroy(ProfessionalExperience $experience)
    {
        $experience->delete();

        return back()->with('success', 'Experiência Profissional eliminada com sucesso!');
    }

    protected function validateProfessionalExperience(?ProfessionalExperience $experience = null): array
    {
        $experience ??= new ProfessionalExperience();

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

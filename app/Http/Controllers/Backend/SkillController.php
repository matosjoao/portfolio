<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skill.index', [
            'skills' => Skill::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function store()
    {
        Skill::create(array_merge($this->validateSkill(), [
            'slug' => Str::slug(request('language'))
        ]));

        return back()->with('success', 'Skill criada com sucesso!');
    }
    
    public function update(Skill $skill)
    {
        $attributes = $this->validateSkill($skill);

        $skill->update($attributes);

        return redirect('/admin/skill')->with('success', 'Skill atualizada com sucesso!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return back()->with('success', 'Skill eliminada com sucesso!');
    }

    protected function validateSkill(?Skill $skill = null): array
    {
        $skill ??= new Skill();

        return request()->validate([
            'language' => 'required',
            'value' => 'required',
            'order_number' => 'integer',
            'skill_category_id' => ['required', Rule::exists('skill_categories', 'id')],
        ]);
    }
}

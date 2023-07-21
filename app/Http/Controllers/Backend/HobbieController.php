<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hobbie;
use Illuminate\Support\Str;

class HobbieController extends Controller
{
    public function index()
    {
        return view('admin.hobbie.index', [
            'hobbies' => Hobbie::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.hobbie.create');
    }

    public function store()
    {
        Hobbie::create(array_merge($this->validateHobbie(), [
            'slug' => Str::slug(request('title'))
        ]));

        return back()->with('success', 'Hobbie criado com sucesso!');
    }
    
    public function edit(Hobbie $hobbie)
    {
        return view('admin.hobbie.edit', ['hobbie' => $hobbie]);
    }

    public function update(Hobbie $hobbie)
    {
        $attributes = $this->validateHobbie($hobbie);

        $hobbie->update($attributes);

        return redirect('/admin/hobbie')->with('success', 'Hobbie atualizado com sucesso!');
    }

    public function destroy(Hobbie $hobbie)
    {
        $hobbie->delete();

        return back()->with('success', 'Hobbie eliminado com sucesso!');
    }

    protected function validateHobbie(?Hobbie $hobbie = null): array
    {
        $hobbie ??= new Hobbie();

        return request()->validate([
            'title' => 'required',
            'image_svg' => 'required',
            'order_number' => 'integer',
        ]);
    }
}

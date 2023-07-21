<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BaseSetting;
use App\Models\Contact;

class BaseSettingController extends Controller
{
    public function index()
    {
        return view('admin.base_settings.index', [
            'settings' => BaseSetting::first(),
            'contacts' => Contact::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function update(BaseSetting $baseSetting)
    {
        request()->validate([
            'about_me' => 'required',
            'profile_image' => $baseSetting->exists ? ['image'] : ['required', 'image'],
        ]);
        
        $baseSetting->about_me = request('about_me');
        $baseSetting->motivational_phrase = request('motivational_phrase');
        if (request()->file('profile_image') ?? false) {
            $baseSetting->profile_image = request()->file('profile_image')->store('');
        }
        $baseSetting->update();

        return redirect('/admin/base_settings')->with('success', 'Definições base atualizadas com sucesso!');
    }
}

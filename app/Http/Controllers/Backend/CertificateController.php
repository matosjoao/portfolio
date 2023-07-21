<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        return view('admin.certificate.index', [
            'certificates' => Certificate::orderBy('certificated_at', 'desc')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.certificate.create');
    }

    public function store()
    {
        Certificate::create(array_merge($this->validateCertification(), [
            'slug' => Str::slug(request('title'))
        ]));

        return back()->with('success', 'Prémio/Certificado criado com sucesso!');
    }
    
    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.edit', ['certificate' => $certificate]);
    }
    
    public function update(Certificate $certificate)
    {
        $attributes = $this->validateCertification($certificate);

        $certificate->update($attributes);

        return redirect('/admin/certificate')->with('success', 'Prémio/Certificado atualizado com sucesso!');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return back()->with('success', 'Prémio/Certificado eliminado com sucesso!');
    }

    protected function validateCertification(?Certificate $certificate = null): array
    {
        $certificate ??= new Certificate();

        return request()->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'certificated_at' => 'required|date',
            'icon_name' => 'required'
        ]);
    }
}

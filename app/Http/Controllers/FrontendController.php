<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\BaseSetting;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Formation;
use App\Models\Hobbie;
use App\Models\ProfessionalExperience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SpokenLanguage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Closure;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'professional_experiences' => ProfessionalExperience::orderBy('start_datetime', 'desc')->get(),
            'formations' => Formation::orderBy('start_datetime', 'desc')->get(),
            'skills' => Skill::orderBy('order_number', 'asc')->get(),
            'certificates' => Certificate::orderBy('certificated_at', 'desc')->get(),
            'spoken_languages' => SpokenLanguage::orderBy('created_at', 'asc')->get(),
            'hobbies' => Hobbie::orderBy('order_number', 'asc')->get(),
            'settings' => BaseSetting::first(),
            'projects' => Project::where('active', 1)->orderBy('order_number', 'asc')->get(),
            'contacts' => Contact::orderBy('created_at', 'asc')->get(),
        ]);
    }

    public function contact()
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:255',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' =>  config('services.recaptcha.secret'),
                    'response' => $value,
                    'remoteip' => request()->ip()
                ]);

                if(!$response->json('success') || $response->json('score') < 0.5)
                {
                    $fail("O recaptcha é inválido.");
                }
            }]
        ],[
            'name.required' => 'Campo nome obrigatório!',
            'email.required' => 'Campo email obrigatório!',
            'email.email' => 'Campo email deve ser um email válido!',
            'message.required' => 'Campo mensagem obrigatório!',
            'g-recaptcha-response.required' => 'Campo recaptcha obrigatório!',
        ]);

        ContactMessage::create([
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message'),
            'client_ip' => request()->ip(),
        ]);

        return back()->with('success', 'Obrigado pela sua mensagem, responderei em breve!');

    }

    public function openGameBubble()
    {
        return view('frontend.bubble_split');
    }
}

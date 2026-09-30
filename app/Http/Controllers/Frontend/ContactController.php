<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact', [
            'setting' => Setting::first(),
            'services' => Service::where('status', true)->get(),
            'isQuote' => false,
        ]);
    }

    public function quote()
    {
        return view('frontend.contact', [
            'setting' => Setting::first(),
            'services' => Service::where('status', true)->get(),
            'isQuote' => true,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:60'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
            'source' => ['nullable', 'string', 'in:contact,quote'],
        ]);

        $data['source'] = $request->input('source', 'contact');
        $data['status'] = 'not_connected';

        Contact::create($data);

        return back()->with('success', 'Thank you! Your inquiry has been submitted to the Enerix Solutions engineering team.');
    }
}

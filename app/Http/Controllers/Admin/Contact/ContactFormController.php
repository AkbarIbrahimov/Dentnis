<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactFormController extends Controller
{
    public function contactForm()
    {
        $contacts = ContactForm::query()->get();
        return view('Admin/pages/contact/index', compact('contacts'));
    }


    public function contactFormEditView($id)
    {
        $contact = ContactForm::findOrFail($id);
        return view('Admin/pages/contact/edit', compact('contact'));
    }

    public function contactFormUpdate(Request $request, $id)
    {
        $request->validate([
            'fName' => 'required|',
            'message' => 'required|',
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $contact = ContactForm::findOrFail($id);
        $contact->firstname = $request->input('fName');
        $contact->message = $request->input('message');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->kvkk_accepted = $request->input('accept') ? true : false;
        $contact->save();
        return redirect()->route('admin.contactForm');
    }

    public function contactFormDelete($id)
    {
        $contact = ContactForm::findOrFail($id);

        if ($contact) {
            $contact->delete();
            return redirect()->route('admin.contactForm')->with('success', 'contactForm successfully deleted.');
        } else {
            return redirect()->route('admin.contactForm')->with('error', 'contactForm not found.');
        }


    }
}

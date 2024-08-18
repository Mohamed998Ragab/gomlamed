<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Store the contact form submission
    public function store(StoreRequest $request)
    {
        Contact::create($request->validated());

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    // Show all contact messages in the dashboard
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.contact', compact('contacts'));
    }

    // Delete a contact message
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}

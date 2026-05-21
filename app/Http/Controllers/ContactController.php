<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'category' => $request->input('category'),
        ]);

        return response()->json([
            'message' => 'Contato criado com sucesso!',
            'contact' => $contact,
        ], 201);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $contacts = Contact::when($search, function($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->get();

        return response()->json([
            'contacts' => $contacts,
        ]);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->only(['name', 'phone', 'email', 'category']));

        return response()->json([
            'message' => 'Contato alterado com sucesso!',
            'contact' => $contact,
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'message' => 'Contato apagado com sucesso!',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'value' => 'required'
        ]);
        $objContact = new Contact();
        $objContact->name = $request->input('name');
        $objContact->icon = $request->file('icon')->store('icon', 'public');
        $objContact->value = $request->input('value');
        $objContact->save();
        return response()->json(['message' => 'Cotact added successfully', 'icon' => $objContact], 201);
    }

    public function index()
    {
        $contacts = Contact::all()->map(function ($contacts) {
            return [
                'id' => $contacts->id,
                'name' => $contacts->name,
                'icon' => url('storage/' . $contacts->icon),
                'value' => $contacts->value,
            ];
        });
        return response()->json($contacts);
    }
    

}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])->get();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
        ]);

        if (empty($request->email) && empty($request->phone)) {
            return back()->withErrors(['contact' => 'At least an email or a phone number is required.'])->withInput();
        }

        auth()->user()->clients()->create($request->only('first_name', 'last_name', 'email', 'phone'));

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);

        if (!$this->isClientAssociatedWithAdviser($client)) {
            abort(403);
        }

        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        if (!$this->isClientAssociatedWithAdviser($client)) {
            abort(403);
        }

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        if (!$this->isClientAssociatedWithAdviser($client)) {
            abort(403);
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
        ]);

        if (empty($request->email) && empty($request->phone)) {
            return back()->withErrors(['contact' => 'At least an email or a phone number is required.']);
        }

        $client->update($request->only('name', 'email', 'phone'));

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if (!$this->isClientAssociatedWithAdviser($client)) {
            abort(403);
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    private function isClientAssociatedWithAdviser(Client $client): bool
    {
        return $client->adviser_id === auth()->id();
    }
}

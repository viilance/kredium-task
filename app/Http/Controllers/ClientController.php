<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('create', Client::class);

        return view('clients.create');
    }

    /**
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest  $request): RedirectResponse
    {
        $adviser = $request->user();

        $adviser->clients()->create($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * @param Client $client
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function show(Client $client): Application|View|Factory
    {
        $this->authorize('view', $client);

        return view('clients.show', compact('client'));
    }

    /**
     * @param Client $client
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function edit(Client $client): Application|View|Factory
    {
        $this->authorize('update', $client);

        return view('clients.edit', compact('client'));
    }

    /**
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * @param Client $client
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Client $client): RedirectResponse
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}

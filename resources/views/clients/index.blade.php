<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-2 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">{{ __('Go back to dashboard') }}</a>
                    <a href="{{ route('clients.create') }}" class="inline-block px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">{{ __('Create Client') }}</a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('First Name') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Last Name') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Phone') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Cash Loan') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Home Loan') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($clients as $client)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->email ?? '/' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->phone ?? '/' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->cashLoan ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $client->homeLoan ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($client->adviser_id == auth()->id())
                                <a href="{{ route('clients.edit', $client->id) }}" class="text-yellow-500 hover:underline ml-2">{{ __('Edit') }}</a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this client?')">{{ __('Delete') }}</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center">{{ __('No clients found.') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

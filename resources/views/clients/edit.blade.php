<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-200 text-green-800 p-2 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-200 text-red-800 p-2 mb-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <a href="{{ route('clients.index') }}" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">{{ __('Go back to clients') }}</a>

                    <form action="{{ route('clients.update', $client) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="first_name">
                                {{ __('First Name') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first_name" name="first_name" value="{{ old('first_name', $client->first_name) }}" type="text" placeholder="John" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="last_name">
                                {{ __('Last Name') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name) }}" type="text" placeholder="Doe" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="email">
                                {{ __('Email') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" value="{{ old('email', $client->email) }}" type="email" placeholder="johndoe@example.com">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="phone">
                                {{ __('Phone') }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" type="text" name="phone" value="{{ old('phone', $client->phone) }}" placeholder="(+1) 123 123 123">
                        </div>
                        <div class="justify-end grid">
                            <button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out" type="submit">
                                {{ __('Update Client') }}
                            </button>
                        </div>
                    </form>

                    <!-- Cash Loan Form -->
                    <h3 class="text-xl font-bold mt-10 mb-4">{{ __('Cash Loan Application') }}</h3>

                    @if($client->cashLoan)
                        <form action="{{ route('cash-loans.update', $client) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="loan_amount">
                                    {{ __('Loan Amount') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="loan_amount" name="loan_amount" value="{{ old('loan_amount', $client->cashLoan->loan_amount ?? '') }}" type="number" min="0" required>
                            </div>
                            <div class="justify-end grid">
                                <button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out" type="submit">
                                    {{ 'Update Cash Loan' }}
                                </button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('cash-loans.store', $client) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="loan_amount">
                                    {{ __('Loan Amount') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="loan_amount" name="loan_amount" value="{{ old('loan_amount') }}" type="number" min="0" required>
                            </div>
                            <div class="justify-end grid">
                                <button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out" type="submit">
                                    {{ 'Create Cash Loan' }}
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Home Loan Form -->
                    <h3 class="text-xl font-bold mt-10 mb-4">{{ __('Home Loan Application') }}</h3>

                    @if($client->homeLoan)
                        <form action="{{ route('home-loans.update', $client) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="property_value">
                                    {{ __('Property Value') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="property_value" name="property_value" value="{{ old('property_value', $client->homeLoan->property_value ?? '') }}" type="number" min="0" required>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="down_payment">
                                    {{ __('Down Payment') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="down_payment" name="down_payment" value="{{ old('down_payment', $client->homeLoan->down_payment ?? '') }}" type="number" min="0" required>
                            </div>
                            <div class="justify-end grid">
                                <button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out" type="submit">
                                    {{ 'Update Home Loan'}}
                                </button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('home-loans.store', $client) }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="property_value">
                                    {{ __('Property Value') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="property_value" name="property_value" value="{{ old('property_value') }}" type="number" min="0" required>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="down_payment">
                                    {{ __('Down Payment') }}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="down_payment" name="down_payment" value="{{ old('down_payment') }}" type="number" min="0" required>
                            </div>
                            <div class="justify-end grid">
                                <button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out" type="submit">
                                    {{ 'Create Home Loan' }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

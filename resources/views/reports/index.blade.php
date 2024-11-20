<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adviser Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('reports.export') }}" class="bg-green-500 text-white px-4 py-2 rounded">{{ __('Export to CSV') }}</a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product Type') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product Value') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Creation Date') }}</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->productType }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->productType === 'Cash Loan')
                                    ${{ number_format($product->productValue, 2) }}
                                @elseif($product->productType === 'Home Loan')
                                    ${{ number_format($product->productValue, 2) }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->createdAt->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">{{ __('No products found.') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

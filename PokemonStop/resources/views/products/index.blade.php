<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden rounded-lg">
                    <a href="{{ route('products.show', $product) }}">
                        <img src="{{ optional($product->images->first())->path ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                ${{ number_format($product->price,2) }}
                            </span>
                            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
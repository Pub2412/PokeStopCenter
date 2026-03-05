<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="container py-6">
        <div class="row">
            <div class="col-md-6">
                @foreach($product->images as $img)
                    <img src="{{ $img->path }}" class="img-fluid mb-2" alt="">
                @endforeach
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <h4>${{ number_format($product->price,2) }}</h4>
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-success">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
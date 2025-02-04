@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h1>Product List</h1>
@if (session('success'))
<div class="alert alert-success" style="background-color: #28a745; color: white;">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
<div class="products-grid">
    @foreach ($products as $product)
        <!-- Product Card -->
        <div class="product-card">
            <div class="product-image">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="product-info">
                <h3 class="product-title">{{ $product->name }}</h3>
                <p class="product-price">${{ $product->price }}</p>
                {{-- <form
                    action="{{ route('cart_add', ['encryptedProductId' => urlencode(Crypt::encryptString($product->id))]) }}"
                    method="POST">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                    <button type="submit" class="btn-add-product">Add to Cart</button>
                </form> --}}
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('styles')
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .products-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-card {
        flex: 1 1 calc(25% - 20px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .product-image {
        height: 200px;
        overflow: hidden;
    }

    .product-info {
        padding: 10px;
    }
</style>
@endsection

@if (session('success'))
    <script>
        alert(1);
        setTimeout(function() {
            const alert = document.querySelector('div[style*="background-color: #28a745"]');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5 seconds
    </script>
@endif
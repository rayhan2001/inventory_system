@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
    <div class="container-fluid">

        <div class="card my-4">
            <div class="card-header">
                <h2>Edit Product</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name <sup>*</sup></label>
                                <input type="text" class="form-control" id="product_name" name="name" required
                                    placeholder="Enter product name" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="purchase_price" class="form-label">Purchase Price <sup>*</sup></label>
                                <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                                    required placeholder="Enter purchase price" value="{{ $product->purchase_price }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sell_price" class="form-label">Sell Price <sup>*</sup></label>
                                <input type="number" class="form-control" id="sell_price" name="sell_price" required
                                    placeholder="Enter sell price" value="{{ $product->sell_price }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Opening Stock <sup>*</sup></label>
                                <input type="number" class="form-control" id="stock" name="stock" required
                                    placeholder="Enter opening stock" value="{{ $product->stock }}">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

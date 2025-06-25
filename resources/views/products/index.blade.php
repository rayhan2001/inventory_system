@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between">
                <h2>Product List</h2>
                @if (session('success'))
                    <span class="alert alert-success">{{ session('success') }}</span>
                @endif
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->purchase_price }}</td>
                                <td>{{ $product->sell_price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

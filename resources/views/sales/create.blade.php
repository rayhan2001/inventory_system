@extends('layouts.app')
@section('title', 'Create Sale')
@section('content')
    <div class="container-fluid">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between">
                <h2>New Sale Entry</h2>
                {{-- @if (session('success'))
                    <span class="alert alert-success">{{ session('success') }}</span>
                @endif --}}

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <a href="{{ route('sales.index') }}" class="btn btn-primary mb-3">View Sales List</a>
            </div>

            <div class="card-body">
                <p class="text-muted">Please select products and enter the quantity for each product. You can add multiple
                    products to the sale.</p>

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    <div id="product-wrapper">
                        <div class="row product-row mb-3">
                            <div class="col-md-4">
                                <select name="products[0][product_id]" class="form-control" required>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} (Stock: {{ $product->stock }}, Price:
                                            {{ $product->sell_price }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="products[0][quantity]" class="form-control"
                                    placeholder="Quantity" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-row" class="btn btn-secondary mb-3">Add Product</button>

                    <div class="mb-3">
                        <label>Discount (TK)</label>
                        <input type="number" name="discount" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Customer Paid (TK)</label>
                        <input type="number" name="received_amount" class="form-control" required>
                    </div>

                    <button class="btn btn-success">Submit Sale</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let rowIndex = 1;

        document.getElementById('add-row').addEventListener('click', function() {
            const newRow = document.querySelector('.product-row').cloneNode(true);
            newRow.querySelectorAll('select, input').forEach(function(el) {
                el.name = el.name.replace(/\d+/, rowIndex);
                el.value = '';
            });
            document.getElementById('product-wrapper').appendChild(newRow);
            rowIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = document.querySelectorAll('.product-row');
                if (rows.length > 1) {
                    e.target.closest('.product-row').remove();
                }
            }
        });
    </script>
@endpush

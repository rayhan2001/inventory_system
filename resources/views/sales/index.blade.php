@extends('layouts.app')
@section('title', 'Sales List')
@section('content')
    <div class="container-fluid">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between">
                <h2>Sales List</h2>
                @if (session('success'))
                    <span class="alert alert-success">{{ session('success') }}</span>
                @endif

                <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Add Sale</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>VAT</th>
                            <th>Received</th>
                            <th>Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->sale_date }}</td>
                                <td>{{ $sale->total_amount }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->vat }}</td>
                                <td>{{ $sale->received_amount }}</td>
                                <td>{{ $sale->due_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

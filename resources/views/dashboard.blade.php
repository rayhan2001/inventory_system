@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-center h3">Dashboard Overview</h2>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <h3 class="card-text">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Stock</h5>
                    <h3 class="card-text">{{ $totalStock }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">This Month's Sales</h5>
                    <h3 class="card-text">{{ number_format($totalSaleAmount, 2) }} TK</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Received</h5>
                    <h3 class="card-text">{{ number_format($totalReceived, 2) }} TK</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Due</h5>
                    <h3 class="card-text">{{ number_format($totalDue, 2) }} TK</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-dark shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Estimated Profit</h5>
                    <h3 class="card-text">{{ number_format($profit, 2) }} TK</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
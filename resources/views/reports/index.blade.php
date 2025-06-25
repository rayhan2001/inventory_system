@extends('layouts.app')
@section('title', 'Financial Report')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1 class="h3">Financial Report</h1>
            </div>
            <div class="card-body">
                <p class="text-muted">This report provides an overview of the financial performance of the business over a
                    specified period.</p>
                <form method="GET" class="row mb-4">
                    <div class="col-md-4">
                        <label>From:</label>
                        <input type="date" name="from" value="{{ $from }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>To:</label>
                        <input type="date" name="to" value="{{ $to }}" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </form>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Total Sales</th>
                                <td>{{ number_format($sales, 2) }} TK</td>
                            </tr>
                            <tr>
                                <th>Total Discount</th>
                                <td>{{ number_format($discount, 2) }} TK</td>
                            </tr>
                            <tr>
                                <th>Total VAT</th>
                                <td>{{ number_format($vat, 2) }} TK</td>
                            </tr>
                            <tr>
                                <th>Total Cash Received</th>
                                <td>{{ number_format($cash, 2) }} TK</td>
                            </tr>
                            <tr>
                                <th>Total Due</th>
                                <td>{{ number_format($due, 2) }} TK</td>
                            </tr>
                            <tr>
                                <th>Estimated Profit</th>
                                <td class="{{ $profit <= 0 ? 'text-danger' : 'text-success' }}">{{ number_format($profit, 2) }} TK</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

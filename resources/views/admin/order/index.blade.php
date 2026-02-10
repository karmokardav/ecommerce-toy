@extends('admin.layout.master')

@section('content')
<h3>All Orders</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Status</th>
        <th width="150">Action</th>
    </tr>

    @foreach($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->name }}</td>
        <td>{{ $order->phone }}</td>
        <td>{{ $order->total }}</td>
        <td>{{ strtoupper($order->payment_method) }}</td>
        <td>
            <span class="badge bg-warning">
                {{ $order->payment_status }}
            </span>
        </td>
        <td>
            <a href="{{ route('admin.orders.show', $order->id) }}"
               class="btn btn-sm btn-primary">
                View
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection

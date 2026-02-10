@extends('admin.layout.master')

@section('content')
<h3>Order #{{ $order->id }}</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-3">
    <div class="card-body">
        <p><b>Name:</b> {{ $order->name }}</p>
        <p><b>Phone:</b> {{ $order->phone }}</p>
        <p><b>Address:</b> {{ $order->address }}</p>
        <p><b>Total:</b> {{ $order->total }}</p>
        <p><b>Payment:</b> {{ strtoupper($order->payment_method) }}</p>
        <p><b>Status:</b> {{ $order->payment_status }}</p>
    </div>
</div>

<h5>Products</h5>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
    </tr>

    @foreach($items as $item)
    <tr>
        <td>{{ $item->product_name }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->quantity }}</td>
    </tr>
    @endforeach
</table>

<form method="POST"
      action="{{ route('admin.orders.status', $order->id) }}">
    @csrf

    <label>Change Status</label>
    <select name="status" class="form-control w-25">
        <option value="pending"
            @selected($order->payment_status=='pending')>
            Pending
        </option>
        <option value="delivered"
            @selected($order->payment_status=='delivered')>
            Delivered
        </option>
    </select>

    <button class="btn btn-success mt-2">
        Update Status
    </button>
</form>
@endsection

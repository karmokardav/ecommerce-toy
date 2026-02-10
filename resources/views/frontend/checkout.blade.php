@extends('frontend.layout.master')

@section('content')
    <h3>Checkout</h3>

    <form method="POST" action="{{ route('place.order') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Payment Method</label><br>
            <input type="radio" name="payment_method" value="cod" checked>
            Cash on Delivery
        </div>

        <button class="btn btn-success">
            Place Order
        </button>
    </form>
@endsection
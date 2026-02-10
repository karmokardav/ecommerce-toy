@extends('frontend.layout.master')

@section('content')
<h3>Checkout</h3>

<form method="POST" action="{{ route('place.order') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Place Order</button>
</form>
@endsection

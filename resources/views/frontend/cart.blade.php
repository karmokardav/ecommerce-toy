@extends('frontend.layout.master')

@section('content')
    <h3>Your Cart</h3>

    {{-- Cart Empty Check --}}
    @if(session('cart') && count(session('cart')) > 0)

        <table class="table table-bordered">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th width="120">Qty</th>
                <th>Total</th>
                <th width="100">Action</th>
            </tr>

            @php $total = 0; @endphp

            @foreach(session('cart') as $id => $item)
                @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                @php $total += $itemTotal; @endphp

                <tr>
                    <td>
                        <img src="/uploads/products/{{ $item['image'] }}" width="60">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                        <input type="number" class="form-control qty" data-id="{{ $id }}" value="{{ $item['quantity'] }}" min="1">
                    </td>
                    <td>{{ $itemTotal }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove" data-id="{{ $id }}">
                            Remove
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: {{ $total }}</h4>

            @auth
                <a href="{{ route('checkout') }}" class="btn btn-primary">
                    Checkout
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning">
                    Login to Place Order
                </a>
            @endauth
        </div>

    @else
        <div class="alert alert-warning">
            Your cart is empty
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            // Update quantity
            $('.qty').change(function () {
                $.post('/cart/update', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $(this).data('id'),
                    qty: $(this).val()
                }, function () {
                    location.reload();
                });
            });

            // Remove item
            $('.remove').click(function () {
                $.post('/cart/remove', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $(this).data('id')
                }, function () {
                    location.reload();
                });
            });

        });
    </script>
@endsection
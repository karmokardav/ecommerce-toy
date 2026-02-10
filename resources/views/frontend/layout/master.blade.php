<!DOCTYPE html>
<html>

<head>
    <title>Ecommerce</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark flex justify-between">
        <div class="container">
            <a class="navbar-brand" href="/">MyShop</a>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('cart') }}" class="btn btn-outline-light">
                🛒 Cart
                <span id="cart-count" class="badge bg-danger">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-light" type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
            @endif
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            Product List
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-end">Add Product</a>
        </h4>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Image</th>
                <th width="200">Action</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('uploads/products/'.$product->image) }}" width="60">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('products.destroy',$product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

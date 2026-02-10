@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Product</h4></div>

    <div class="card-body">
        <form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected($product->category_id == $cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Image</label><br>
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="80"><br><br>
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

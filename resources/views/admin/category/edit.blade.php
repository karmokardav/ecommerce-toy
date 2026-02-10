@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header"><h4>Edit Category</h4></div>
    <div class="card-body">
        <form method="POST" action="{{ route('categories.update',$category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

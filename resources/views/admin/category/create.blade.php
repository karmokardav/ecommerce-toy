@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header"><h4>Add Category</h4></div>
    <div class="card-body">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" name="name" class="form-control">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection

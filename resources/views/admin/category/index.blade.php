@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            Category List
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
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
                <th width="200">Action</th>
            </tr>

            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    <a href="{{ route('categories.edit',$cat->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('categories.destroy',$cat->id) }}" method="POST" style="display:inline;">
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

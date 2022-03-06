@extends('layouts.admin')

@section('content')
<div class="container">
     <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('stauts') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h1>
                Post
            </h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th colspan="3" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">View</a></td>
                <td><a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">Edit</a></td>
                <td>
                    <form action="{{ route('admin.posts.destroy', $post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
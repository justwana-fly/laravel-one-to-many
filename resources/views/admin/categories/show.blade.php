@extends('layouts.admin')
@section('title', $category->name)

@section('content')
<section>
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>{{$category->name}}</h1>
        <div>
            <a href="{{route('admin.categories.edit', $category->slug)}}" class="btn btn-secondary">Edit</a>
            <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-danger" data-item-title="{{ $category->name }}">
                    Delete Category
                </button>
            </form>
        </div>
    </div>

    <!-- Visualizzare la tipologia associata se presente -->
    @if($category->type)
        <p>Type: {{ $category->type->name }}</p>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Created At</th>
                <th scope="col">Update At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category->posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                        <a href="{{route('admin.posts.show', $post->slug)}}" title="Show" class="text-black px-2"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{route('admin.posts.edit', $post->slug)}}" title="Edit" class="text-black px-2"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button border-0 bg-transparent" data-item-title="{{ $post->title }}" data-item-id="{{ $post->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@include('partials.modal-delete')
@endsection

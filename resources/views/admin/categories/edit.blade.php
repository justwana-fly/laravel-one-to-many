@extends('layouts.admin')

@section('title', 'Edit Post: ' . $post->title)

@section('content')
    <section>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h2>Edit post: {{$post->title}}</h2>
            <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-danger">Show Post</a>
        </div>

        <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" minlength="3" maxlength="200" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div>
            </div>
            <div class='d-flex'>
                <div class="media me-4">
                    @if($post->image)
                    <img class="shadow" width="150" src="{{asset('storage/' . $post->image)}}" alt="{{$post->title}}" id="uploadPreview">
                    @else
                    <img class="shadow" width="150" src="/images/placeholder.png" alt="{{$post->title}}" id="uploadPreview">
                    @endif

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="uploadImage"
                        name="image" value="{{ old('image', $post->image) }}" maxlength="255">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>


    </section>

@endsection

@extends('layouts.admin')
@section('title', 'Categories')

@section('content')
<section>
    @if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>Categories</h1>
        <a href="{{route('admin.categories.create')}}" class="btn btn-danger">Create new category</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Slug</th>
              <th scope="col">Created At</th>
              <th scope="col">Update At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td>
                    <a href="{{route('admin.categories.show', $category->slug)}}" title="Show" class="text-black px-2"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.categories.edit', $category->slug)}}" title="Edit" class="text-black px-2"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST" class="d-inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $category->name }}" data-item-id = "{{ $category->id }}">
                        <i class="fa-solid fa-trash"></i>
                      </button>

                    </form>


                </td>
              </tr>
            @endforeach


          </tbody>
      </table>
</section>
{{-- {{ $categories->links('vendor.pagination.bootstrap-5') }} --}}
@include('partials.modal-delete')
@endsection




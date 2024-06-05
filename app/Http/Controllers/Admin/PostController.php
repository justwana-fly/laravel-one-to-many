<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Type; 
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $posts = Post::where('user_id', $id)->paginate(3);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all(); // Aggiungi questa linea per ottenere tutte le tipologie
        return view('admin.posts.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Post::generateSlug($form_data['title']);
        $form_data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['image'] = $path;
        }

        $newPost = Post::create($form_data);
        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
{
    $categories = Category::all();
    $types = Type::all(); // Recupera tutte le tipologie
    return view('admin.posts.edit', compact('post', 'categories', 'types'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->all();
        $form_data['user_id'] = Auth::id();

        if ($post->title !== $form_data['title']) {
            $form_data['slug'] = Post::generateSlug($form_data['title']);
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['image'] = $path;
        }

        $post->update($form_data);
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', $post->title . ' è stato eliminato');
    }
}

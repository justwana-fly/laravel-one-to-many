<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Type; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $types = Type::all();
        return view('admin.categories.create', compact('types'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'nullable|exists:types,id',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        
    }

    public function update(Request $request, Category $category)
    {
       
    }

    public function destroy(Category $category)
    {
        
    }
}

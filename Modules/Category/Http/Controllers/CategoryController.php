<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($request->all());
        return redirect()->route('category.index');
    }

    public function show(Category $category): Response
    {
        return Inertia::render('Category/Show', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|unique:categories,slug,{$category->id}",
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->all());
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}


<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('browse-category');
        $categories = Category::latest('id')->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('add-category');
        $request->validate([
            'category_name' => 'required|string|unique:categories,name',
        ]);
        Category::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'status' => $request->status,
        ]);

        session()->flash('success', 'Category added successfully.');
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-category');
        $category = Category::findOrFail($id);
        $request->validate([
            'category_name' => 'required|string|unique:categories,name,' . $category->id,
        ]);
        $category->update([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'status' => $request->status,
        ]);
        session()->flash('success', 'Category updated successfully.');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-category');
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', "Category deleted successfully.");
    }
}
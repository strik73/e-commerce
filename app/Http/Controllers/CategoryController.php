<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
        ]);

        $status = $request->boolean('status');

        $categories = Category::create([
            'category' => $validated['category'],
            'status' => $status,
        ]);

        Session::flash('success', 'Data successfully added');

        return redirect()->route('category.index')->with('success', 'Category successfully added');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'string|required'
        ]);

        $status = $request->boolean('status');

        $category = Category::find($id);

        $category->update([
            'category' => $validated['category'],
            'status' => $status,
        ]);

        Session::flash('success', 'Data updated successfully');

        return response()->json(['message' => 'success']);
    }
}

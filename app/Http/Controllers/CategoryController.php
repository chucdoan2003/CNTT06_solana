<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //GET LIST CATE
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    //CREAT NEW CATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Category::create([
            'name' => $validatedData['name'],
        ]);

        return response()->json(['message' => 'Category created successfully!', 'category' => $category], 201);
    }

    // UPDATE CATEGORY
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        $category->save();

        return response()->json(['message' => 'Category updated successfully!', 'category' => $category]);
    }

    // DELETE CATEGORY
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCate(CategoryRequest $request)
{
    try {
        $name = $request->input('name');
        $Cate = Category::create([
            'name' => $name,
        ]);
        return response()->json(['message' => 'Thêm mới thành công!', 'data' => $Cate]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Lỗi xảy ra', 'error' => $e->getMessage()], 500);
    }
}
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function update(CategoryRequest $request, $id)
    {
        $name = $request->input('name');
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $name,
        ]);

        return response()->json(['message' => 'Cập nhật thành công!', 'data' => $category]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Xóa thành công!']);
    }
}

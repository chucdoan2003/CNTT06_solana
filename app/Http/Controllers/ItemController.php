<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function getItemsByCategory($categoryName)
    {
        // Lấy category dựa vào tên
        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Lấy items thuộc về category
        $items = Item::where('cateID', $category->id)->get();

        return response()->json(['items' => $items], 200);
    }
}

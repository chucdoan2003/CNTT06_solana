<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\category;

class CategoryController extends Controller
{
    public function addCate(CategoryRequest $request)
    {
        $name = $request->input('name');
        

        $Cate = category::create([
            'name' => $name,
        ]);
    
        return response()->json(['message' => 'Thêm mới thành công !', 'data' => $Cate]);
    }
    
}

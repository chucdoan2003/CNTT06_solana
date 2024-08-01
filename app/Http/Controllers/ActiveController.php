<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function list()
    {   
        
        $data = Active::where('status', 1)->get();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'không tồn tại'], 404);
        }

        return response()->json(['data' => $data], 200);
    }
}

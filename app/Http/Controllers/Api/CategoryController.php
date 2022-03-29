<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function get(Category $category)
    {
        return response()->json([
            'data' => $category->get(),
            'message' => 'Get data category'
        ], 200);
    }

    public function getBySlug(Category $category)
    {
        return response()->json(['data' => $category, 'message' => 'Get data category by slug']);
    }

    public function insert(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:5',
            'icon' => 'required',
            'color' => 'required'
        ]);

        $category->create([
            'name' => $request->name,
            'slug' => Str::of($request->title)->slug('-'),
            'icon' => $request->icon,
            'color' => $request->color
        ]);

        return response()->json([
            'data' => $category,
            'message' => 'Data category telah ditambahkan'
        ], 200);
    }

    public function update()
    {
    }
}

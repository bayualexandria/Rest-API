<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function get(Category $category)
    {
        return view('categories.categories', [
            'categories' => $category->latest()->get()
        ]);
    }

    public function detail(Category $category)
    {
        // return view('categories.detail', [
        //     'category' => $category
        // ]);
        return true;
    }

    public function insert(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'icon.required' => 'Icon harus diisi',
            'color.required' => 'Color harus diisi'
        ]);
        if ($request->file('icon')) {
            $icon = $request->file('icon')->store('image-category/' . Str::of($request->name)->slug('-') . '/');
        }

        $category->create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $icon,
            'color' => $request->color
        ]);

        return redirect()->route('category')->with('message', 'Data category telah ditambahakan');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'icon.required' => 'Icon harus diisi',
            'color.required' => 'Color harus diisi'
        ]);

        if ($request->file('icon')) {
            if ($category->icon) {
                Storage::delete($category->icon);
            }
            $icon = $request->file('icon')->store('image-category/' . Str::of($request->name)->slug('-') . '/');
        } else {
            $icon = $category->icon;
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $icon,
            'color' => $request->color
        ]);

        return redirect()->route('category')->with('message', 'Data category telah diupdate');
    }

    public function delete(Category $category, Blog $blog)
    {
        $blog->delete('category_id', $category->id);
        $category->delete();
        return redirect()->route('category')->with('message', 'Data berhasil dihapus');
    }
}

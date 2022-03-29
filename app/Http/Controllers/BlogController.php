<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function get()
    {
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $name = $category->name;
        } else {
            $name = 'Semua';
        }
        return view('blogs.blogs', [
            'blogs' => Blog::latest()->blogs(request(['search', 'category']))->paginate(10)->withQueryString(),
            'categories' => Category::all(),
            'name' => $name,
        ]);
    }

    public function getBlog()
    {
        return response()->json(['data' => Blog::latest()->get(), 'message' => 'Data get successfully']);
    }

    public function detail(Blog $blog)
    {
        return view('blogs.detail', [
            'blog' => $blog
        ]);
    }

    public function edit(Blog $blog, Category $category)
    {
        return view('blogs.edit', ['blog' => $blog, 'categories' => $category->latest()->get()]);
    }

    public function insert(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'body' => 'required',
            'image' => 'required|image|file|max:1024'
        ], [
            'title.required' => 'Title harus diisi',
            'title.unique' => 'Title sudah terdaftar',
            'body.required' => 'Body harus diisi',
            'image.required' => 'Image harus dimasukan',
            'image.image' => 'Yang anda masukan bukan image',
            'image.file' => 'Yang anda masukan bukan file',
            'image.max' => 'Maksimal ukuran file 1024 Mb'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('image-blog/' . Str::of($request->title)->slug('-') . '/');
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::of($request->title)->slug('-'),
            'user_id' => Auth::user()->id,
            'image' => $image,
            'body' => $request->body,
            'category_id' => $request->category_id
        ];

        $blog->create($data);

        return redirect()->route('blogs')->with('message', 'Data ' . $request->title . ' telah ditambahkan');
    }

    public function update(Blog $blog, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ], [
            'title.required' => 'Title harus diisi',
            'title.unique' => 'Title sudah terdaftar',
            'body.required' => 'Body harus diisi'
        ]);

        if ($request->file('image')) {

            if ($blog->image && $blog->image != 'default.png') {
                Storage::delete($blog->image);
            }
            $image = $request->file('image')->store('image-blog/' . Str::of($request->title)->slug('-') . '/');
        } else {
            $image = $blog->image;
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::of($request->title)->slug('-'),
            'category_id' => $request->category_id,
            'image' => $image,
            'user_id' => Auth::user()->id,
            'body' => $request->body
        ];

        $blog->update($data);

        return redirect()->route('blogs')->with('message', 'Data ' . $request->title . ' telah diubah');
    }

    public function delete(Blog $blog)
    {
        // Storage::delete($blog->image);
        Storage::deleteDirectory('image-blog/' . $blog->slug);
        $blog->delete();
        return redirect()->route('blogs')->with('message', 'Data berhasil di hapus');
    }
}

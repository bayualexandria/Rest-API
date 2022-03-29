<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Blog, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function get(Blog $blog)
    {
        return response()->json(['data' => $blog->latest('updated_at')->get(), 'message' => 'Get all data'], 200);
    }

    public function getBySlug($slug)
    {
        $blog=Blog::where('slug',$slug)->first();
        if ($blog) {

            return response()->json(['data' => $blog, 'message' => 'Data get by slug'], 200);
        }
        return response()->json(['message' => 'Data not found']);
    }

    public function getByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {

            $blog = Blog::where('category_id', $category->id)->get();
            return response()->json(['data' => $blog]);
        } else {
            return response()->json(['message' => "Data not found"], 404);
        }
    }

    public function insert(Request $request, Blog $blog)
    {

        $request->validate(
            [
                'user_id' => 'required',
                'category_id' => 'required',
                'title' => 'required',
                'image' => 'required',
                'body' => 'required'
            ],
            [
                'user_id.required' => 'User id harus di isi',
                'category_id.required' => 'Kategori harus diisi',
                'title.required' => 'Title harus di isi',
                'image.required' => 'Image harus diisi',
                'body.required' => 'Body harus di isi'
            ]
        );

        $blog->create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::of($request->title)->slug('-'),
            'body' => $request->body,
            'image' => $request->image
        ]);

        return response()->json([
            'data' => $blog,
            'message' => 'Data has been created'
        ], 200);
    }

    public function update(Blog $blog)
    {
        if (request('title')) {
            $title = request('title');
        } else {
            $title = $blog->title;
        }
        $blog->update([
            'title' => $title,
            'category_id' => (request('category_id')) ? request('category_id') : $blog->category_id,
            'user_id' => (request('user_id')) ? request('user_id') : $blog->user_id,
            'image' => (request('image')) ? request('image') : $blog->image,
            'slug' => (request('title')) ? Str::of(request('title'))->slug('-') : $blog->slug,
            'body' => (request('body')) ? request('body') : $blog->body
        ]);

        return response()->json([
            'data' => $blog,
            'message' => 'Data berhasil di update'
        ], 200);
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}

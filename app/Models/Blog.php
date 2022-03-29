<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    use HasFactory;
    protected $with = ['category', 'user'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeBlogs($query, array $request)
    {
        $query->when(
            $request['search'] ?? false,
            fn ($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')->orWhere('body', 'like', '%' . $search . '%')
        );

        $query->when(
            $request['user'] ?? false,
            fn ($query, $user) =>
            $query->whereHas('user', fn ($query) => $query->where('name', $user))
        );

        $query->when(
            $search['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }
}

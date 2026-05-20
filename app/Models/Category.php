<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'is_active',
        'position',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('position');
    }

    static function getNested($parentId = null, $depth = 0, $maxdepth = 3) {
        if ($depth >= $maxdepth) return [];
        $categories = self::where('parent_id', $parentId)->orderBy('position')->get();

        foreach ($categories as $category) {
            $category->children = self::getNested($category->id, $depth + 1, $maxdepth);
        }

        return $categories;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    function index(): View
    {
        return view('admin.category.index');
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'required|boolean',
        ]);

        // prevent circular reference and max depth of 3
        if ($data['parent_id'] ?? null) {
            $parent = Category::find($data['parent_id']);

            // Check for max depth of 3
            $depth = 1;
            $current = $parent;
            while ($current->parent_id) {
                $current = Category::find($current->parent_id);
                $depth++;
                if ($depth >= 3) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'parent_id' => 'Cannot assign parent category. Maximum depth of 3 exceeded.',
                    ]);
                }
            }
        }

        $data['position'] = Category::where('parent_id', $data['parent_id'] ?? null)->max('position') + 1;

        $category = Category::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'category' => $category,
        ]);
    }

    function getNestedCategories()
    {
        $categories = Category::getNested();
        return response()->json($categories);
    }
}

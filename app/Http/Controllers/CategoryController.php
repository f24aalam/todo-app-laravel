<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Listing the categories
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();

        return view('categories', compact('categories'));
    }

    /**
     * Store the category in database
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        $category->save();

        return back()->with('status', "Category Created");
    }

    /**
     * Delete the category
     *
     * @param Request $request
     * @param Category $category
     */
    public function destroy(Request $request, Category $category)
    {
        if ($category->user_id != Auth::user()->id) {
            abort(403);
        }

        $category->delete();

        return back()->with('status', 'Category Deleted');
    }
}

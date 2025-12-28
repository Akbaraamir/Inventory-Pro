<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Get all categories from the database
        $categories = Category::all();
        
        // Return the view and pass the categories to it
        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validation: Ensure the name is unique and not empty
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
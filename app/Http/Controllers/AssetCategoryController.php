<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $categories = AssetCategory::all();
        return view("asset-categories.index", compact("categories"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:asset_categories,name'
            ],
            [
                'name.unique' => 'This category already exists.'
            ]
        );

        AssetCategory::create($validated);

        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, AssetCategory $assetCategory)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $assetCategory->update($validated);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function destroy(AssetCategory $assetCategory)
    {
        try {
            $assetCategory->delete();

            return redirect()->back()->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            // Optional: catch errors if delete fails
            return redirect()->back()->with('error', 'Failed to delete the category.');
        }
    }
}

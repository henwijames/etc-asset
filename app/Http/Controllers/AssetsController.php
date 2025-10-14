<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\Assets;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function index(Request $request)
    {
        $categories = AssetCategory::all();

        $query = Assets::query()->with('category');

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $assets = $query->get();

        return view('assets.index', compact('assets', 'categories'));
    }


    public function create()
    {
        $categories = AssetCategory::all();
        return view("assets.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "asset_name" => 'required',
            "serial_number" => 'required',
            "category_id" => 'required',
            'quantity' => 'numeric|required'
        ]);

        Assets::create($validated);

        return redirect()->route('asset.index')->with('success', 'Asset created successfully');
    }

    public function edit(Assets $asset)
    {
        $categories = AssetCategory::all();
        return view('assets.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, Assets $asset)
    {
        $validated = $request->validate([
            "asset_name" => 'required',
            "serial_number" => 'required',
            "category_id" => 'required',
            'quantity' => 'numeric|required'
        ]);

        $asset->update($validated);

        return redirect()->route('asset.index')->with('success', 'Asset updated successfully');
    }

    public function destroy(Assets $asset)
    {
        $asset->delete();
        return redirect()->back()->with('success', 'Asset deleted successfully');
    }
}

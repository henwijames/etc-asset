<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\Assets;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function index()
    {
        return view("assets.index");
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
            "category_id" => 'required'
        ]);

        Assets::create($validated);

        return redirect()->route('asset.index')->with('success', 'Asset created successfully');
    }

    public function edit(Assets $assets)
    {
        $categories = AssetCategory::all();
        return view('asset.edit', compact('assets', 'categories'));
    }
}

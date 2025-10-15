<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowTransactionRequest;
use App\Models\Assets;
use App\Models\BorrowTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = BorrowTransaction::orderBy('borrowed_date', 'desc')->get();
        return view("borrow.index", compact("transactions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Assets::where("quantity", '!=', 0)->get();
        return view("borrow.create", compact("assets"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowTransactionRequest $request)
    {
        $validated = $request->validated();

        $asset = Assets::findOrFail($validated["asset_id"]);

        if ($asset->quantity < 1) {
            return back()->with("error", "Asset is out of stock");
        }

        $asset->decrement("quantity");

        BorrowTransaction::create([
            'asset_id' => $validated['asset_id'],
            'borrower_name' => $validated['borrower_name'],
            'logged_by' => Auth::id(),
            'borrowed_date' => $validated['borrowed_date'],
            'returned_date' => $validated['returned_date'] ?? null,
            'status' => $validated['status'] ?? 'Borrowed',
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()->route('borrow.index')->with('success', 'Asset borrowed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowTransaction $borrowTransaction) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowTransaction $borrow)
    {
        $assets = Assets::all();
        return view('borrow.edit', compact('borrow', 'assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BorrowTransactionRequest $request, BorrowTransaction $borrow)
    {
        $validated = $request->validated();

        // If the asset was changed, adjust quantity accordingly
        if ($borrow->asset_id != $validated['asset_id']) {
            // Return the old asset quantity
            $oldAsset = Assets::find($borrow->asset_id);
            if ($oldAsset) {
                $oldAsset->increment('quantity');
            }

            // Decrease the new asset quantity
            $newAsset = Assets::findOrFail($validated['asset_id']);
            if ($newAsset->quantity < 1) {
                return back()->with('error', 'Selected asset is out of stock');
            }
            $newAsset->decrement('quantity');
        }

        // If status changed to 'returned', restore asset quantity
        if (
            $borrow->status !== 'returned' &&
            isset($validated['status']) &&
            $validated['status'] === 'returned'
        ) {
            $asset = Assets::find($validated['asset_id']);
            if ($asset) {
                $asset->increment('quantity');
            }

            $validated['returned_date'] = now();
        }

        // Update the transaction
        $borrow->update([
            'asset_id' => $validated['asset_id'],
            'borrower_name' => $validated['borrower_name'],
            'borrowed_date' => $validated['borrowed_date'],
            'returned_date' => $validated['returned_date'] ?? $borrow->returned_date,
            'status' => $validated['status'] ?? $borrow->status,
            'remarks' => $validated['remarks'] ?? $borrow->remarks,
        ]);

        return redirect()->route('borrow.index')->with('success', 'Borrow transaction updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowTransaction $borrowTransaction)
    {
        //
    }
}

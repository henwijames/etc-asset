@extends('components.layouts.app')
@section('title', 'Edit Borrow Transaction | ETC Asset Management System')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold mb-4">Edit Borrow Transaction</h1>

        <a href="{{ route('borrow.index') }}" class="btn btn-primary">
            <i data-lucide="arrow-left" class="w-4"></i>
            Back to Transactions
        </a>
    </div>

    <div>
        <form action="{{ route('borrow.update', $borrow->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT') {{-- ✅ Important for update routes --}}

            <!-- Borrower Name -->
            <div>
                <x-form-input label="Borrower Name" name="borrower_name" placeholder="Henry James Ribano"
                    value="{{ old('borrower_name', $borrow->borrower_name) }}" />
            </div>

            <!-- Borrowed Date -->
            <div>
                <x-form-input label="Borrowed Date" name="borrowed_date" type="datetime-local"
                    value="{{ old('borrowed_date', \Carbon\Carbon::parse($borrow->borrowed_date)->format('Y-m-d\TH:i')) }}" />
            </div>

            <!-- Remarks -->
            <div>
                <label class="block mb-1 font-medium">Remarks</label>
                <textarea class="textarea textarea-bordered w-full" name="remarks" placeholder="Remarks">{{ old('remarks', $borrow->remarks) }}</textarea>
            </div>

            <!-- Status -->
            <div>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Status</legend>
                    <select class="select select-bordered w-full" name="status">
                        <option value="borrowed" {{ $borrow->status === 'borrowed' ? 'selected' : '' }}>Borrowed
                        </option>
                        <option value="returned" {{ $borrow->status === 'returned' ? 'selected' : '' }}>Returned
                        </option>
                        <option value="overdue" {{ $borrow->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                </fieldset>
            </div>

            <!-- Asset -->
            <div>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Asset</legend>
                    <select class="select select-bordered w-full" name="asset_id">
                        <option disabled>Choose an asset:</option>
                        @forelse ($assets as $a)
                            <option value="{{ $a->id }}" {{ $a->id == $borrow->asset_id ? 'selected' : '' }}>
                                {{ $a->asset_name }}
                            </option>
                        @empty
                            <option disabled>No assets found</option>
                        @endforelse
                    </select>
                </fieldset>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

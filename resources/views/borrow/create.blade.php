@extends('components.layouts.app')
@section('title', 'Borrow Asset | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Borrow Asset</h1>
        <!-- Open the modal using ID.showModal() method -->
        <a href={{ route('borrow.index') }} class="btn btn-primary"><i data-lucide="arrow-left" class="w-4"></i>Back to
            Transactions</a>

    </div>
    <div>
        <form action={{ route('borrow.store') }} method="POST" class="flex flex-col gap-2">
            @csrf
            <div>
                <x-form-input label="Borrower Name" name="borrower_name" placeholder="Henry James Ribano" />
            </div>
            <div>
                <x-form-input label="Borrowed Date" name="borrowed_date" type="datetime-local" />
            </div>
            <div>
                <textarea class="textarea w-full" name="remarks" placeholder="Remarks"></textarea>
            </div>
            <div>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Assets</legend>
                    <select class="select w-full" name="asset_id">
                        <option disabled selected>Choose an asset:</option>
                        @forelse ($assets as $a)
                            <option value="{{ $a->id }}">{{ $a->asset_name }}</option>
                        @empty
                            <option disabled>No assets found</option>
                        @endforelse
                    </select>
                </fieldset>
            </div>
            <div>
                <button class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>


@endsection

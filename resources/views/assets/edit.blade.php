@extends('components.layouts.app')
@section('title', 'Assets | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Create Assets</h1>
        <!-- Open the modal using ID.showModal() method -->
        <a href={{ route('asset.index') }} class="btn btn-primary"><i data-lucide="arrow-left" class="w-4"></i>Back to
            Assets</a>

    </div>
    <div>
        <form action="{{ route('asset.update', $asset->id) }}" method="POST" class="flex flex-col gap-2">
            @csrf
            @method('PUT')
            <div>
                <x-form-input label="Asset Name" name="asset_name" placeholder="HP 125 Wired Mouse"
                    value="{{ $asset->asset_name }}" />
            </div>
            <div>

                <x-form-input label="Serial Number" name="serial_number" placeholder="9CP309366L"
                    value="{{ $asset->serial_number }}" />
            </div>
            <div>
                <x-form-input type="number" label="Quantity" name="quantity" placeholder="50"
                    value="{{ $asset->quantity }}" />
            </div>
            <div>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Categories</legend>
                    <select class="select w-full" name="category_id">
                        <option disabled selected>Choose a category</option>
                        @forelse ($categories as $c)
                            <option value="{{ $c->id }}" {{ $asset->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}</option>
                        @empty
                            <option disabled>No categories found</option>
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

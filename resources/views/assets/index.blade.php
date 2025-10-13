@extends('components.layouts.app')
@section('title', 'Assets | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Assets</h1>
        <div class="flex items-center gap-2">
            <form class="filter text-white">
                <input class="btn btn-secondary btn-square text-white" type="reset" value="×" />
                <input class="btn btn-secondary text-white" type="radio" name="frameworks" aria-label="Svelte" />
                <input class="btn btn-secondary text-white" type="radio" name="frameworks" aria-label="Vue" />
                <input class="btn btn-secondary text-white" type="radio" name="frameworks" aria-label="React" />
            </form>
            <a href={{ route('asset.create') }} class="btn btn-primary">Add Assets</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Asset Name</th>
                    <th>Category</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HP 125 Wired Mouse</td>
                    <td>Mouse</td>
                    <td>9CP309366L</td>
                    <td>
                        {{-- 
                        Available - badge-primary
                        Borrowed - badge-secondary
                        Damaged - badge-accent
                        Lost - badge-error
                        --}}
                        <div class="badge badge-secondary text-white">
                            Borrowed
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info text-white">
                            <i data-lucide="pencil" class="w-3"></i>Edit
                        </button>

                        <button class="btn btn-sm btn-error text-white"><i data-lucide="trash"
                                class="w-3"></i>Delete</button>
                        {{-- <button class="btn btn-sm btn-error text-white" onclick="openDeleteModal('{{ $department->id }}')"><i
                                data-lucide="trash" class="w-3"></i>Delete</button> --}}
                    </td>
                </tr>


            </tbody>
        </table>
    </div>

@endsection

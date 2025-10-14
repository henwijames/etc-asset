@extends('components.layouts.app')
@section('title', 'Assets | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold mb-4">Assets</h1>
        <a href={{ route('asset.create') }} class="btn btn-primary">Add Assets</a>
    </div>

    @if (isset($assets) && $assets->count())
        <form class="filter filter-sm text-white mb-2">
            <!-- Clear filter button -->
            <input class="btn btn-secondary btn-square text-white" type="reset" value="×" />

            @foreach ($categories as $category)
                <input class="btn btn-secondary text-white" type="radio" name="category" aria-label="{{ $category->name }}"
                    value="{{ $category->id }}" />
            @endforeach
        </form>
    @endif



    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Asset Name</th>
                    <th>Category</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $a)
                    <tr class="asset-row" data-category="{{ $a->category_id }}">
                        <td>{{ $a->asset_name }}</td>
                        <td>{{ $a->category->name }}</td>
                        <td>{{ $a->serial_number }}</td>
                        <td>
                            <x-badge :status="$a->status" />
                        </td>
                        <td>
                            {{ $a->quantity }}
                        </td>
                        <td>
                            <a href="{{ route('asset.edit', $a->id) }}" class="btn btn-sm btn-info text-white">
                                <i data-lucide="pencil" class="w-3"></i>Edit
                            </a>

                            {{-- <button class="btn btn-sm btn-error text-white"><i data-lucide="trash"
                                    class="w-3"></i>Delete</button> --}}
                            <button class="btn btn-sm btn-error text-white"
                                onclick="openDeleteModal('{{ $a->id }}')"><i data-lucide="trash"
                                    class="w-3"></i>Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No assets found</td>
                    </tr>
                @endforelse

                <tr class="no-assets hidden">
                    <td colspan="6" class="text-center">No assets found</td>
                </tr>


            </tbody>
        </table>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Confirm Delete</h3>
            <p class="py-4">Are you sure you want to delete this asset?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    <a href="#" class="btn btn-error modal-close">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const filterRadios = document.querySelectorAll('form.filter input[type="radio"]');
        const clearButton = document.querySelector('form.filter input[type="reset"]');
        const assetRows = document.querySelectorAll('.asset-row');
        const noAssetsRow = document.querySelector('.no-assets')

        filterRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const selectedCategory = radio.value;
                let anyVisible = false;

                assetRows.forEach(row => {
                    console.log(row.dataset.category)
                    if (row.dataset.category === selectedCategory) {
                        row.style.display = '';
                        anyVisible = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (anyVisible) {
                    noAssetsRow.classList.add('hidden')
                } else {
                    noAssetsRow.classList.remove('hidden')
                }
            });
        });

        clearButton.addEventListener('click', () => {
            assetRows.forEach(row => row.style.display = '');
            noAssetsRow.classList.add('hidden')
        });

        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            const modal = document.getElementById('deleteModal');

            form.action = `/asset/${id}`

            modal.classList.add('modal-open')
        }
    </script>

@endsection

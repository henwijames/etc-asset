@extends('components.layouts.app')
@section('title', 'Asset Categories | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Categories</h1>
        <!-- Open the modal using ID.showModal() method -->
        <button class="btn btn-primary" onclick="add_categories.showModal()">Add Categories</button>
        <dialog id="add_categories" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Add Categories</h3>
                <form action={{ route('asset-categories.store') }} method="POST">
                    @csrf
                    <div class="space-y-4">
                        <x-form-input name="name" label="Category Name" placeholder="Keyboard" />
                        <button class="btn btn-primary float-right">Add</button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white"
                                onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')">
                                <i data-lucide="pencil" class="w-3"></i>Edit
                            </button>

                            <button class="btn btn-sm btn-error text-white"
                                onclick="openDeleteModal('{{ $category->id }}')"><i data-lucide="trash"
                                    class="w-3"></i>Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No categories found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Edit Category</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-control mt-4 flex flex-col">
                    <label class="label">
                        <span class="label-text">Category Name</span>
                    </label>
                    <input type="text" name="name" id="editName" class="input input-bordered w-full" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="#" class="btn btn-error modal-close">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Confirm Delete</h3>
            <p class="py-4">Are you sure you want to delete this category?</p>
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
        function openEditModal(id, name) {
            const modal = document.getElementById('editModal');
            const input = document.getElementById('editName');
            const form = document.getElementById('editForm');

            input.value = name;
            form.action = `/asset-categories/${id}`;

            modal.classList.add('modal-open')
        }

        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            form.action = `/asset-categories/${id}`

            modal.classList.add('modal-open')
        }
    </script>
@endsection

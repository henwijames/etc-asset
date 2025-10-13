@extends('components.layouts.app')
@section('title', 'Assets | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Departments</h1>
        <!-- Open the modal using ID.showModal() method -->
        <a href={{ route('departments.create') }} class="btn btn-primary">Add Department</a>
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
                @forelse ($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white"
                                onclick="openEditModal('{{ $department->id }}', '{{ $department->name }}')">
                                <i data-lucide="pencil" class="w-3"></i>Edit
                            </button>

                            <button class="btn btn-sm btn-error text-white"
                                onclick="openDeleteModal('{{ $department->id }}')"><i data-lucide="trash"
                                    class="w-3"></i>Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No departments found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Edit Department</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-control mt-4 flex flex-col">
                    <label class="label">
                        <span class="label-text">Department Name</span>
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
            <p class="py-4">Are you sure you want to delete this department?</p>
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

@endsection

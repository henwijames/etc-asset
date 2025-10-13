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
                    <th>Asset Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->


            </tbody>
        </table>
    </div>

@endsection

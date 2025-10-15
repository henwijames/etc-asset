@extends('components.layouts.app')
@section('title', 'Borrow | ETC Asset Management System')
@section('content')
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-bold mb-4">Borrow</h1>
        <!-- Open the modal using ID.showModal() method -->
        <a href="{{ route('borrow.create') }}" class="btn btn-primary">Borrow Asset</a>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Borrower Name</th>
                    <th>Asset Name</th>
                    <th>Logged By</th>
                    <th>Borrowed Date</th>
                    <th>Returned Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $t)
                    <tr>
                        <td>{{ $t->borrower_name }}</td>
                        <td>{{ $t->asset->asset_name }}</td>
                        <td>{{ $t->user->name }}</td>
                        <td>{{ $t->borrowed_date }}</td>
                        <td>
                            @if (empty($t->returned_date))
                                {{ 'Not yet returned' }}
                            @else
                                {{ $t->returned_date }}
                            @endif
                        </td>
                        <td>
                            <x-badge :status="$t->status" />
                        </td>
                        <td>
                            <a href="{{ route('borrow.edit', $t->id) }}" class="btn btn-sm btn-info text-white">
                                <i data-lucide="pencil" class="w-3"></i>Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No borrow transactions found</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>


@endsection

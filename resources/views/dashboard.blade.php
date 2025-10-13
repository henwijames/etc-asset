@extends('components.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Total Assets</h2>
            <p class="text-xl"></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Borrowed Items</h2>
            <p class="text-xl"></p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold">Staff Users</h2>
            <p class="text-xl"></p>
        </div>
    </div>
@endsection

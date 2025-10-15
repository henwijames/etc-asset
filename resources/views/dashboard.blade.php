@extends('components.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                <div>
                    <h2 class="font-bold">Total Assets</h2>
                    <p class="text-xl">{{ $assetCount }}</p>
                </div>

                <i data-lucide="mouse"></i>
            </div>
            <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                <div>
                    <h2 class="font-bold">Borrowed Items</h2>
                    <p class="text-xl">{{ $borrowedCount }}</p>
                </div>
                <i data-lucide="archive-x"></i>
            </div>
            <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                <div>

                    <h2 class="font-bold">Returned assets</h2>
                    <p class="text-xl">{{ $returnedCount }}</p>
                </div>
                <i data-lucide="archive-restore"></i>
            </div>
            <!-- Charts -->
        </div>
        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
            <!-- Chart 1 -->
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Borrowed Assets Per Month</h2>
                <canvas id="borrowChart" height="100"></canvas>
            </div>

            <!-- Chart 2 -->
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Returned Assets Per Month</h2>
                <canvas id="returnChart" height="100"></canvas>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Borrowed Chart
            const borrowCtx = document.getElementById('borrowChart');
            new Chart(borrowCtx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Borrowed',
                        data: @json($borrowedTotals),
                        backgroundColor: 'rgba(37, 99, 235, 0.7)',
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Returned Chart
            const returnCtx = document.getElementById('returnChart');
            new Chart(returnCtx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Returned',
                        data: @json($returnedTotals),
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection

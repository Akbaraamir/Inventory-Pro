<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-l-4 border-blue-500 p-6 transition hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Products</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-l-4 border-red-500 p-6 transition hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Low Stock Alerts</p>
                            <p class="text-2xl font-bold text-gray-900 text-red-600">{{ $lowStockCount }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-l-4 border-green-500 p-6 transition hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Value</p>
                            <p class="text-2xl font-bold text-gray-900 text-green-700">${{ number_format($totalValue, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Stock Distribution</h3>
                        <p class="text-sm text-gray-500">Products grouped by category</p>
                    </div>
                </div>
                
                <div class="relative" style="height: 350px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoryChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        data: {!! json_encode($counts) !!},
                        backgroundColor: [
                            '#3b82f6', // Blue
                            '#10b981', // Green
                            '#f59e0b', // Amber
                            '#6366f1', // Indigo
                            '#ef4444', // Red
                            '#ec4899'  // Pink
                        ],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '75%', // This makes the hole in the middle larger (sleek look)
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 30,
                                usePointStyle: true,
                                font: {
                                    size: 13,
                                    family: "'Figtree', sans-serif"
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — SPORT.CPE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0F172A',
                        accentOrange: '#FF6B00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 font-sans text-slate-800">

    <!-- Admin Top Navbar (Matching Figma Frame 10) -->
    <header class="bg-primary text-white">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-xl font-black">🏃 SPORT.CPE</span>
                <span class="bg-blue-600/80 text-white text-xs font-bold px-2.5 py-0.5 rounded-full">Admin Portal</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-300">
                    <span class="w-7 h-7 rounded-full bg-slate-700 flex items-center justify-center font-bold text-white text-xs">AD</span>
                    <span>Admin (admin@cpe.eng.cmu.ac.th)</span>
                </div>
                <a href="{{ route('home') }}" class="text-accentOrange hover:underline font-bold text-sm flex items-center gap-1">
                    Back to Home →
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-black text-slate-900 mb-6">ADMIN DASHBOARD</h1>

        <!-- 4 Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 text-2xl flex items-center justify-center">💰</div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase">Total Revenue</div>
                    <div class="text-2xl font-black text-slate-900">฿{{ number_format($totalRevenue, 2) }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 text-2xl flex items-center justify-center">📦</div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase">Total Orders</div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalOrders }} Orders</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 text-2xl flex items-center justify-center">🏷️</div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase">Catalog Products</div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalProducts }} Items</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-700 text-2xl flex items-center justify-center">👥</div>
                <div>
                    <div class="text-xs font-bold text-slate-400 uppercase">Registered Members</div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalCustomers }} Customers</div>
                </div>
            </div>
        </div>

        <!-- 2-Column Grid: Orders (~65%) & Low Stock (~35%) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Recent Customer Orders -->
            <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900 text-base">Recent Customer Orders</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs text-slate-500 font-bold uppercase border-b">
                            <tr>
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Customer Name</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Total Amount</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-bold text-slate-900">#1012</td>
                                <td class="p-4">Somsak Rattanakul</td>
                                <td class="p-4 text-xs text-slate-500">Oct 31, 2026</td>
                                <td class="p-4 font-bold">฿4,200.00</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Cancelled</span></td>
                                <td class="p-4 text-xs font-bold text-slate-600 hover:underline cursor-pointer">View</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-bold text-slate-900">#1011</td>
                                <td class="p-4">Kongkai Jai-dee</td>
                                <td class="p-4 text-xs text-slate-500">Oct 30, 2026</td>
                                <td class="p-4 font-bold">฿7,565.00</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700">Pending</span></td>
                                <td class="p-4 text-xs font-bold text-accentOrange hover:underline cursor-pointer">Update Status ∨</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-bold text-slate-900">#1010</td>
                                <td class="p-4">Ploypailin Chaisri</td>
                                <td class="p-4 text-xs text-slate-500">Oct 29, 2026</td>
                                <td class="p-4 font-bold">฿6,430.00</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700">Pending</span></td>
                                <td class="p-4 text-xs font-bold text-accentOrange hover:underline cursor-pointer">Update Status ∨</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-bold text-slate-900">#1009</td>
                                <td class="p-4">Thanawat Siriwat</td>
                                <td class="p-4 text-xs text-slate-500">Oct 28, 2026</td>
                                <td class="p-4 font-bold">฿4,300.00</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Shipped</span></td>
                                <td class="p-4 text-xs font-bold text-slate-600 hover:underline cursor-pointer">View</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-bold text-slate-900">#1008</td>
                                <td class="p-4">Arisa Wongsuwan</td>
                                <td class="p-4 text-xs text-slate-500">Oct 27, 2026</td>
                                <td class="p-4 font-bold">฿6,280.00</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">Delivered</span></td>
                                <td class="p-4 text-xs font-bold text-slate-600 hover:underline cursor-pointer">View</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Low Stock Alert -->
            <div class="lg:col-span-4 bg-orange-50/50 rounded-2xl border border-orange-200 p-6 shadow-sm space-y-4">
                <h2 class="font-bold text-slate-900 text-base flex items-center gap-2">
                    <span>⚠️</span> Low Stock Alert (Stock ≤ 10)
                </h2>
                <div class="space-y-3 text-xs md:text-sm">
                    <div class="bg-white p-3.5 rounded-xl border border-orange-100 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-900 block">1. Coleman Tough Screen Tent</span>
                            <span class="text-red-600 font-bold text-xs bg-red-100 px-2 py-0.5 rounded">4 left</span>
                        </div>
                        <button class="bg-primary hover:bg-slate-800 text-white font-bold px-3 py-1.5 rounded-lg text-xs">
                            [Restock]
                        </button>
                    </div>

                    <div class="bg-white p-3.5 rounded-xl border border-orange-100 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-900 block">2. Rogue Echo Bumper Plates</span>
                            <span class="text-orange-600 font-bold text-xs bg-orange-100 px-2 py-0.5 rounded">5 left</span>
                        </div>
                        <button class="bg-primary hover:bg-slate-800 text-white font-bold px-3 py-1.5 rounded-lg text-xs">
                            [Restock]
                        </button>
                    </div>

                    <div class="bg-white p-3.5 rounded-xl border border-orange-100 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-900 block">3. Garmin Forerunner 965</span>
                            <span class="text-orange-600 font-bold text-xs bg-orange-100 px-2 py-0.5 rounded">5 left</span>
                        </div>
                        <button class="bg-primary hover:bg-slate-800 text-white font-bold px-3 py-1.5 rounded-lg text-xs">
                            [Restock]
                        </button>
                    </div>

                    <div class="bg-white p-3.5 rounded-xl border border-orange-100 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-900 block">4. Bowflex 552 Dumbbells</span>
                            <span class="text-orange-600 font-bold text-xs bg-orange-100 px-2 py-0.5 rounded">6 left</span>
                        </div>
                        <button class="bg-primary hover:bg-slate-800 text-white font-bold px-3 py-1.5 rounded-lg text-xs">
                            [Restock]
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>

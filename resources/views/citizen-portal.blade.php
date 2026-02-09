<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Portal - Kano State Public Procurement Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-green-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold">Kano State Public Procurement Platform - Citizen Portal</h1>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="#" class="text-gray-300 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tenders</a>
                            <a href="#" class="text-gray-300 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contracts</a>
                            <a href="#" class="text-gray-300 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Spending</a>
                            <a href="#" class="text-gray-300 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contractors</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm">Public Portal</span>
                        <button class="bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-600">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Transparent Procurement</h1>
                <p class="text-xl mb-8">Track government spending and contracts in real-time</p>
                <div class="flex justify-center space-x-4">
                    <button class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-search mr-2"></i>Search Contracts
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition duration-200">
                        <i class="fas fa-chart-bar mr-2"></i>View Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-file-contract text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900">150</h3>
                <p class="text-gray-600">Total Tenders</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-handshake text-4xl text-green-600 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900">300</h3>
                <p class="text-gray-600">Awarded Contracts</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-dollar-sign text-4xl text-yellow-600 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900">₦2.5B</h3>
                <p class="text-gray-600">Total Spent</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fas fa-building text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900">15</h3>
                <p class="text-gray-600">MDAs</p>
            </div>
        </div>

        <!-- Recent Contracts -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Recent Contract Awards</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Construction of Primary Health Center</h3>
                            <p class="text-sm text-gray-600">Ministry of Health • Construction Works Ltd</p>
                            <p class="text-sm text-gray-500">₦50,000,000 • Awarded: Dec 15, 2024</p>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Active</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">School Furniture Supply</h3>
                            <p class="text-sm text-gray-600">Ministry of Education • Furniture Solutions Ltd</p>
                            <p class="text-sm text-gray-500">₦25,000,000 • Awarded: Dec 10, 2024</p>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">In Progress</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">IT Infrastructure Upgrade</h3>
                            <p class="text-sm text-gray-600">Ministry of Health • Tech Solutions Ltd</p>
                            <p class="text-sm text-gray-500">₦15,000,000 • Awarded: Dec 5, 2024</p>
                        </div>
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Completed</span>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                        View All Contracts
                    </button>
                </div>
            </div>
        </div>

        <!-- MDA Spending -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Top Spending MDAs</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Ministry of Works</p>
                                <p class="text-sm text-gray-600">₦800M</p>
                            </div>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Ministry of Education</p>
                                <p class="text-sm text-gray-600">₦600M</p>
                            </div>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Ministry of Health</p>
                                <p class="text-sm text-gray-600">₦400M</p>
                            </div>
                            <div class="w-32 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-600 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Top Contractors</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Construction Works Ltd</p>
                                <p class="text-sm text-gray-600">₦200M • 5 contracts</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Tech Solutions Ltd</p>
                                <p class="text-sm text-gray-600">₦150M • 8 contracts</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Med Supplies Co</p>
                                <p class="text-sm text-gray-600">₦100M • 3 contracts</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kano State E-Procurement</h3>
                    <p class="text-gray-300">Promoting transparency and accountability in government procurement.</p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Public Information</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Open Tenders</a></li>
                        <li><a href="#" class="hover:text-white">Awarded Contracts</a></li>
                        <li><a href="#" class="hover:text-white">Spending Reports</a></li>
                        <li><a href="#" class="hover:text-white">Vendor Directory</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Procurement Guidelines</a></li>
                        <li><a href="#" class="hover:text-white">Vendor Registration</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Contact</h4>
                    <div class="text-gray-300 space-y-2">
                        <p><i class="fas fa-envelope mr-2"></i>info@kanoprocurement.gov.ng</p>
                        <p><i class="fas fa-phone mr-2"></i>+234 64 123456</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Kano State, Nigeria</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2024 Kano State Government. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>


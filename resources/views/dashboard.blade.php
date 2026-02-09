<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kano State E-Procurement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold">Digital Public Procurement Platform</h1>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="bg-blue-800 text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="#" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tenders</a>
                            <a href="#" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contracts</a>
                            <a href="#" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vendors</a>
                            <a href="#" class="text-gray-300 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reports</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm">Welcome, Admin</span>
                        <button class="bg-blue-800 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="px-4 py-6 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Overview</h2>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Tenders -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-file-contract text-2xl text-blue-600"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Tenders</dt>
                                        <dd class="text-lg font-medium text-gray-900">150</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">View all</a>
                            </div>
                        </div>
                    </div>

                    <!-- Active Contracts -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-handshake text-2xl text-green-600"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Active Contracts</dt>
                                        <dd class="text-lg font-medium text-gray-900">45</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-green-600 hover:text-green-500">View all</a>
                            </div>
                        </div>
                    </div>

                    <!-- Registered Vendors -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-users text-2xl text-purple-600"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Registered Vendors</dt>
                                        <dd class="text-lg font-medium text-gray-900">500</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-purple-600 hover:text-purple-500">View all</a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Spent -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-dollar-sign text-2xl text-yellow-600"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Spent</dt>
                                        <dd class="text-lg font-medium text-gray-900">₦2.5B</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-yellow-600 hover:text-yellow-500">View details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Tenders -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Tenders</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Construction of Primary Health Center</p>
                                        <p class="text-sm text-gray-500">Ministry of Health • ₦50M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Open
                                    </span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">School Furniture Supply</p>
                                        <p class="text-sm text-gray-500">Ministry of Education • ₦25M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Published
                                    </span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Road Construction Project</p>
                                        <p class="text-sm text-gray-500">Ministry of Works • ₦200M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Under Evaluation
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Contracts -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Contracts</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">IT Infrastructure Upgrade</p>
                                        <p class="text-sm text-gray-500">Tech Solutions Ltd • ₦15M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Medical Equipment Supply</p>
                                        <p class="text-sm text-gray-500">Med Supplies Co • ₦30M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        In Progress
                                    </span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Building Renovation</p>
                                        <p class="text-sm text-gray-500">Construction Works Ltd • ₦75M</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Completed
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <button class="bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Create Tender
                        </button>
                        <button class="bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-user-plus mr-2"></i>Add Vendor
                        </button>
                        <button class="bg-purple-600 text-white px-4 py-3 rounded-lg hover:bg-purple-700 transition duration-200">
                            <i class="fas fa-file-alt mr-2"></i>Generate Report
                        </button>
                        <button class="bg-yellow-600 text-white px-4 py-3 rounded-lg hover:bg-yellow-700 transition duration-200">
                            <i class="fas fa-cog mr-2"></i>System Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kano State E-Procurement</h3>
                    <p class="text-gray-300">Transparent, efficient, and accountable procurement system for Kano State Government.</p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Citizen Portal</a></li>
                        <li><a href="#" class="hover:text-white">Vendor Registration</a></li>
                        <li><a href="#" class="hover:text-white">Tender Notices</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Contact Info</h4>
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


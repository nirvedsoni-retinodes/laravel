<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Booking Platform - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                <i class="fas fa-calendar-check text-blue-600"></i>
                Laravel Booking Platform
            </h1>
            <p class="text-gray-600 text-lg">Welcome to your new sports facility booking platform!</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-2xl mx-auto">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Admin Panel -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-user-shield text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Admin Panel</h3>
                    </div>
                    <p class="text-gray-600 text-center mb-4">Full system administration and management</p>
                    <div class="text-center">
                        <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            Access Admin
                        </a>
                    </div>
                </div>

                <!-- Venue Management -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-building text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Venue Management</h3>
                    </div>
                    <p class="text-gray-600 text-center mb-4">Manage sports venues and facilities</p>
                    <div class="text-center">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            Manage Venues
                        </a>
                    </div>
                </div>

                <!-- Booking System -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-calendar-plus text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Booking System</h3>
                    </div>
                    <p class="text-gray-600 text-center mb-4">Create and manage facility bookings</p>
                    <div class="text-center">
                        <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            View Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="max-w-4xl mx-auto mt-12">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                    <i class="fas fa-key text-blue-600 mr-2"></i>
                    Demo Accounts Available
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Access</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">admin@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">password</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Full System Access</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Manager
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">manager@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">password</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Venue Management</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Player
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">player@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">password</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Booking Access</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-500">
            <p>&copy; {{ date('Y') }} Laravel Booking Platform. All rights reserved.</p>
            <p class="text-sm mt-2">Built with Laravel and Tailwind CSS</p>
        </div>
    </div>
</body>
</html>

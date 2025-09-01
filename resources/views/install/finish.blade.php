<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-6xl text-green-600"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            Installation Complete!
        </h2>
        <p class="text-gray-600">Your Laravel Booking Platform is ready to use</p>
    </div>

    <!-- Success Summary -->
    <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-green-800 mb-4">
            <i class="fas fa-tasks text-green-600 mr-2"></i>
            What was completed:
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">System requirements verified</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">Database configured and created</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">Database tables created</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">Demo data seeded</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">Admin account created</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <span class="text-green-700">Site configuration updated</span>
            </div>
        </div>
    </div>

    <!-- Demo Data Information -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-blue-800 mb-4">
            <i class="fas fa-database text-blue-600 mr-2"></i>
            Demo Data Created:
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center">
                <i class="fas fa-users text-blue-600 mr-3"></i>
                <span class="text-blue-700">Admin, Manager, and Player accounts</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-building text-blue-600 mr-3"></i>
                <span class="text-blue-700">Sample venues and facilities</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-calendar text-blue-600 mr-3"></i>
                <span class="text-blue-700">Operating schedules</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-bookmark text-blue-600 mr-3"></i>
                <span class="text-blue-700">Sample bookings</span>
            </div>
        </div>
    </div>

    <!-- Demo Credentials -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-yellow-800 mb-4">
            <i class="fas fa-key text-yellow-600 mr-2"></i>
            Demo Credentials:
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-yellow-200 rounded-lg">
                <thead class="bg-yellow-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-yellow-800 font-semibold">Role</th>
                        <th class="px-4 py-2 text-left text-yellow-800 font-semibold">Email</th>
                        <th class="px-4 py-2 text-left text-yellow-800 font-semibold">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-yellow-200">
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Admin
                            </span>
                        </td>
                        <td class="px-4 py-2 font-mono text-sm">admin@example.com</td>
                        <td class="px-4 py-2 font-mono text-sm">password</td>
                    </tr>
                    <tr class="border-b border-yellow-200">
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Manager
                            </span>
                        </td>
                        <td class="px-4 py-2 font-mono text-sm">manager@example.com</td>
                        <td class="px-4 py-2 font-mono text-sm">password</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Player
                            </span>
                        </td>
                        <td class="px-4 py-2 font-mono text-sm">player@example.com</td>
                        <td class="px-4 py-2 font-mono text-sm">password</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Next Steps -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-rocket text-gray-600 mr-2"></i>
            Next Steps:
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
            <li>Click the button below to access your application</li>
            <li>Log in with your admin account or demo credentials</li>
            <li>Explore the features: venues, facilities, bookings</li>
            <li>Configure Razorpay and WhatsApp API keys in settings</li>
            <li>Customize the platform to match your needs</li>
        </ol>
    </div>

    <!-- Action Buttons -->
    <div class="text-center">
        <form method="POST" action="{{ route('install.step', 4) }}" class="inline-block">
            @csrf
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-12 rounded-lg text-xl transition duration-200 shadow-lg">
                <i class="fas fa-external-link-alt mr-3"></i>
                Launch Your Application
            </button>
        </form>
    </div>

    <!-- Additional Information -->
    <div class="mt-8 text-center text-gray-600">
        <p class="mb-2">
            <i class="fas fa-info-circle mr-2"></i>
            Your application is now fully installed and ready to use.
        </p>
        <p class="text-sm">
            If you need to reinstall, simply delete the <code class="bg-gray-200 px-1 rounded">storage/installed</code> file.
        </p>
    </div>
</div>
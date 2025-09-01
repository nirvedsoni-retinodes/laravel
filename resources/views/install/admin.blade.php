<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-user-shield text-blue-600"></i>
            Admin Account & Site Configuration
        </h2>
        <p class="text-gray-600">Create your admin account and configure your site settings</p>
    </div>

    <!-- Success Message -->
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span class="font-medium">Database setup completed successfully! Now let's create your admin account.</span>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-medium">Please fix the following errors:</span>
            </div>
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Admin Setup Form -->
    <form method="POST" action="{{ route('install.step', 3) }}" class="space-y-6">
        @csrf
        
        <!-- Site Configuration Section -->
        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-cog text-blue-600 mr-2"></i>
                Site Configuration
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag text-blue-600 mr-2"></i>
                        Site Name
                    </label>
                    <input type="text" 
                           id="site_name" 
                           name="site_name" 
                           value="{{ old('site_name', 'Laravel Booking Platform') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Laravel Booking Platform"
                           required>
                    <p class="text-sm text-gray-500 mt-1">The name of your booking platform</p>
                </div>

                <!-- Site URL -->
                <div>
                    <label for="site_url" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-link text-blue-600 mr-2"></i>
                        Site URL
                    </label>
                    <input type="url" 
                           id="site_url" 
                           name="site_url" 
                           value="{{ old('site_url', 'http://localhost') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="http://localhost"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Your website URL (e.g., http://localhost for XAMPP)</p>
                </div>
            </div>
        </div>

        <!-- Admin Account Section -->
        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-user-shield text-blue-600 mr-2"></i>
                Admin Account
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Admin Name -->
                <div>
                    <label for="admin_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-600 mr-2"></i>
                        Admin Name
                    </label>
                    <input type="text" 
                           id="admin_name" 
                           name="admin_name" 
                           value="{{ old('admin_name', 'Administrator') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Administrator"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Your full name</p>
                </div>

                <!-- Admin Email -->
                <div>
                    <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>
                        Admin Email
                    </label>
                    <input type="email" 
                           id="admin_email" 
                           name="admin_email" 
                           value="{{ old('admin_email', 'admin@example.com') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="admin@example.com"
                           required>
                    <p class="text-sm text-gray-500 mt-1">This will be your login email</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Admin Password -->
                <div>
                    <label for="admin_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-600 mr-2"></i>
                        Admin Password
                    </label>
                    <input type="password" 
                           id="admin_password" 
                           name="admin_password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter your password"
                           required
                           minlength="8">
                    <p class="text-sm text-gray-500 mt-1">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="admin_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-600 mr-2"></i>
                        Confirm Password
                    </label>
                    <input type="password" 
                           id="admin_password_confirmation" 
                           name="admin_password_confirmation" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Confirm your password"
                           required
                           minlength="8">
                    <p class="text-sm text-gray-500 mt-1">Must match your password</p>
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                <div>
                    <h4 class="font-semibold text-blue-800 mb-2">What happens next?</h4>
                    <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                        <li>Your admin account will be created with full system access</li>
                        <li>Demo data will be seeded (venues, facilities, sample bookings)</li>
                        <li>All system features will be enabled and ready to use</li>
                        <li>You'll be redirected to the main application</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between pt-6">
            <a href="{{ route('install.step', 2) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous
            </a>
            
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                <i class="fas fa-arrow-right mr-2"></i>
                Complete Installation
            </button>
        </div>
    </form>
</div>
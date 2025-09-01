<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-database text-blue-600"></i>
            Database Configuration
        </h2>
        <p class="text-gray-600">Configure your database connection and setup the database</p>
    </div>

    <!-- XAMPP Information -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
            <div>
                <h4 class="font-semibold text-blue-800 mb-2">XAMPP Users</h4>
                <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                    <li><strong>Host:</strong> localhost or 127.0.0.1</li>
                    <li><strong>Port:</strong> 3306 (default MySQL port)</li>
                    <li><strong>Username:</strong> root</li>
                    <li><strong>Password:</strong> (leave empty for XAMPP default)</li>
                    <li><strong>Database:</strong> Will be created automatically</li>
                </ul>
            </div>
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

    <!-- Database Form -->
    <form method="POST" action="{{ route('install.step', 2) }}" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Database Host -->
            <div>
                <label for="db_host" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-server text-blue-600 mr-2"></i>
                    Database Host
                </label>
                <input type="text" 
                       id="db_host" 
                       name="db_host" 
                       value="{{ old('db_host', 'localhost') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="localhost"
                       required>
                <p class="text-sm text-gray-500 mt-1">Usually 'localhost' or '127.0.0.1'</p>
            </div>

            <!-- Database Port -->
            <div>
                <label for="db_port" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-network-wired text-blue-600 mr-2"></i>
                    Database Port
                </label>
                <input type="number" 
                       id="db_port" 
                       name="db_port" 
                       value="{{ old('db_port', '3306') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="3306"
                       required>
                <p class="text-sm text-gray-500 mt-1">Default MySQL port is 3306</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Database Name -->
            <div>
                <label for="db_database" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-database text-blue-600 mr-2"></i>
                    Database Name
                </label>
                <input type="text" 
                       id="db_database" 
                       name="db_database" 
                       value="{{ old('db_database', 'laravel_booking') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="laravel_booking"
                       required>
                <p class="text-sm text-gray-500 mt-1">Database will be created automatically</p>
            </div>

            <!-- Database Username -->
            <div>
                <label for="db_username" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user text-blue-600 mr-2"></i>
                    Database Username
                </label>
                <input type="text" 
                       id="db_username" 
                       name="db_username" 
                       value="{{ old('db_username', 'root') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="root"
                       required>
                <p class="text-sm text-gray-500 mt-1">Usually 'root' for XAMPP</p>
            </div>
        </div>

        <!-- Database Password -->
        <div>
            <label for="db_password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock text-blue-600 mr-2"></i>
                Database Password
            </label>
            <input type="password" 
                   id="db_password" 
                   name="db_password" 
                   value="{{ old('db_password') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Leave empty for XAMPP default">
            <p class="text-sm text-gray-500 mt-1">Leave empty if no password is set (common for XAMPP)</p>
        </div>

        <!-- Test Connection Button -->
        <div class="text-center">
            <button type="button" 
                    onclick="testConnection()" 
                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200 mr-4">
                <i class="fas fa-plug mr-2"></i>
                Test Connection
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between pt-6">
            <a href="{{ route('install.step', 1) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous
            </a>
            
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                <i class="fas fa-arrow-right mr-2"></i>
                Continue to Admin Setup
            </button>
        </div>
    </form>
</div>

<script>
function testConnection() {
    const formData = new FormData();
    formData.append('db_host', document.getElementById('db_host').value);
    formData.append('db_port', document.getElementById('db_port').value);
    formData.append('db_database', document.getElementById('db_database').value);
    formData.append('db_username', document.getElementById('db_username').value);
    formData.append('db_password', document.getElementById('db_password').value);
    formData.append('_token', '{{ csrf_token() }}');

    // Show loading state
    const testBtn = event.target;
    const originalText = testBtn.innerHTML;
    testBtn.disabled = true;
    testBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Testing...';

    fetch('{{ route("install.step", 2) }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Database connection successful!');
        } else {
            alert('❌ Database connection failed: ' + data.message);
        }
    })
    .catch(error => {
        alert('❌ Error testing connection: ' + error.message);
    })
    .finally(() => {
        testBtn.disabled = false;
        testBtn.innerHTML = originalText;
    });
}
</script>
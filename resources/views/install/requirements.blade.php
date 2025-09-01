<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-clipboard-check text-blue-600"></i>
            System Requirements
        </h2>
        <p class="text-gray-600">Let's check if your system meets all requirements</p>
    </div>

    @if($data['passed'])
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span class="font-medium">All requirements are met! Your system is ready for installation.</span>
            </div>
        </div>
    @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-medium">Some requirements are not met. Please fix them before continuing.</span>
            </div>
        </div>
    @endif

    <!-- PHP Version Check -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-code text-blue-600"></i>
            PHP Version
        </h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <span class="text-gray-700">Current PHP Version:</span>
                <span class="font-mono text-lg {{ version_compare($data['php_version'], $data['required_php'], '>=') ? 'text-green-600' : 'text-red-600' }}">
                    {{ $data['php_version'] }}
                </span>
            </div>
            <div class="flex items-center justify-between mt-2">
                <span class="text-gray-700">Required Version:</span>
                <span class="font-mono text-lg text-gray-800">{{ $data['required_php'] }}+</span>
            </div>
        </div>
    </div>

    <!-- PHP Extensions Check -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-puzzle-piece text-blue-600"></i>
            PHP Extensions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($data['extensions'] as $extension)
                @php
                    $loaded = extension_loaded($extension);
                @endphp
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700">{{ $extension }}</span>
                        <span class="{{ $loaded ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $loaded ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Directory Permissions Check -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-folder text-blue-600"></i>
            Directory Permissions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($data['writable_dirs'] as $dir)
                @php
                    $writable = is_writable($dir);
                @endphp
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700">{{ $dir }}</span>
                        <span class="{{ $writable ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $writable ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Error Messages -->
    @if(!empty($data['errors']))
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-red-800 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
                Issues Found
            </h3>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <ul class="list-disc list-inside text-red-700 space-y-2">
                    @foreach($data['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="text-center">
        @if($data['passed'])
            <form method="POST" action="{{ route('install.step', 1) }}">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Continue to Database Setup
                </button>
            </form>
        @else
            <div class="space-y-4">
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Please fix the issues above before continuing with the installation.</span>
                    </div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Common Solutions:</h4>
                    <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                        <li>For XAMPP: Make sure you're using PHP 8.1+</li>
                        <li>For extensions: Enable required extensions in php.ini</li>
                        <li>For permissions: Set directories to 755 or 775</li>
                        <li>For Windows: Run as Administrator if needed</li>
                    </ul>
                </div>

                <button type="button" onclick="location.reload()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-200">
                    <i class="fas fa-redo mr-2"></i>
                    Recheck Requirements
                </button>
            </div>
        @endif
    </div>
</div>
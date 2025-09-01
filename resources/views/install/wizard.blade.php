<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Booking Platform - Installation Wizard</title>
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
            <p class="text-gray-600 text-lg">Installation Wizard</p>
        </div>

        <!-- Progress Bar -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full {{ $step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center font-bold">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="ml-2 font-medium {{ $step >= 1 ? 'text-blue-600' : 'text-gray-500' }}">Requirements</span>
                        </div>
                        <div class="w-16 h-1 {{ $step >= 2 ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full {{ $step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center font-bold">
                                <i class="fas fa-database"></i>
                            </div>
                            <span class="ml-2 font-medium {{ $step >= 2 ? 'text-blue-600' : 'text-gray-500' }}">Database</span>
                        </div>
                        <div class="w-16 h-1 {{ $step >= 3 ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full {{ $step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center font-bold">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="ml-2 font-medium {{ $step >= 3 ? 'text-blue-600' : 'text-gray-500' }}">Admin</span>
                        </div>
                        <div class="w-16 h-1 {{ $step >= 4 ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full {{ $step >= 4 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center font-bold">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <span class="ml-2 font-medium {{ $step >= 4 ? 'text-blue-600' : 'text-gray-500' }}">Finish</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step Content -->
        <div class="max-w-4xl mx-auto">
            @if ($step == 1)
                @include('install.requirements')
            @elseif ($step == 2)
                @include('install.database')
            @elseif ($step == 3)
                @include('install.admin')
            @elseif ($step == 4)
                @include('install.finish')
            @endif
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500">
            <p>&copy; {{ date('Y') }} Laravel Booking Platform. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Auto-submit forms on step completion
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    }
                });
            });
        });
    </script>
</body>
</html>

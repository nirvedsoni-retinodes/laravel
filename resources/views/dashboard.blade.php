<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Total Bookings -->
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Total Bookings</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ Auth::user()->bookings()->count() }}</p>
                        </div>

                        <!-- Upcoming Bookings -->
                        <div class="bg-green-100 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Upcoming Bookings</h3>
                            <p class="text-3xl font-bold text-green-600">
                                {{ Auth::user()->bookings()->where('start_time', '>', now())->count() }}
                            </p>
                        </div>

                        <!-- Total Spent -->
                        <div class="bg-purple-100 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-purple-800">Total Spent</h3>
                            <p class="text-3xl font-bold text-purple-600">
                                ₹{{ number_format(Auth::user()->bookings()->where('payment_status', 'paid')->sum('total_amount'), 2) }}
                            </p>
                        </div>
                    </div>

                    @if(Auth::user()->hasRole('admin'))
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.bookings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Booking
                                </a>
                                <a href="{{ route('admin.users') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Manage Users
                                </a>
                                <a href="{{ route('admin.reports') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                    View Reports
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('manager'))
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Managed Venues</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach(Auth::user()->managedVenues as $venue)
                                    <div class="border p-4 rounded-lg">
                                        <h4 class="font-semibold">{{ $venue->name }}</h4>
                                        <p class="text-gray-600">{{ $venue->address }}, {{ $venue->city }}</p>
                                        <p class="text-sm text-gray-500">{{ $venue->facilities()->count() }} facilities</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Bookings</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Code</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facility</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(Auth::user()->bookings()->latest()->take(5)->get() as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $booking->booking_code }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $booking->facility->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $booking->formatted_start_time }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ₹{{ number_format($booking->total_amount, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

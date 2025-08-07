@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-6">❤️ My Favorite Activities</h1>

        @if ($favorites->isEmpty())
            <p class="text-gray-600">You have no favorite activities yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($favorites as $favorite)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{ $favorite->name }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-4">
                            {{ $favorite->short_description ?? 'No description provided.' }}
                        </p>

                        <a href="{{ route('activities.show', $favorite->id) }}" class="inline-block text-sm text-blue-600 hover:underline">
                            🔍 View Details
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                {{ $activity->name }}
            </h1>

            <div class="space-y-3 text-gray-700 text-base">
                <p>
                    <strong class="text-gray-900">Description:</strong><br>
                    {{ $activity->description }}
                </p>

                <p>
                    <strong class="text-gray-900">Location:</strong><br>
                    📍 {{ $activity->location }}
                </p>

                <p>
                    <strong class="text-gray-900">Registration URL:</strong><br>
                    🌐 <a href="{{ $activity->registration_url }}" class="text-blue-600 hover:underline" target="_blank">
                        {{ parse_url($activity->registration_url, PHP_URL_HOST) ?? $activity->registration_url }}
                    </a>
                </p>
            </div>

            @if($activity->media && count($activity->media))
                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Gallery</h2>
                    <div class="flex flex-wrap gap-4">
                        @foreach($activity->media as $media)
                            <img
                                src="{{ asset('storage/' . $media) }}"
                                alt="Activity image"
                                class="w-40 h-40 object-cover rounded border"
                            >
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('activities.index') }}" class="text-blue-600 hover:underline text-sm">
                    ← Back to Activities
                </a>
            </div>
        </div>
    </div>
@endsection

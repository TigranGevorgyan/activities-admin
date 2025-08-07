@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">All Participants</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($participants as $participant)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $participant->name }}</h3>

                    @if ($participant->website_url)
                        <p class="text-sm text-blue-600 mb-1">
                            🌐 <a href="{{ $participant->website_url }}" target="_blank" class="hover:underline">
                                {{ parse_url($participant->website_url, PHP_URL_HOST) ?? $participant->website_url }}
                            </a>
                        </p>
                    @endif

                    <p class="text-sm text-gray-600">
                        📍 {{ $participant->location }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $participants->links() }}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">All Activities</h2>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    @auth
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Favorite</th>
                    @endauth
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach ($activities as $activity)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-blue-600">
                            <a href="{{ route('activities.show', $activity) }}">
                                {{ $activity->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $activity->short_description }}
                        </td>
                        @auth
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('favorites.toggle', $activity) }}">
                                    @csrf
                                    <button type="submit" class="text-xl hover:scale-110 transition-transform">
                                        {{ auth()->user()->favoriteActivities->contains($activity) ? '💔' : '❤️' }}
                                    </button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $activities->links() }}
        </div>
    </div>
@endsection

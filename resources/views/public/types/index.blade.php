@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">Activity Types</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($types as $type)
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    @if ($type->icon)
                        <img
                            src="{{ asset('storage/' . $type->icon) }}"
                            alt="{{ $type->name }}"
                            class="mx-auto mb-4 h-20 w-20 object-contain"
                        >
                    @endif
                    <h3 class="text-lg font-semibold text-gray-800">{{ $type->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection

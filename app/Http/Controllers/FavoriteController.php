<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function toggle(Activity $activity): RedirectResponse
    {
        $user = Auth::user();
        $user->favoriteActivities()->toggle($activity->id);

        return back();
    }

    public function index(): View
    {
        $favorites = Auth::user()->favoriteActivities()->paginate(10);
        return view('public.activities.favorites', compact('favorites'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\View\View;

class ActivityPublicController extends Controller
{
    public function index(): View
    {
        $activities = Activity::with(['participant', 'activityType'])->paginate(10);

        return view('public.activities.index', compact('activities'));
    }

    public function show(Activity $activity): View
    {
        return view('public.activities.show', compact('activity'));
    }
}

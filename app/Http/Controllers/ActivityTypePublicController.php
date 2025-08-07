<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Illuminate\View\View;

class ActivityTypePublicController extends Controller
{
    public function index(): View
    {
        $types = ActivityType::orderBy('order')->get();

        return view('public.types.index', compact('types'));
    }
}

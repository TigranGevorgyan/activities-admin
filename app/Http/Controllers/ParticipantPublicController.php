<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\View\View;

class ParticipantPublicController extends Controller
{
    public function index(): View
    {
        $participants = Participant::paginate(10);

        return view('public.participants.index', compact('participants'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //

    public function index()
    {

        $user = Auth::user();
        $events = $user->eventOwner;

        return view('dashboard', ['events' => $events, 'user' => $user]);
    }
}

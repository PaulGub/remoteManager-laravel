<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __invoke()
    {
        $buildings = Building::all();


        $now = Carbon::now("Europe/Paris");
        $today = $now->toDateString();

        $tomorrow = Carbon::tomorrow("Europe/Paris");
        $afterward = $tomorrow->toDateString();

        return view('index', compact('buildings', 'today', 'afterward'));
    }
}

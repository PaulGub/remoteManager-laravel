<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $actualUser = Auth::user()->id;

        $users = User::find($actualUser);
        $niv = $users->is_admin;

        if ($niv == 1) {
            $bookings = Booking::all();
            return view("bookings.index", compact('bookings'));
        } else {
            $bookings = Booking::where('user_id', '=', $actualUser)->get();
            return view("bookings.index", compact('bookings'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buildings = Building::all();
        $now = Carbon::now("Europe/Paris");
        $mytime = $now->toDateString();
        return view('bookings.form', compact('mytime', 'buildings'));
    }

    public function insert(Request $request)
    {
        $date = $request->input('date');
        $user_id = Auth::user()->id;
        $building_id = $request->input('building_id');

        $mytime = Carbon::now("Europe/Paris");
        $today = $mytime->toDateString();

        if ($today > $date) {
            return redirect()->back()->with('message', "Impossible. À moins d'avoir une DeLorean DMC-12.");
        } else {
            $capacityRemaining = Booking::where('building_id', '=', $building_id)
                ->where('date', 'LIKE', $date)
                ->count();

            $building = Building::find($building_id);
            $capacity = $building->capacity;

            if ($capacityRemaining < $capacity) {
                $data = array('date' => $date, "user_id" => $user_id, "building_id" => $building_id);
                DB::table('bookings')->insert($data);
                return redirect('/bookings');
            } else {
                return redirect()->back()->with('message', 'Plus de place pour ce bâtiment et ce jour ! Désolé.');
            }

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buildings = Building::all();
        $now = Carbon::now("Europe/Paris");
        $mytime = $now->toDateString();
        $booking = Booking::find($id);
        return view('bookings.form', compact('booking','mytime', 'buildings'));
    }

    public function updateBD(Request $request, $id)
    {
        $date = $request->input('date');
        $user_id = Auth::user()->id;
        $building_id = $request->input('building_id');

        $data = array('date' => $date, 'user_id' => $user_id, 'building_id'=>$building_id );
        DB::table('bookings')
            ->where('id', $id)
            ->update($data);
        return redirect('/bookings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('bookings')->delete($id);
        return redirect('/bookings');
    }
}

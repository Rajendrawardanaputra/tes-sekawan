<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('vehicle', 'user', 'approvals')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'reservation_date' => $request->reservation_date,
        ]);

        Approval::create([
            'reservation_id' => $reservation->id,
            'approver_id' => 2, // first approver
        ]);

        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::with('vehicle', 'user', 'approvals')->findOrFail($id);
        return response()->json($reservation);
    }
}

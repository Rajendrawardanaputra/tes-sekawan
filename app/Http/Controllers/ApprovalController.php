<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $approval = Approval::where('reservation_id', $reservation->id)
                            ->where('approver_id', Auth::id())
                            ->first();

        if ($approval) {
            $approval->approved = true;
            $approval->save();

            // Create next approval level if necessary
            if ($approval->approver_id == 2) {
                Approval::create([
                    'reservation_id' => $reservation->id,
                    'approver_id' => 3, // second approver
                ]);
            } else {
                $reservation->status = 'approved';
                $reservation->save();
            }
        }

        return response()->json($reservation);
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $approval = Approval::where('reservation_id', $reservation->id)
                            ->where('approver_id', Auth::id())
                            ->first();

        if ($approval) {
            $reservation->status = 'rejected';
            $reservation->save();
        }

        return response()->json($reservation);
    }
}

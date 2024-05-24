<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json(['vehicles' => $vehicles], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $vehicle = Vehicle::create([
            'name' => $request->name,
            'type' => $request->type,
            
        ]);

        return response()->json(['message' => 'Vehicle created successfully', 'vehicle' => $vehicle], 201);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $vehicle->update([
            'name' => $request->name,
            'type' => $request->type,
            // tambahkan atribut lainnya sesuai kebutuhan
        ]);

        return response()->json(['message' => 'Vehicle updated successfully', 'vehicle' => $vehicle], 200);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return response()->json(['message' => 'Vehicle deleted successfully'], 200);
    }
}


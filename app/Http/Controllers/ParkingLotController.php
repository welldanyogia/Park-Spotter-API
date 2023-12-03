<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParkingLotResource;
use App\Models\ParkingLot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParkingLotController extends Controller
{
    public function search(Request $request):JsonResponse
    {
        $query = ParkingLot::query();

        // Implement search logic based on request parameters.
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }
        if ($request->filled('opening_hours')) {
            $query->where('opening_hours', 'like', '%' . $request->input('opening_hours') . '%');
        }
        if ($request->filled('price')) {
            $query->where('price', 'like', '%' . $request->input('price') . '%');
        }
        if ($request->filled('distance')) {
            $query->where('distance', 'like', '%' . $request->input('distance') . '%');
        }


        // Add more search conditions as needed.

        $results = $query->get();
        if ($results->isEmpty()) {
            return response()->json(['error' => 'Parking Lot not found'], 404);
        }

        return response()->json(['data' => ParkingLotResource::collection($results)]);
    }

    public function filter(Request $request):JsonResponse
    {
        $query = ParkingLot::query();

        // Implement filter logic based on request parameters.
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        if ($request->filled('distance')) {
            $query->where('distance', '<=', $request->input('distance'));
        }


        // Add more filter conditions as needed.

        $filteredResults = $query->get();

        if ($filteredResults->isEmpty()) {
            return response()->json(['error' => 'Parking Lot not found'], 404);
        }
        return response()->json(['data' => ParkingLotResource::collection($filteredResults)]);
    }

    public function getDetails($id): JsonResponse
    {
        $parkingLot = ParkingLot::find($id);

        if (!$parkingLot) {
            return response()->json(['error' => 'Parking Lot not found'], 404);
        }

        return response()->json(['data' => new ParkingLotResource($parkingLot)]);
    }
}

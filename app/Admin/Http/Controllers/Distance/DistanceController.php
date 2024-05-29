<?php

namespace App\Admin\Http\Controllers\Distance;

use App\Admin\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371): float|int
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function calculate(Request $request):JsonResponse
    {
        $fromLat = $request->input('from_lat');
        $fromLng = $request->input('from_lng');
        $toLat = $request->input('to_lat');
        $toLng = $request->input('to_lng');

        $distance = $this->haversineGreatCircleDistance($fromLat, $fromLng, $toLat, $toLng);

        return response()->json([
            'distance' => $distance
        ]);
    }
}

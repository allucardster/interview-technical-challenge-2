<?php

namespace App\Http\Controllers\ParkingSpot;

use App\Actions\ParkingSpot\ParkAction;
use App\Exceptions\ParkingSpotNotAvailableException;
use App\Models\ParkingSpot;
use App\Util\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Throwable;

class ParkController extends Controller
{
    public function __construct(private readonly ParkAction $parkAction)
    {
    }
    public function __invoke(int $id, Request $request): JsonResponse
    {
        $parkingSpot = ParkingSpot::findOrFail($id);
        $vehicleType = $request->input('vehicleType') ?: VehicleType::CAR;

        try {
            ($this->parkAction)($parkingSpot, $vehicleType);
            return response()->json([
                'success' => true,
                'message' => 'Park process finished successfully',
                'data' => $parkingSpot,
            ]);
        } catch (ParkingSpotNotAvailableException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Parking Spot is not available',
            ], 400);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\ParkingSpot;

use App\Actions\ParkingSpot\UnparkAction;
use App\Exceptions\ParkingSpotIsAlreadyAvailableException;
use App\Models\ParkingSpot;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Throwable;

class UnparkController extends Controller
{
    public function __construct(private readonly UnparkAction $unparkAction)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $parkingSpot = ParkingSpot::findOrFail($id);
        try {
            ($this->unparkAction)($parkingSpot);
            return response()->json([
                'success' => true,
                'message' => 'Unpark process finished successfully',
                'data' => $parkingSpot,
            ]);
        } catch (ParkingSpotIsAlreadyAvailableException $e) {
            return response()->json([
                'success' => true,
                'message' => 'Parking spot already available',
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}

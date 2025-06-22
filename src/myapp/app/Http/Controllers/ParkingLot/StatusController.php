<?php

namespace App\Http\Controllers\ParkingLot;

use App\Models\ParkingSpot;
use App\Services\GetParkingLotStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function __construct(private readonly GetParkingLotStatus $getParkingLotStatus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json(($this->getParkingLotStatus)());
    }
}

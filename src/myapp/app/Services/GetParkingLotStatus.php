<?php

namespace App\Services;

use App\DTO\ParkingLotStatus;
use App\Models\ParkingSpot;
use App\Util\VehicleType;

class GetParkingLotStatus
{
    public function __construct(private readonly GetSpotFactorFromVehicleType $getSpotFactorFromVehicleType)
    {
    }
    public function __invoke(): ParkingLotStatus
    {
        $data = ParkingSpot::selectRaw('COUNT(*) AS total, SUM("spotFactor") AS unavailableTotal')->first();
        $total = (int) $data->total;
        $unavailableTotal = (int) $data->unavailabletotal;
        $availableTotal = (int) $total - $unavailableTotal;
        $availableStatus = [
            VehicleType::CAR->value => 0,
            VehicleType::MOTORCYCLE->value => 0,
            VehicleType::VAN->value => 0
        ];

        foreach ($availableStatus as $key => $value) {
            $factor = ($this->getSpotFactorFromVehicleType)($key);
            $value = 0;
            if ($factor > 0) {
                $value = floor($availableTotal / $factor);
            }

            $availableStatus[$key] = (int) $value;
        }

        return new ParkingLotStatus($total, $unavailableTotal, $availableStatus);
    }
}

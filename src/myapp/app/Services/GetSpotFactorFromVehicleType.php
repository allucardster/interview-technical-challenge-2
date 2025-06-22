<?php

namespace App\Services;

use App\Util\VehicleType;

class GetSpotFactorFromVehicleType
{
    public function __invoke(string $vehicleType): int
    {
        return match ($vehicleType) {
            VehicleType::VAN->value => 3,
            default => 1
        };
    }
}

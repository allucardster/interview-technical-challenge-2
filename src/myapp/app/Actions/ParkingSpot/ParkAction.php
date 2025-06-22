<?php

namespace App\Actions\ParkingSpot;

use App\Exceptions\ParkingSpotNotAvailableException;
use App\Models\ParkingSpot;
use App\Services\GetSpotFactorFromVehicleType;

class ParkAction
{
    public function __construct(private readonly GetSpotFactorFromVehicleType $getSpotFactorFromVehicleType)
    {
    }

    /**
     * @param ParkingSpot $parkingSpot
     * @param string $vehicleType
     * @return void
     * @throws ParkingSpotNotAvailableException
     */
    public function __invoke(ParkingSpot $parkingSpot, string $vehicleType): void
    {
        if (!$parkingSpot->isAvailable()) {
            throw new ParkingSpotNotAvailableException();
        }

        $spotFactor = ($this->getSpotFactorFromVehicleType)($vehicleType);
        $parkingSpot->park($spotFactor);
    }
}

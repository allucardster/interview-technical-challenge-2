<?php

namespace App\Actions\ParkingSpot;

use App\Exceptions\ParkingSpotIsAlreadyAvailableException;
use App\Models\ParkingSpot;

class UnparkAction
{
    /**
     * @param ParkingSpot $parkingSpot
     * @return void
     * @throws ParkingSpotIsAlreadyAvailableException
     */
    public function __invoke(ParkingSpot $parkingSpot): void
    {
        if ($parkingSpot->isAvailable()) {
            throw new ParkingSpotIsAlreadyAvailableException();
        }

        $parkingSpot->unpark();
    }
}

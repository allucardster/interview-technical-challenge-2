<?php

namespace App\DTO;

class ParkingLotStatus
{
    public function __construct(
        public readonly int $total,
        public readonly int $unavailableTotal = 0,
        public readonly array $availableStatus = []
    ) {
    }
}

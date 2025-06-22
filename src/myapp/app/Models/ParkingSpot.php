<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int spotFactor
 * @method static ParkingSpot findOrFail($id, $columns = ['*'])
 */
class ParkingSpot extends Model
{
    use HasFactory;

    public function isAvailable(): bool
    {
        return 0 === $this->spotFactor;
    }

    public function park(int $spotFactor): void
    {
        $this->spotFactor = $spotFactor;
        $this->save();
    }

    public function unpark(): void
    {
        $this->spotFactor = 0;
        $this->save();
    }
}

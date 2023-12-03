<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMaps extends Model
{
    use HasFactory;

    protected $fillable = ['parking_lot_id', 'map_url', 'description'];

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }
}

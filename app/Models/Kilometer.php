<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kilometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'vehicle_id',
        'image',
        'status_service',
    ];

    public function list_vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function show_vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}

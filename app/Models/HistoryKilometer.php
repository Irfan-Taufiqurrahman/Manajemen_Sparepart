<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryKilometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'vehicle_id',
        'image',
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

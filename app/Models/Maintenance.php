<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_image',
        'part_id',
        'vehicle_id',
        'quality_id',
        'description',
        'createdBy',
    ];

    public function listPart()
    {
        return $this->belongsTo(Part::class);
    }

    public function listVehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function listQuality()
    {
        return $this->belongsTo(Quality::class);
    }
}

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

    public function show_vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function show_quality()
    {
        return $this->belongsTo(Quality::class, 'quality_id');
    }
    public function show_part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}

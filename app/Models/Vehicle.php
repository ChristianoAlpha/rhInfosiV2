<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate',
        'model',
        'brand',
        'yearManufacture',
        'color',
        'loadCapacity',
        'totalMileage',
        'currentMileage',
        'lastMaintenanceDate',
        'nextMaintenanceDate',
        'status',
        'notes'
    ];

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'vehicleId');
    }

    public function employees()
    {
        return $this->hasMany(Employeee::class, 'vehicleId');
    }
}
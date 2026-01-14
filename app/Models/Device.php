<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function tracking_devices()
    {
        return $this->hasMany(TrackingDevice::class);
    }
}

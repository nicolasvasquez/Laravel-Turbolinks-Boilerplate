<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Region;
use App\Establecimiento;

class Comuna extends Model
{

    protected $fillable = [
        'name'
    ];
    
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}

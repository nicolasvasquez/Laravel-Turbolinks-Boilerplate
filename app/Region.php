<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comuna;

class Region extends Model
{
    protected $fillable = [
        'name'
    ];

    public function comunas()
    {
        return $this->hasMany(Comuna::class);
    }
}

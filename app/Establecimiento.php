<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comuna;

class Establecimiento extends Model
{

    protected $fillable = [
        'name'
    ];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }
}

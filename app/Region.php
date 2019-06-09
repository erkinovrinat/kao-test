<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'oblast_id'];

    public function oblast()
    {
        return $this->belongsTo(Oblast::class);
    }
}

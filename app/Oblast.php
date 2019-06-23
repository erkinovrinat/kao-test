<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oblast extends Model
{
    protected $fillable = ['name'];

    public function schools()
    {
        return $this->hasManyThrough(School::class, Region::class);
    }
}

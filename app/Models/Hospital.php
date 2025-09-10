<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        "name",
        "address",
        "email",
        "telephone"
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}

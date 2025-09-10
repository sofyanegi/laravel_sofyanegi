<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        "name",
        "address",
        "telephone_number",
        "id_hospital"
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}

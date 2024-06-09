<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clearance()
    {
        return $this->hasMany(Clearance::class);
    }
}

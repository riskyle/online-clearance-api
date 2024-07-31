<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPersonnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class);
    }

    public function scopeFindSp(Builder $query, $id)
    {
        return $query
            ->where('user_id', $id)
            ->first();
    }
}

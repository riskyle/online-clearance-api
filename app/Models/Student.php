<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class, 'student_id', 'lrn');
    }

    public function scopeFindStudent($query)
    {
        return $query
            ->when(auth()->user()->role_id === 3, function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->first();
    }

    public function scopeGetStudent($query, $studentSection = null)
    {
        return $query
            ->when($studentSection ?? false, fn ($query, $studentSection) => $query->where('student_section', $studentSection))
            ->paginate();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'lrn');
    }

    public function schoolPersonnel()
    {
        return $this->belongsTo(SchoolPersonnel::class);
    }

    public function quarter()
    {
        return $this->belongsTo(Quarter::class);
    }

    public function scopeGetClearances($query)
    {
        return $query
            ->latest()
            ->with(['student', 'quarter', 'schoolPersonnel'])
            ->when(auth()->user()->role_id === 3, fn ($query) => $query->where('student_id', Student::findStudent()->lrn))
            ->paginate();
    }
}

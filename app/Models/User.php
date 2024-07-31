<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function schoolPersonnel()
    {
        return $this->hasOne(SchoolPersonnel::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function scopeGetStudentUsers(Builder $query, $includeClearances = false)
    {
        return $query
            ->where('role_id', 3)
            ->with(['student' => function ($query) use ($includeClearances) {
                if ($includeClearances) {
                    $query->with('clearance');
                }
            }]);
    }

    public function scopeFindStudentUser(Builder $query, $id, $includeClearances = false)
    {
        return $query
            ->where('role_id', 3)
            ->where('id', $id)
            ->with(['student' => function ($query) use ($includeClearances) {
                if ($includeClearances) {
                    $query->with('clearance');
                }
            }])
            ->first();
    }

    public function scopeSchoolPersonnels(Builder $query)
    {
        return $query
            ->where('role_id', 1)
            ->orWhere('role_id', 2);
    }

    public function scopeFindSchoolPersonnel(Builder $query, $id)
    {
        return $query
            ->whereNot(fn (Builder $query) => $query->where('role_id', 3))
            ->where('id', $id)
            ->first();
    }
}

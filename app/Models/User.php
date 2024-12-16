<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function taskLogs()
    {
        return $this->hasMany(TaskLog::class);
    }
}

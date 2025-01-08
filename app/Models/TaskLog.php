<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'task_name',
        'description',
        'status',
        'date',
        'timestamp',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Message.
     */
    public function message()
    {
        return $this->hasOne(Message::class, 'task_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'task_id');
    }
}

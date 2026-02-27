<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable ;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_banned'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_banned' => 'boolean',
    ];

public function colocations()
{
    return $this->belongsToMany(
        Colocations::class,
        'colocation_memberships',
        'user_id',
        'colocations_id'
    )->withPivot('role', 'joined_at')
     ->withTimestamps();
}
}
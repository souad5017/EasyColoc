<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocations extends Model
{

    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'colocation_memberships')
                    ->withPivot('role', 'joined_at', 'left_at')
                    ->withTimestamps();
    }

        public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

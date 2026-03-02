<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Colocations extends Model
{

    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    public function members()
    {
        return $this->belongsToMany(
            User::class,
            'colocation_memberships',
            'colocations_id',
            'user_id'
        )
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }
        public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class, 'colocation_memberships', 'colocations_id', 'user_id')
                    ->withPivot('role', 'joined_at', 'left_at')
                    ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function depenses()
    {
        return $this->hasMany(Depenses::class , 'colocation_id');
    }
    public function categories()
{
    return $this->hasMany(Categories::class ,  'colocation_id')->orWhere('is_global', true);
}
public function payments()
{
    return $this->hasMany(payments::class , 'colocation_id');
}
}

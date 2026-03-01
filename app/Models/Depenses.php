<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depenses extends Model
{
          protected $fillable = [
        'colocation_id',
        'user_id',
        'label',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function colocation()
{
    return $this->belongsTo(Colocations::class, 'colocations_id'); 
}
}

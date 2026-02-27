<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
      use HasFactory;

    protected $fillable = [
        'colocation_id',
        'email',
        'token',
        'accepted',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocations::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
        protected $fillable = [
        'name',
        'colocation_id',
        'is_global'
    ];
    public function colocation()
{
    return $this->belongsTo(Colocations::class ,'colocation_id');
}
}

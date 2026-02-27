<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depenses extends Model
{
   public function colocation()
{
    return $this->belongsTo(Colocations::class, 'colocations_id'); 
}
}

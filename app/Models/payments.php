<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    protected $fillable = [
        'colocation_id',
        'from_user_id',
        'to_user_id',
        'status',
        'paid_at',
        'depense_id',
        'amount',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocations::class, 'coloctaion_id');
    }


    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    public function depense()
    {
        return $this->belongsTo(Depenses::class);
    }
}

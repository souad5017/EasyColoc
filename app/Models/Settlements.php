<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlements extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'sender_id',
        'receiver_id',
        'amount',
        'status',
        'paid_at'
    ];

   public function colocation()
    {
        return $this->belongsTo(Colocations::class , 'coloctaion_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    public function depense()
{
    return $this->belongsTo(Depenses::class); 
}
}
<?php

namespace App\Http\Controllers;


use App\Models\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

public function markPaid($id)
{

    $settlement = payments::findOrFail($id);

    if ($settlement->to_user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    if ($settlement->status === 'pending') {
        $settlement->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    return back()->with('success', 'Paiement confirmé avec succès');
}
}
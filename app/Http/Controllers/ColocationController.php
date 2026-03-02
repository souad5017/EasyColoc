<?php

namespace App\Http\Controllers;

use App\Models\Colocations;
use App\Models\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ColocationController extends Controller
{
    public function dashboard()
    {

        $colocation = auth()->user()
            ->colocations()
            ->where('status', 'active')
            ->first();
        $memberCount = max($colocation->users->count(), 1);
        $total = $colocation->depenses->sum('amount');
        $share = $memberCount > 0 ? $total / $memberCount : 0;

        $balance = $colocation->users->map(function ($user) use ($colocation, $share) {
            $paid = $colocation->depenses->where('user_id', $user->id)->sum('amount');

            return [
                'user' => $user,
                'paid' => $paid,
                'share' => $share,
                'balance' => $share - $paid,
            ];
        });

        $user = auth()->user();
        
        $toReceive = payments::whereHas('depense', function ($q) use ($colocation) {
            $q->where('colocation_id', $colocation->id);
        })
            ->where('to_user_id', $user->id)
            ->where('status', 'pending')
            ->with('sender')
            ->get();


        $toPay = payments::whereHas('depense', function ($q) use ($colocation) {
            $q->where('colocation_id', $colocation->id);
        })
            ->where('from_user_id', $user->id)
            ->where('status', 'pending')
            ->with('receiver')
            ->get();

        return view('colocations.show', compact(
            'colocation',
            'balance',
            'total',
            'share',
            'memberCount',
            'toPay',
            'toReceive'
        ));
    }
    public function show($id)
    {

        $colocation = Colocations::with(['users', 'depenses.user', 'owner'])
            ->findOrFail($id);

        $memberCount = max($colocation->users->count(), 1);
        $total = $colocation->depenses->sum('amount');
        $share = $memberCount > 0 ? $total / $memberCount : 0;

        $balance = $colocation->users->map(function ($user) use ($colocation, $share) {
            $paid = $colocation->depenses->where('user_id', $user->id)->sum('amount');

            return [
                'user' => $user,
                'paid' => $paid,
                'share' => $share,
                'balance' => $share - $paid,
            ];
        });


        $user = auth()->user();
        
        $toReceive = payments::whereHas('depense', function ($q) use ($colocation) {
            $q->where('colocation_id', $colocation->id);
        })
            ->where('to_user_id', $user->id)
            ->where('status', 'pending')
            ->with('sender')
            ->get();


        $toPay = payments::whereHas('depense', function ($q) use ($colocation) {
            $q->where('colocation_id', $colocation->id);
        })
            ->where('from_user_id', $user->id)
            ->where('status', 'pending')
            ->with('receiver')
            ->get();

        return view('colocations.show', compact(
            'colocation',
            'balance',
            'total',
            'share',
            'memberCount',
            'toPay',
            'toReceive'
        ));
    }


    public function index()
    {
        $user = Auth::user();
        // dd(\Illuminate\Support\Facades\Schema::getColumnListing('colocation_memberships'));

        $totalColocations = $user->colocations()->count();
        $totalMembers = $user->colocations()->withCount('members')->get()->sum('members_count');
        $totalExpenses = $user->colocations()->with('depenses')->get()->sum(function ($colocation) {
            return $colocation->depenses->sum('amount');
        });
        $pendingPayments = $user->colocations()->with('depenses')->get()->sum(function ($colocation) {
            return $colocation->depenses->where('status', 'pending')->count();
        });

        $recentColocations = $user->colocations()->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalColocations',
            'totalMembers',
            'totalExpenses',
            'pendingPayments',
            'recentColocations'
        ));
    }
    public function create()
    {
        return view('colocations.createcolocation');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $hasActiveColocation = $user->colocations()
            ->where('status', 'active')
            ->exists();

        if ($hasActiveColocation) {
            return redirect()->back()
                ->with('error', 'Vous avez déjà une colocation active.');
        } else {
            $colocation = Colocations::create([
                'name' => $request->name,
                'status' => 'active',
                'created_by' => auth()->id(),
            ]);

            $user->colocations()->attach($colocation->id, [
                'role' => 'owner',
                'joined_at' => now(),
            ]);

            return redirect()->route('colocations.show', $colocation->id)
                ->with('success', 'Colocation créée et vous êtes l\'Owner!');
        }
    }
}

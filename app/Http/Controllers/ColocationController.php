<?php

namespace App\Http\Controllers;

use App\Models\Colocations;
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
        return view('colocations.show', compact('colocation'));
    }
    public function show(Colocations $colocations , $id)
    {
        $colocations->load(['users', 'expenses.user']);
        $membercount = max($colocations->users->count(), 1);
        $total = $colocations->expenses->sum("amount");
        $share = $colocations->expenses->sum("amount") / $membercount;

        $balance = $colocations->users->map(fn($user) => [
            "user" => $user,
            "paied" => $paied = $colocations->expenses->where("user_id", $user->id)->sum("amount"),
            "share" => $share,
            "balance" => $paied - $share,
        ]);

        dump($balance);
        dump($total);

        $colocation = auth()->user()
            ->colocations()
            ->with('owner')
            ->findOrFail($id);
        return view('colocations.show', compact('colocation', 'colocations','balance', 'total', 'share', 'membercount'));
    }


    public function index()
    {
        $user = Auth::user();
        // dd(\Illuminate\Support\Facades\Schema::getColumnListing('colocation_memberships'));

        $totalColocations = $user->colocations()->count();
        $totalMembers = $user->colocations()->withCount('members')->get()->sum('members_count');
        $totalExpenses = $user->colocations()->with('expenses')->get()->sum(function ($colocation) {
            return $colocation->expenses->sum('amount');
        });
        $pendingPayments = $user->colocations()->with('expenses')->get()->sum(function ($colocation) {
            return $colocation->expenses->where('status', 'pending')->count();
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

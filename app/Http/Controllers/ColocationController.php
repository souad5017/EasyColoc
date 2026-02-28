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

        $colocation =  Colocations::where('status', 'active')->with('owner')->first();
        return view('colocations.show', compact('colocation'));
    }
    public function show($id)
    {
        $colocation = Colocations::with('owner')->findOrFail($id);
        return view('colocations.show', compact('colocation'));
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

        $colocation = Colocations::create([
            'name' => $request->name,
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        $user->colocations()->attach($colocation->id, [
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('colocations.show', $colocation->id)
            ->with('success', 'Colocation créée et vous êtes l\'Owner!');
    }
}

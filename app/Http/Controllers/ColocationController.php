<?php

namespace App\Http\Controllers;

use App\Models\Colocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function dashboard()
{
    $colocation =  Colocations::where('status', 'active')->first();

    return view('colocations.show', compact('colocation'));
}

    public function index()
    {
        $user = Auth::user();

        
        $totalColocations = 5; 
        $totalMembers = 8;
        $totalExpenses = 1;
        $pendingPayments =4;

        // $recentColocations = $user->colocations()->latest()->take(5)->get();

        // return view('dashboard', compact(
        //     'totalColocations',
        //     'totalMembers',
        //     'totalExpenses',
        //     'pendingPayments',
        //     'recentColocations'
        // ));
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

   
    public function show($id)
    {
        $colocation = Colocations::findOrFail($id);
        return view('colocations.show', compact('colocation'));
    }
}
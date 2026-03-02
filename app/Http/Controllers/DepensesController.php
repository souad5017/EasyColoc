<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colocations;
use App\Models\Depenses;
use App\Models\payments;
use App\Models\Settlements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepensesController extends Controller
{
    // public function index($colocationId)
    // {
    //     $colocation = Colocations::findOrFail($colocationId);
    //     $depenses = $colocation->depenses()->with('user', 'categories')->get();
    //     $categories = Categories::where('is_global', true)
    //         ->orWhere('colocation_id', $colocationId)->get();

    //     return view('colocations.show', compact('depenses', 'colocation', 'categories'));
    // }

    public function create($colocationId)
    {
        $colocation = Colocations::findOrFail($colocationId);
        $categories = Categories::where('is_global', true)
            ->orWhere('colocation_id', $colocationId)->get();
        $members = $colocation->users;
        return view('depenses.create', compact('colocation', 'categories', 'members'));
    }

    public function store(Request $request, $colocationId)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'categories_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $colocation = Colocations::findOrFail($colocationId);

        $depense = Depenses::create([
            'colocation_id' => $colocationId,
            'user_id' => $request->user_id,
            'categories_id' => $request->categories_id,
            'label' => $request->label,
            'amount' => $request->amount
        ]);

        $activeMembers = $colocation->users()->wherePivotNull('left_at')->get();
        $memberCount = $activeMembers->count();

        if ($memberCount > 1) {

            $share = $request->amount / $memberCount;

            foreach ($activeMembers as $member) {

                if ($member->id != $request->user_id) {
                    payments::create([
                        'colocation_id' => $colocationId,
                        'depense_id' => $depense->id,
                        'from_user_id' => $member->id,
                        'to_user_id' => $request->user_id,
                        'amount' => $share,
                        'status' => 'pending',
                    ]);
                }
            }
        }

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Dépense et répartitions ajoutées !');
    }

    public function edit($colocationId, $id)
    {
        $depense = Depenses::findOrFail($id);
        $categories = Categories::where('is_global', true)
            ->orWhere('colocation_id', $colocationId)->get();
        $colocation = Colocations::findOrFail($colocationId);
        $members = $colocation->users;

        return view('depenses.edit', compact('depense', 'categories', 'colocation', 'members'));
    }

    public function update(Request $request, $colocationId, $id)
    {

        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'categories_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

       
        $depense = Depenses::findOrFail($id);

      
        $depense->update([
            'user_id' => $request->user_id,
            'categories_id' => $request->categories_id,
            'label' => $request->label,
            'amount' => $request->amount
        ]);

        $depense->payments()->delete();

        $colocation = Colocations::findOrFail($colocationId);
        $activeMembers = $colocation->users()->wherePivotNull('left_at')->get();
        $memberCount = $activeMembers->count();

       
        if ($memberCount > 1) {
            $share = $request->amount / $memberCount;

            foreach ($activeMembers as $member) {

                if ($member->id != $request->user_id) {
                    payments::create([
                        'colocation_id' => $colocationId,
                        'depense_id' => $depense->id,
                        'from_user_id' => $member->id,
                        'to_user_id' => $request->user_id,
                        'amount' => $share,
                        'status' => 'pending',
                    ]);
                }
            }
        }

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Dépense mise à jour avec succès !');
    }

    public function destroy($colocationId, $id)
    {
        $depense = Depenses::findOrFail($id);

        if ($depense->user_id != Auth::id()) {
            return redirect()->route('colocations.show', $colocationId)
                ->with('error', 'Vous ne pouvez pas supprimer cette dépense.');
        }

        $depense->delete();

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Dépense supprimée !');
    }
}

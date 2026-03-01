<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colocations;
use App\Models\Depenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepensesController extends Controller
{
    public function index($colocationId)
    {
        $colocation = Colocations::findOrFail($colocationId);
        $depenses = $colocation->depenses()->with('user', 'categories')->get();
        $categories = Categories::where('is_global', true)
            ->orWhere('colocation_id', $colocationId)->get();

        return view('colocations.show', compact('depenses', 'colocation', 'categories'));
    }

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
        ], [
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être au moins zéro.',
            'categories_id.required' => 'Veuillez choisir une catégorie.',
            'categories_id.exists' => 'La catégorie choisie n\'est pas valide.',
            'user_id.required' => 'Veuillez sélectionner un membre.',
            'user_id.exists' => 'Le membre sélectionné n\'est pas valide.',
        ]);

        Depenses::create([
            'colocation_id' => $colocationId,
            'user_id' => $request->user_id,
            'categories_id' => $request->categories_id,
            'label' => $request->label,
            'amount' => $request->amount
        ],);

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Dépense ajoutée !');
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
        $depense = Depenses::findOrFail($id);

        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'categories_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ], [
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être au moins zéro.',
            'categories_id.required' => 'Veuillez choisir une catégorie.',
            'categories_id.exists' => 'La catégorie choisie n\'est pas valide.',
            'user_id.required' => 'Veuillez sélectionner un membre.',
            'user_id.exists' => 'Le membre sélectionné n\'est pas valide.',
        ]);

        $depense->update($request->only('label', 'amount', 'categories_id'));

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Dépense mise à jour !');
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

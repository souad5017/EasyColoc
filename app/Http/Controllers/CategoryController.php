<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colocations;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index($colocationId)
    {
        // Jib colocation b id
        $colocation = Colocations::findOrFail($colocationId);

        // Jib categories li global w li dial had colocation
        $categories = Categories::where('is_global', true)
            ->orWhere('colocation_id', $colocationId)
            ->get();

        // Sift l-view
        return view('categories.index', compact('categories', 'colocation'));
    }

    public function store(Request $request, $colocationId)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);


        $exists = Categories::where('colocation_id', $colocationId)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['name' => 'Cette catégorie existe déjà pour cette colocation.']);
        }

        Categories::create([
            'name' => $request->name,
            'colocation_id' => $colocationId,
            'is_global' => false
        ]);

        return redirect()->route('colocations.show', $colocationId)
            ->with('success', 'Catégorie ajoutée');
    }
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('colocations.show', $category->colocation_id)
            ->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function destroy(Categories $category)
    {
        if ($category->is_global) {
            return back()->with('error', 'Impossible de supprimer une catégorie globale');
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée 🗑');
    }
}

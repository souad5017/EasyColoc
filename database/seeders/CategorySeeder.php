<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Categories::insert([
    ['name' => 'Nourriture', 'is_global' => true, 'colocation_id' => null],
    ['name' => 'Loyer', 'is_global' => true, 'colocation_id' => null],
    ['name' => 'Internet', 'is_global' => true, 'colocation_id' => null],
    ['name' => 'Eau', 'is_global' => true, 'colocation_id' => null],
]);
    }
}

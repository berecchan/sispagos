<?php

namespace Database\Seeders;

use App\Models\Concepto;
use Illuminate\Database\Seeder;

class ConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Concepto::create([
            'codigo' => "B003",
            'descripcion' => "Beneficios",
            'monto'=>3500.00
        ]);
        Concepto::create([
            'codigo' => "A003",
            'descripcion' => "Exámenes",
            'monto'=>26.00
        ]);
        Concepto::create([
            'codigo' => "B002",
            'descripcion' => "Aportaciones",
            'monto'=>24.00
        ]);
        Concepto::create([
            'codigo' => "B002",
            'descripcion' => "Cuotas voluntarias escolarizado",
            'monto'=>300.00
        ]);
        Concepto::create([
            'codigo' => "B002",
            'descripcion' => "Autoplaneado",
            'monto'=>400.00
        ]);
    }
}
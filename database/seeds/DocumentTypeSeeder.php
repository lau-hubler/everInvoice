<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'acronym' => 'CC',
            'name' => 'Cédula de Ciudadanía',
        ]);
        DB::table('document_types')->insert([
            'acronym' => 'NIT',
            'name' => 'Número de Identificación Tributária',
        ]);
        DB::table('document_types')->insert([
            'acronym' => 'CE',
            'name' => 'Cédula de Extranjería',
        ]);
        DB::table('document_types')->insert([
            'acronym' => 'PP',
            'name' => 'Pasaporte',
        ]);
    }
}

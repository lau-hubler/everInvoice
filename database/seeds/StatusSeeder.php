<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'draft',
        ]);
        DB::table('statuses')->insert([
            'name' => 'sent',
        ]);
        DB::table('statuses')->insert([
            'name' => 'paid',
        ]);
        DB::table('statuses')->insert([
            'name' => 'overdue',
        ]);
        DB::table('statuses')->insert([
            'name' => 'write-off',
        ]);
        DB::table('statuses')->insert([
            'name' => 'cancelled',
        ]);
        DB::table('statuses')->insert([
            'name' => 'in process',
        ]);
    }
}

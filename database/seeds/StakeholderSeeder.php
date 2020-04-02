<?php

use Illuminate\Database\Seeder;

class StakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Stakeholder::class, 15)->create();
    }
}

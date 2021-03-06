<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CdCollection::class, 10)->create();
        factory(App\Rent::class, 10)->create();
    }
}

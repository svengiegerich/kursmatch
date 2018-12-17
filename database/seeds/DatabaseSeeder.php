<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // Disable all mass assignment restrictions
      Model::unguard();

      $this->call(ApplicantsTableSeeder::class);
    }
}

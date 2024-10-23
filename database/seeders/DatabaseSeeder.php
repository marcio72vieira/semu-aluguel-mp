<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        $this->call(RegionalSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(TipoUnidadeSeeder::class);
        $this->call(UnidadeAtendimentoSeeder::class);
        $this->call(UserSeeder::class);
    }
}

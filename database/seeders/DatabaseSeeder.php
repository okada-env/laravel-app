<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            PersonTableSeeder::class,
            ProjectTableSeeder::class,
            StatusSeeder::class,
        ]);
    }
}

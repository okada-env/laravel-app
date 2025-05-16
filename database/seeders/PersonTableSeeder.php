<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::all()->each(function ($company) {
            $count = rand(1, 3);
            Person::factory()->count($count)->create([
                'company_id' => $company->id
            ]);
        });
    }
}

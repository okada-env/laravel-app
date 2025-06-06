<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
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
            $projects = Project::factory()->count($count)->create([
                'company_id' => $company->id
            ]);

            foreach ($projects as $project) {
                $person = Person::where('company_id', $company->id)->inRandomOrder()->first();
                if ($person) {
                    $person->projects()->attach($project->id, [
                        'company_id' => $company->id
                    ]);
                }
            }
        });
    }
}

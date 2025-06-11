<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Person;
use App\Models\Status;
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
        $user = \App\Models\User::factory()->create();

        \App\Models\Company::all()->each(function ($company) use ($user) {
            $count = rand(1, 3);
            $projects = Project::factory()->count($count)->create([
                'company_id' => $company->id,
                'user_id' => $user->id,
            ]);

            foreach ($projects as $project) {
                $person = Person::where('company_id', $company->id)->inRandomOrder()->first();
                $status = Status::inRandomOrder()->first();
                if ($person && $status) {
                    $person->projects()->attach($project->id, [
                        'company_id' => $company->id,
                        'status_id' => $status->id
                    ]);
                }
            }
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $companyIds = null;
        static $userIds = null;
        
        if ($companyIds === null) {
            $companyIds = Company::pluck('id')->toArray();
        }
        
        if ($userIds === null) {
            $userIds = \App\Models\User::pluck('id')->toArray();
        }
        
        return [
            'title' => $this->faker->company(),
            'contact_project' => $this->faker->randomElement([
                'Pカレ',
                'コンサル',
                'スマロボ'
            ]),
            'company_id' => $this->faker->randomElement($companyIds),
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
